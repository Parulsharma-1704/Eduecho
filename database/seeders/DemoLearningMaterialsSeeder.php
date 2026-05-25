<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\CourseResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DemoLearningMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            // Visual Impairment
            [
                'course_title' => 'Audio-Based Learning Skills',
                'title' => 'Audio Mathematics Lesson',
                'description' => 'A comprehensive audio explanation covering foundational arithmetic, operations, and mental math tricks.',
                'resource_type' => 'audio',
                'disability_category' => 'Visual Impairment',
                'accessibility_support_type' => 'Audio-Based',
                'has_audio_description' => true,
                'has_captions' => false,
                'has_transcript' => true,
                'text_size_options' => false,
                'high_contrast_version' => false,
                'dummy_filename' => 'audio_mathematics_lesson.mp3',
                'dummy_content' => 'MP3 Audio Content Placeholder: Welcome to foundational math tricks audio lesson!'
            ],
            [
                'course_title' => 'Computer Basics',
                'title' => 'Screen-reader-friendly Notes',
                'description' => 'Plain-text and screen-reader optimized study notes describing keyboard layouts, shortcuts, and basic navigations.',
                'resource_type' => 'pdf',
                'disability_category' => 'Visual Impairment',
                'accessibility_support_type' => 'Screen-Reader Friendly',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => true,
                'high_contrast_version' => false,
                'dummy_filename' => 'screen_reader_friendly_notes.pdf',
                'dummy_content' => 'PDF Document Content Placeholder: Screen-Reader Navigational Notes and Shortcuts.'
            ],
            [
                'course_title' => 'Audio-Based Learning Skills',
                'title' => 'Large Text Reading Material',
                'description' => 'Clean, structured text documents featuring adjustable large typography options to support low-vision students.',
                'resource_type' => 'reading',
                'disability_category' => 'Visual Impairment',
                'accessibility_support_type' => 'Screen-Reader Friendly',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => true,
                'high_contrast_version' => true,
                'dummy_filename' => 'large_text_reading_material.txt',
                'dummy_content' => 'Reading Material: Large-typography compatible transcript for audio learning.'
            ],

            // Hearing Impairment
            [
                'course_title' => 'English Communication',
                'title' => 'Caption-supported English Video',
                'description' => 'A beginner video guide demonstrating everyday communication and conversational cues with full professional subtitles.',
                'resource_type' => 'video',
                'disability_category' => 'Hearing Impairment',
                'accessibility_support_type' => 'Caption-Supported',
                'has_audio_description' => false,
                'has_captions' => true,
                'has_transcript' => true,
                'text_size_options' => false,
                'high_contrast_version' => false,
                'dummy_filename' => 'caption_supported_english.mp4',
                'dummy_content' => 'MP4 Video Content Placeholder: Welcome to English Communication Video with Captions!'
            ],
            [
                'course_title' => 'English Communication',
                'title' => 'Text-Based Communication Notes',
                'description' => 'Full transcript, key takeaways, and illustrative conversational scripts for sign-supported communication courses.',
                'resource_type' => 'pdf',
                'disability_category' => 'Hearing Impairment',
                'accessibility_support_type' => 'Caption-Supported',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => true,
                'text_size_options' => true,
                'high_contrast_version' => false,
                'dummy_filename' => 'text_based_communication_notes.pdf',
                'dummy_content' => 'PDF Document Content Placeholder: Communication Scripts and Full Audio Transcript.'
            ],

            // Dyslexia
            [
                'course_title' => 'Reading & Comprehension Support',
                'title' => 'Simplified Reading Worksheets',
                'description' => 'Reading worksheets utilizing OpenDyslexic typeface, high letter-spacing, and warm background visual colors.',
                'resource_type' => 'reading',
                'disability_category' => 'Dyslexia',
                'accessibility_support_type' => 'Dyslexia-Friendly',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => true,
                'high_contrast_version' => true,
                'dummy_filename' => 'simplified_reading_worksheets.txt',
                'dummy_content' => 'Dyslexia reading worksheet with open-dyslexic spacing.'
            ],
            [
                'course_title' => 'Reading & Comprehension Support',
                'title' => 'Dyslexia-Friendly Notes',
                'description' => 'Core lecture notes compiled using structured layouts, custom spacing, and high-contrast color formatting.',
                'resource_type' => 'pdf',
                'disability_category' => 'Dyslexia',
                'accessibility_support_type' => 'Dyslexia-Friendly',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => true,
                'high_contrast_version' => true,
                'dummy_filename' => 'dyslexia_friendly_notes.pdf',
                'dummy_content' => 'PDF Document Content Placeholder: Lecture notes with specialized high-contrast formatting.'
            ],

            // Autism / ADHD
            [
                'course_title' => 'Basic Mathematics',
                'title' => 'Structured Activity-Based Lessons',
                'description' => 'A mathematics workbook divided into highly visual, structured sub-sections with immediate answer feedback.',
                'resource_type' => 'reading',
                'disability_category' => 'Autism / ADHD',
                'accessibility_support_type' => 'Interactive Learning',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => false,
                'high_contrast_version' => true,
                'dummy_filename' => 'structured_activity_lessons.txt',
                'dummy_content' => 'Structured Activity: Visual and step-by-step arithmetic operations workbook.'
            ],
            [
                'course_title' => 'Social Interaction Skills',
                'title' => 'Step-by-Step Interactive Modules',
                'description' => 'A bite-sized interactive scenario module designed to guide behavioral and collaborative social exercises.',
                'resource_type' => 'interactive',
                'disability_category' => 'Autism / ADHD',
                'accessibility_support_type' => 'Interactive Learning',
                'has_audio_description' => false,
                'has_captions' => false,
                'has_transcript' => false,
                'text_size_options' => true,
                'high_contrast_version' => true,
                'dummy_filename' => 'step_by_step_interactive.html',
                'dummy_content' => '<html><body><h1>Step-by-Step Interactive Learning Module</h1></body></html>'
            ],
        ];

        // Ensure storage directory exists
        if (!File::exists(storage_path('app/public/course-resources'))) {
            File::makeDirectory(storage_path('app/public/course-resources'), 0755, true);
        }

        foreach ($materials as $matData) {
            $course = Course::where('title', $matData['course_title'])->first();
            if ($course) {
                // Ensure sub-directory for course exists
                $courseSubDir = 'course-resources/' . $course->id;
                if (!File::exists(storage_path('app/public/' . $courseSubDir))) {
                    File::makeDirectory(storage_path('app/public/' . $courseSubDir), 0755, true);
                }

                $filePath = $courseSubDir . '/' . $matData['dummy_filename'];
                
                // Write dummy file
                File::put(storage_path('app/public/' . $filePath), $matData['dummy_content']);

                // Create CourseResource record
                CourseResource::firstOrCreate(
                    [
                        'course_id' => $course->id,
                        'title' => $matData['title'],
                    ],
                    [
                        'description' => $matData['description'],
                        'resource_type' => $matData['resource_type'],
                        'file_path' => $filePath,
                        'disability_category' => $matData['disability_category'],
                        'accessibility_support_type' => $matData['accessibility_support_type'],
                        'has_audio_description' => $matData['has_audio_description'],
                        'has_captions' => $matData['has_captions'],
                        'has_transcript' => $matData['has_transcript'],
                        'text_size_options' => $matData['text_size_options'],
                        'high_contrast_version' => $matData['high_contrast_version'],
                    ]
                );
            }
        }
    }
}
