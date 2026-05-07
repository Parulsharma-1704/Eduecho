<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $admin = Role::findByName('admin');
        $student = Role::findByName('student');
        $educator = Role::findByName('special_educator');
        $therapist = Role::findByName('therapist');
        $careGiver = Role::findByName('care_giver');
        $supportStaff = Role::findByName('support_staff');

        // Admin: Full access to everything
        $admin->syncPermissions(Permission::all());

        // Student: View own data and participate in courses/assessments
        $student->syncPermissions([
            'view_students',
            'view_courses',
            'view_enrollments',
            'view_ieps',
            'view_therapy_sessions',
            'view_assessments',
            'view_behavioral_notes',
            'view_progress_reports',
            'view_accessibility_profiles',
            'view_disability_profiles',
            'view_messages',
            'create_messages',
            'view_notifications',
            'mark_as_read_notifications',
        ]);

        // Special Educator: Create and manage courses, IEPs, assessments
        $educator->syncPermissions([
            'view_students',
            'create_students',
            'edit_students',
            'view_courses',
            'create_courses',
            'edit_courses',
            'delete_courses',
            'view_enrollments',
            'create_enrollments',
            'edit_enrollments',
            'view_ieps',
            'create_ieps',
            'edit_ieps',
            'delete_ieps',
            'view_assessments',
            'create_assessments',
            'edit_assessments',
            'delete_assessments',
            'view_behavioral_notes',
            'create_behavioral_notes',
            'edit_behavioral_notes',
            'view_progress_reports',
            'create_progress_reports',
            'view_accessibility_profiles',
            'view_disability_profiles',
            'view_accommodations',
            'create_accommodations',
            'edit_accommodations',
            'view_messages',
            'create_messages',
            'view_notifications',
            'mark_as_read_notifications',
        ]);

        // Therapist: Manage therapy sessions and behavioral notes
        $therapist->syncPermissions([
            'view_students',
            'view_therapy_sessions',
            'create_therapy_sessions',
            'edit_therapy_sessions',
            'view_behavioral_notes',
            'create_behavioral_notes',
            'edit_behavioral_notes',
            'view_progress_reports',
            'create_progress_reports',
            'view_disability_profiles',
            'view_accessibility_profiles',
            'view_messages',
            'create_messages',
            'view_notifications',
            'mark_as_read_notifications',
        ]);

        // Care Giver: View student progress and communicate
        $careGiver->syncPermissions([
            'view_students',
            'view_courses',
            'view_enrollments',
            'view_ieps',
            'view_therapy_sessions',
            'view_progress_reports',
            'view_behavioral_notes',
            'view_accessibility_profiles',
            'view_disability_profiles',
            'view_messages',
            'create_messages',
            'view_notifications',
            'mark_as_read_notifications',
        ]);

        // Support Staff: View and assist with daily operations
        $supportStaff->syncPermissions([
            'view_students',
            'view_courses',
            'view_enrollments',
            'view_ieps',
            'view_behavioral_notes',
            'create_behavioral_notes',
            'view_progress_reports',
            'view_accessibility_profiles',
            'view_disability_profiles',
            'view_messages',
            'create_messages',
            'view_notifications',
            'mark_as_read_notifications',
        ]);
    }
}
