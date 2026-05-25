<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseResource;
use App\Models\DisabilityProfile;
use App\Models\EducatorDisabilitySpecialization;
use App\Models\SpecialEducator;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DisabilityAwareLearningMaterialsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RoleSeeder::class);
    }

    public function test_educator_can_upload_material_matching_their_specialization()
    {
        Storage::fake('public');

        // Create educator user with 'special_educator' role
        $educatorUser = User::factory()->create();
        $educatorUser->assignRole('special_educator');
        
        $educatorProfile = SpecialEducator::create([
            'user_id' => $educatorUser->id
        ]);

        EducatorDisabilitySpecialization::create([
            'educator_id' => $educatorProfile->id,
            'disability_type' => 'visual'
        ]);

        // Create a course targeting Visual Impairment
        $course = Course::create([
            'title' => 'Visual Reading Basics',
            'description' => 'A course for visually impaired students.',
            'target_disabilities' => 'Visual Impairment',
            'support_type' => 'Audio-Based',
            'accessibility_level' => 'Beginner',
            'created_by_id' => $educatorUser->id,
            'assigned_educator_id' => $educatorUser->id,
            'is_active' => true
        ]);

        // Upload a file
        $file = UploadedFile::fake()->create('document.pdf', 500);

        $response = $this->actingAs($educatorUser)->post(route('course-resources.store'), [
            'course_id' => $course->id,
            'title' => 'Visual Study Guide',
            'resource_type' => 'pdf',
            'disability_category' => 'Visual Impairment',
            'accessibility_support_type' => 'Screen-Reader Friendly',
            'file' => $file
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $this->assertDatabaseHas('course_resources', [
            'title' => 'Visual Study Guide',
            'disability_category' => 'Visual Impairment',
            'accessibility_support_type' => 'Screen-Reader Friendly'
        ]);
    }

    public function test_educator_cannot_upload_material_mismatching_their_specialization()
    {
        Storage::fake('public');

        $educatorUser = User::factory()->create();
        $educatorUser->assignRole('special_educator');
        
        $educatorProfile = SpecialEducator::create([
            'user_id' => $educatorUser->id
        ]);

        // Specialty is only 'hearing'
        EducatorDisabilitySpecialization::create([
            'educator_id' => $educatorProfile->id,
            'disability_type' => 'hearing'
        ]);

        // Course is targeting Visual Impairment
        $course = Course::create([
            'title' => 'Visual Reading Basics',
            'description' => 'A course for visually impaired students.',
            'target_disabilities' => 'Visual Impairment',
            'support_type' => 'Audio-Based',
            'accessibility_level' => 'Beginner',
            'created_by_id' => $educatorUser->id,
            'assigned_educator_id' => $educatorUser->id,
            'is_active' => true
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 500);

        // Attempt to upload material with Visual Impairment category
        $response = $this->actingAs($educatorUser)->post(route('course-resources.store'), [
            'course_id' => $course->id,
            'title' => 'Visual Study Guide Mismatch',
            'resource_type' => 'pdf',
            'disability_category' => 'Visual Impairment',
            'accessibility_support_type' => 'Screen-Reader Friendly',
            'file' => $file
        ]);

        $response->assertSessionHasErrors(['disability_category']);
        $this->assertDatabaseMissing('course_resources', [
            'title' => 'Visual Study Guide Mismatch'
        ]);
    }

    public function test_student_secure_download_with_matching_profile_and_enrollment()
    {
        Storage::fake('public');

        // Create student and course
        $studentUser = User::factory()->create();
        $studentUser->assignRole('student');
        $studentProfile = Student::create(['user_id' => $studentUser->id]);
        DisabilityProfile::create([
            'student_id' => $studentProfile->id,
            'disability_type' => 'Visual Impairment',
            'severity' => 'Moderate'
        ]);

        $course = Course::create([
            'title' => 'Test Course',
            'description' => 'Test Description',
            'target_disabilities' => 'Visual Impairment',
            'support_type' => 'Audio-Based',
            'accessibility_level' => 'Beginner',
            'created_by_id' => 1,
            'is_active' => true
        ]);

        CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $studentProfile->id,
            'status' => 'Active',
            'enrolled_at' => now()
        ]);

        // Place a file in public fake disk
        Storage::disk('public')->put('course-resources/1/guide.pdf', 'dummy content');

        $resource = CourseResource::create([
            'course_id' => $course->id,
            'title' => 'Visual Guide Book',
            'description' => 'Visual guide',
            'resource_type' => 'pdf',
            'file_path' => 'course-resources/1/guide.pdf',
            'disability_category' => 'Visual Impairment',
            'accessibility_support_type' => 'Screen-Reader Friendly'
        ]);

        $response = $this->actingAs($studentUser)->get(route('course-resources.download', $resource->id));
        
        $response->assertStatus(200);
    }

    public function test_student_cannot_download_with_mismatched_profile()
    {
        Storage::fake('public');

        $studentUser = User::factory()->create();
        $studentUser->assignRole('student');
        $studentProfile = Student::create(['user_id' => $studentUser->id]);
        // Profile is Hearing Impairment
        DisabilityProfile::create([
            'student_id' => $studentProfile->id,
            'disability_type' => 'Hearing Impairment',
            'severity' => 'Moderate'
        ]);

        $course = Course::create([
            'title' => 'Test Course',
            'description' => 'Test Description',
            'target_disabilities' => 'Visual Impairment',
            'support_type' => 'Audio-Based',
            'accessibility_level' => 'Beginner',
            'created_by_id' => 1,
            'is_active' => true
        ]);

        CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $studentProfile->id,
            'status' => 'Active',
            'enrolled_at' => now()
        ]);

        Storage::disk('public')->put('course-resources/1/guide.pdf', 'dummy content');

        // Material is categorized under Visual Impairment
        $resource = CourseResource::create([
            'course_id' => $course->id,
            'title' => 'Visual Guide Book',
            'description' => 'Visual guide',
            'resource_type' => 'pdf',
            'file_path' => 'course-resources/1/guide.pdf',
            'disability_category' => 'Visual Impairment',
            'accessibility_support_type' => 'Screen-Reader Friendly'
        ]);

        $response = $this->actingAs($studentUser)->get(route('course-resources.download', $resource->id));
        
        $response->assertStatus(403);
    }
}
