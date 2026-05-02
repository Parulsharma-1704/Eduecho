<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permission groups and their actions
        $resources = [
            'students' => ['view', 'create', 'edit', 'delete'],
            'courses' => ['view', 'create', 'edit', 'delete'],
            'enrollments' => ['view', 'create', 'edit', 'delete'],
            'ieps' => ['view', 'create', 'edit', 'delete'],
            'therapy_sessions' => ['view', 'create', 'edit', 'delete'],
            'assessments' => ['view', 'create', 'edit', 'delete'],
            'behavioral_notes' => ['view', 'create', 'edit', 'delete'],
            'progress_reports' => ['view', 'create', 'edit', 'delete'],
            'accessibility_profiles' => ['view', 'create', 'edit', 'delete'],
            'disability_profiles' => ['view', 'create', 'edit', 'delete'],
            'accommodations' => ['view', 'create', 'edit', 'delete'],
            'messages' => ['view', 'create', 'edit', 'delete'],
            'notifications' => ['view', 'mark_as_read'],
            'users' => ['view', 'create', 'edit', 'delete'],
            'roles' => ['view', 'assign'],
            'compliance_logs' => ['view', 'create'],
            'accessibility_audits' => ['view', 'create', 'edit'],
        ];

        // Create all permissions
        foreach ($resources as $resource => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(
                    ['name' => "{$action}_{$resource}"],
                    ['guard_name' => 'web']
                );
            }
        }
    }
}
