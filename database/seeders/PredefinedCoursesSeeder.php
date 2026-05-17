<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class PredefinedCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->first();

        $adminId = $admin ? $admin->id : 1;

        $courses = [
            [
                'title' => 'Basic Mathematics',
                'description' => 'A foundational mathematics course tailored for clear understanding and pacing.',
                'target_disabilities' => 'Autism / ADHD',
                'support_type' => 'Interactive Learning',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
            [
                'title' => 'English Communication',
                'description' => 'Enhance English communication skills with visual and caption support.',
                'target_disabilities' => 'Hearing Impairment',
                'support_type' => 'Caption-Supported',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
            [
                'title' => 'Computer Basics',
                'description' => 'Learn essential computer skills with full screen-reader and audio guidance.',
                'target_disabilities' => 'Visual Impairment',
                'support_type' => 'Audio-Based',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
            [
                'title' => 'Reading & Comprehension Support',
                'description' => 'A specialized reading course utilizing dyslexia-friendly fonts and layouts.',
                'target_disabilities' => 'Dyslexia',
                'support_type' => 'Text-Based',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
            [
                'title' => 'Social Interaction Skills',
                'description' => 'Interactive scenarios and guided exercises to build social confidence.',
                'target_disabilities' => 'Autism / ADHD',
                'support_type' => 'Interactive Learning',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
            [
                'title' => 'Audio-Based Learning Skills',
                'description' => 'Develop comprehensive learning techniques using entirely audio-based materials.',
                'target_disabilities' => 'Visual Impairment',
                'support_type' => 'Audio-Based',
                'accessibility_level' => 'Beginner',
                'created_by_id' => $adminId,
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['title' => $courseData['title']],
                $courseData
            );
        }
    }
}

