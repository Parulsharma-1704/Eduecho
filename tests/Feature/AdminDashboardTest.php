<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_pending_course_enrollments_correctly()
    {
        // Seed Spatie roles/permissions
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);

        // Create Admin
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create Student & Course
        $studentUser = User::factory()->create();
        $studentUser->assignRole('student');
        $student = Student::create(['user_id' => $studentUser->id, 'enrollment_date' => now()]);

        $course = Course::create([
            'title' => 'Test Accessibility Course',
            'description' => 'Test course description',
            'created_by_id' => $admin->id,
            'is_active' => true,
            'support_type' => 'Visual-Audio',
            'target_disabilities' => 'visual',
            'accessibility_level' => 'High',
        ]);

        // Create pending enrollment request
        $enrollment = CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'Pending',
            'enrolled_at' => now(),
        ]);

        // Act as Admin and hit Dashboard
        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Pending Course Enrollments');
        $response->assertSee('Wants to enroll in:');
        $response->assertSee('Test Accessibility Course');
        $response->assertSee($studentUser->name);
    }

    public function test_admin_can_approve_pending_course_enrollments()
    {
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);

        // Create Admin
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create Student & Course
        $studentUser = User::factory()->create();
        $studentUser->assignRole('student');
        $student = Student::create(['user_id' => $studentUser->id, 'enrollment_date' => now()]);

        $course = Course::create([
            'title' => 'Test Accessibility Course',
            'description' => 'Test course description',
            'created_by_id' => $admin->id,
            'is_active' => true,
            'support_type' => 'Visual-Audio',
            'target_disabilities' => 'visual',
            'accessibility_level' => 'High',
        ]);

        // Create pending enrollment request
        $enrollment = CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'Pending',
            'enrolled_at' => now(),
        ]);

        // Approve via route
        $response = $this->actingAs($admin)->patch(route('admin.courses.approve-enrollment', $enrollment->id));

        $response->assertRedirect();
        
        // Assert enrollment is now active
        $this->assertEquals('Active', $enrollment->fresh()->status);
    }
}
