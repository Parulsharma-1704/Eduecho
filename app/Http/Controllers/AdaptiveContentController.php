<?php

namespace App\Http\Controllers;

use App\Models\AdaptiveContent;
use App\Models\AdaptiveContentVariation;
use App\Models\CourseResource;
use App\Models\Student;
use Illuminate\Http\Request;

class AdaptiveContentController extends Controller
{
    /**
     * Display a listing of adaptive content
     */
    public function index()
    {
        $this->authorize('viewAny', AdaptiveContent::class);
        
        $adaptiveContents = AdaptiveContent::with(['courseResource', 'creator'])
            ->paginate(15);

        return view('adaptive-content.index', compact('adaptiveContents'));
    }

    /**
     * Show the form for creating new adaptive content
     */
    public function create()
    {
        $this->authorize('create', AdaptiveContent::class);
        
        $courseResources = CourseResource::all();

        return view('adaptive-content.create', compact('courseResources'));
    }

    /**
     * Store newly created adaptive content
     */
    public function store(Request $request)
    {
        $this->authorize('create', AdaptiveContent::class);
        
        $validated = $request->validate([
            'course_resource_id' => 'required|exists:course_resources,id',
            'original_content' => 'required|string',
            'content_type' => 'required|in:text,video,audio,interactive,image,document',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'description' => 'nullable|string',
        ]);

        $validated['created_by_id'] = auth()->id();
        $validated['is_active'] = true;

        $adaptiveContent = AdaptiveContent::create($validated);

        return redirect()->route('adaptive-content.show', $adaptiveContent)
            ->with('success', 'Adaptive content created successfully.');
    }

    /**
     * Display the specified adaptive content
     */
    public function show(AdaptiveContent $adaptiveContent)
    {
        $this->authorize('view', $adaptiveContent);
        
        $variations = $adaptiveContent->variations()->paginate(10);

        return view('adaptive-content.show', compact('adaptiveContent', 'variations'));
    }

    /**
     * Show the form for editing adaptive content
     */
    public function edit(AdaptiveContent $adaptiveContent)
    {
        $this->authorize('update', $adaptiveContent);
        
        $courseResources = CourseResource::all();

        return view('adaptive-content.edit', compact('adaptiveContent', 'courseResources'));
    }

    /**
     * Update the specified adaptive content
     */
    public function update(Request $request, AdaptiveContent $adaptiveContent)
    {
        $this->authorize('update', $adaptiveContent);
        
        $validated = $request->validate([
            'course_resource_id' => 'required|exists:course_resources,id',
            'original_content' => 'required|string',
            'content_type' => 'required|in:text,video,audio,interactive,image,document',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $adaptiveContent->update($validated);

        return redirect()->route('adaptive-content.show', $adaptiveContent)
            ->with('success', 'Adaptive content updated successfully.');
    }

    /**
     * Remove the specified adaptive content
     */
    public function destroy(AdaptiveContent $adaptiveContent)
    {
        $this->authorize('delete', $adaptiveContent);
        
        $adaptiveContent->delete();

        return redirect()->route('adaptive-content.index')
            ->with('success', 'Adaptive content deleted successfully.');
    }

    /**
     * Get recommended content variation for a student
     */
    public function getRecommendedVariation(AdaptiveContent $adaptiveContent, Student $student)
    {
        $this->authorize('view', $adaptiveContent);
        
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
            'id' => $variation->id,
            'type' => $variation->variation_type,
            'content' => $variation->adapted_content,
            'features' => $variation->accessibility_features,
        ]);
    }

    /**
     * Create a new variation for adaptive content
     */
    public function createVariation(Request $request, AdaptiveContent $adaptiveContent)
    {
        $this->authorize('update', $adaptiveContent);
        
        $validated = $request->validate([
            'variation_type' => 'required|in:simplified,detailed,visual,audio,kinesthetic,multimodal',
            'target_disability' => 'nullable|in:hearing,visual,mobility,cognitive,learning,speech,multiple',
            'adapted_content' => 'required|string',
            'accessibility_features' => 'nullable|array',
            'is_default' => 'boolean',
            'description' => 'nullable|string',
            'recommendation_score' => 'integer|min:0|max:100',
        ]);

        $validated['adaptive_content_id'] = $adaptiveContent->id;

        $variation = AdaptiveContentVariation::create($validated);

        return redirect()->route('adaptive-content.show', $adaptiveContent)
            ->with('success', "Variation '{$validated['variation_type']}' created successfully.");
    }

    /**
     * Update a content variation
     */
    public function updateVariation(Request $request, AdaptiveContent $adaptiveContent, AdaptiveContentVariation $variation)
    {
        $this->authorize('update', $adaptiveContent);
        
        $validated = $request->validate([
            'variation_type' => 'required|in:simplified,detailed,visual,audio,kinesthetic,multimodal',
            'target_disability' => 'nullable|in:hearing,visual,mobility,cognitive,learning,speech,multiple',
            'adapted_content' => 'required|string',
            'accessibility_features' => 'nullable|array',
            'is_default' => 'boolean',
            'description' => 'nullable|string',
            'recommendation_score' => 'integer|min:0|max:100',
        ]);

        $variation->update($validated);

        return redirect()->route('adaptive-content.show', $adaptiveContent)
            ->with('success', "Variation '{$validated['variation_type']}' updated successfully.");
    }

    /**
     * Delete a content variation
     */
    public function deleteVariation(AdaptiveContent $adaptiveContent, AdaptiveContentVariation $variation)
    {
        $this->authorize('update', $adaptiveContent);
        
        $variation->delete();

        return redirect()->route('adaptive-content.show', $adaptiveContent)
            ->with('success', 'Variation deleted successfully.');
    }
}

