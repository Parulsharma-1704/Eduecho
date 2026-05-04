<?php

namespace Database\Seeders;

use App\Models\AdaptiveContent;
use App\Models\AdaptiveContentVariation;
use App\Models\CourseResource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdaptiveContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educator = User::where('email', 'educator@example.com')->first();
        if (!$educator) {
            $educator = User::first();
        }

        $resources = CourseResource::all();
        if ($resources->isEmpty()) {
            return;
        }

        foreach ($resources->take(3) as $resource) {
            // Create adaptive content for this resource
            $adaptiveContent = AdaptiveContent::create([
                'course_resource_id' => $resource->id,
                'original_content' => "Original content for: {$resource->title}. This is the standard content that will be adapted for students with different learning needs and disabilities.",
                'content_type' => fake()->randomElement(['text', 'video', 'audio', 'interactive']),
                'difficulty_level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
                'created_by_id' => $educator->id,
                'description' => "Adaptive content variations for {$resource->title}",
                'is_active' => true,
            ]);

            // Create variations for hearing impairment (with captions/transcripts)
            AdaptiveContentVariation::create([
                'adaptive_content_id' => $adaptiveContent->id,
                'variation_type' => 'detailed',
                'target_disability' => 'hearing',
                'adapted_content' => "[CAPTIONS] Detailed transcript and visual descriptions for hearing impaired students. All audio content is transcribed with speaker identification and sound effect descriptions.",
                'accessibility_features' => ['captions', 'transcript', 'visual_descriptions'],
                'is_default' => false,
                'recommendation_score' => 95,
                'description' => 'Enhanced with captions and transcripts for hearing impaired students',
            ]);

            // Create variations for visual impairment (audio focused)
            AdaptiveContentVariation::create([
                'adaptive_content_id' => $adaptiveContent->id,
                'variation_type' => 'audio',
                'target_disability' => 'visual',
                'adapted_content' => "[AUDIO DESCRIPTION] Detailed audio narration describing all visual elements. This variation emphasizes auditory learning with comprehensive descriptions of images, charts, and visual information.",
                'accessibility_features' => ['audio_description', 'screen_reader_optimized', 'no_images'],
                'is_default' => false,
                'recommendation_score' => 90,
                'description' => 'Audio-focused with comprehensive descriptions for visually impaired students',
            ]);

            // Create variation for cognitive disability (simplified)
            AdaptiveContentVariation::create([
                'adaptive_content_id' => $adaptiveContent->id,
                'variation_type' => 'simplified',
                'target_disability' => 'cognitive',
                'adapted_content' => "[SIMPLIFIED] Shorter sentences. Fewer concepts per section. Key points highlighted. Visual diagrams to help understanding.",
                'accessibility_features' => ['simple_language', 'short_sentences', 'visual_aids', 'key_points_highlighted'],
                'is_default' => false,
                'recommendation_score' => 85,
                'description' => 'Simplified content for students with cognitive disabilities',
            ]);

            // Create variation for learning disability (kinesthetic)
            AdaptiveContentVariation::create([
                'adaptive_content_id' => $adaptiveContent->id,
                'variation_type' => 'kinesthetic',
                'target_disability' => 'learning',
                'adapted_content' => "[KINESTHETIC] Interactive activities and hands-on learning. Practice exercises with immediate feedback. Step-by-step tutorials with animations.",
                'accessibility_features' => ['interactive_activities', 'hands_on_learning', 'animations', 'immediate_feedback'],
                'is_default' => false,
                'recommendation_score' => 88,
                'description' => 'Interactive kinesthetic approach for students with learning disabilities',
            ]);

            // Create multimodal default variation
            AdaptiveContentVariation::create([
                'adaptive_content_id' => $adaptiveContent->id,
                'variation_type' => 'multimodal',
                'target_disability' => 'multiple',
                'adapted_content' => "[MULTIMODAL] Combines text, audio, visuals, and interactive elements. Supports multiple learning styles simultaneously. Allows student preference selection.",
                'accessibility_features' => ['text', 'audio', 'visual', 'interactive', 'student_preference_selection'],
                'is_default' => true,
                'recommendation_score' => 80,
                'description' => 'Universal Design for Learning - accessible to all students',
            ]);
        }
    }
}

