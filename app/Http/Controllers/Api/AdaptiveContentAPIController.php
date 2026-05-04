<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdaptiveContent;
use App\Models\AdaptiveContentVariation;
use App\Models\Student;
use App\Models\StudentContentPreference;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdaptiveContentAPIController extends Controller
{
    /**
     * Get all adaptive content with variations
     */
    public function index(): JsonResponse
    {
        $adaptiveContents = AdaptiveContent::with(['variations', 'courseResource'])
            ->where('is_active', true)
            ->get()
            ->map(function ($content) {
                return [
                    'id' => $content->id,
                    'title' => $content->courseResource->title,
                    'type' => $content->content_type,
                    'difficulty' => $content->difficulty_level,
                    'variations_count' => $content->variations()->count(),
                ];
            });

        return response()->json(['data' => $adaptiveContents]);
    }

    /**
     * Get recommended content variation for a specific student
     */
    public function getRecommendedForStudent(AdaptiveContent $adaptiveContent, Student $student): JsonResponse
    {
        $variation = $adaptiveContent->getVariationForStudent($student);

        if (!$variation) {
            return response()->json(['error' => 'No suitable variation found'], 404);
        }

        // Record preference usage
        $preference = $student->contentPreferences()
            ->where('variation_id', $variation->id)
            ->first();

        if ($preference) {
            $preference->updateUsage();
        } else {
            $student->contentPreferences()->create([
                'variation_id' => $variation->id,
                'is_preferred' => true,
                'usage_count' => 1,
                'last_used_at' => now(),
            ]);
        }

        return response()->json([
            'variation_id' => $variation->id,
            'type' => $variation->variation_type,
            'content' => $variation->adapted_content,
            'accessibility_features' => $variation->accessibility_features,
            'recommendation_score' => $variation->recommendation_score,
            'is_default' => $variation->is_default,
        ]);
    }

    /**
     * Get all variations for a content
     */
    public function getVariations(AdaptiveContent $adaptiveContent): JsonResponse
    {
        $variations = $adaptiveContent->variations()
            ->select(['id', 'variation_type', 'target_disability', 'is_default', 'recommendation_score', 'usage_count'])
            ->get();

        return response()->json(['data' => $variations]);
    }

    /**
     * Get specific variation details
     */
    public function getVariation(AdaptiveContent $adaptiveContent, AdaptiveContentVariation $variation): JsonResponse
    {
        if ($variation->adaptive_content_id !== $adaptiveContent->id) {
            return response()->json(['error' => 'Variation not found for this content'], 404);
        }

        return response()->json([
            'id' => $variation->id,
            'type' => $variation->variation_type,
            'target_disability' => $variation->target_disability,
            'content' => $variation->adapted_content,
            'accessibility_features' => $variation->accessibility_features,
            'recommendation_score' => $variation->recommendation_score,
            'is_default' => $variation->is_default,
            'usage_count' => $variation->usage_count,
        ]);
    }

    /**
     * Get student's content preferences and usage
     */
    public function getStudentPreferences(Student $student): JsonResponse
    {
        $preferences = $student->contentPreferences()
            ->with(['variation' => function ($query) {
                $query->select('id', 'variation_type', 'target_disability', 'recommendation_score');
            }])
            ->select(['id', 'variation_id', 'is_preferred', 'usage_count', 'last_used_at'])
            ->get();

        return response()->json(['data' => $preferences]);
    }

    /**
     * Update student preference for a variation
     */
    public function updateStudentPreference(Student $student, AdaptiveContentVariation $variation, Request $request): JsonResponse
    {
        $preference = $student->contentPreferences()
            ->where('variation_id', $variation->id)
            ->first();

        if (!$preference) {
            $preference = $student->contentPreferences()->create([
                'variation_id' => $variation->id,
                'is_preferred' => $request->input('is_preferred', true),
                'usage_count' => 0,
            ]);
        } else {
            $preference->update(['is_preferred' => $request->input('is_preferred', true)]);
        }

        return response()->json([
            'message' => 'Preference updated successfully',
            'preference' => $preference,
        ]);
    }

    /**
     * Get adaptive content for course resource
     */
    public function getForCourseResource($resourceId): JsonResponse
    {
        $adaptiveContent = AdaptiveContent::where('course_resource_id', $resourceId)
            ->where('is_active', true)
            ->with('variations')
            ->first();

        if (!$adaptiveContent) {
            return response()->json(['error' => 'No adaptive content found for this resource'], 404);
        }

        return response()->json([
            'id' => $adaptiveContent->id,
            'type' => $adaptiveContent->content_type,
            'difficulty' => $adaptiveContent->difficulty_level,
            'variations' => $adaptiveContent->variations->map(function ($var) {
                return [
                    'id' => $var->id,
                    'type' => $var->variation_type,
                    'target_disability' => $var->target_disability,
                    'is_default' => $var->is_default,
                    'score' => $var->recommendation_score,
                ];
            }),
        ]);
    }

    /**
     * Record content view/usage
     */
    public function recordUsage(Student $student, AdaptiveContentVariation $variation): JsonResponse
    {
        $variation->recordUsage();

        $preference = $student->contentPreferences()
            ->where('variation_id', $variation->id)
            ->first();

        if ($preference) {
            $preference->updateUsage();
        }

        return response()->json(['message' => 'Usage recorded successfully']);
    }
}

