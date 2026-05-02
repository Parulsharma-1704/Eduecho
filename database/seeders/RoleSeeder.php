<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create core roles for the education ecosystem
        $roles = [
            'admin' => 'System administrator with full access',
            'student' => 'Student user accessing courses and assessments',
            'special_educator' => 'Special educator creating courses and IEPs',
            'therapist' => 'Therapist managing therapy sessions and notes',
            'care_giver' => 'Care giver or parent monitoring student progress',
            'support_staff' => 'Support staff assisting with daily operations',
        ];

        foreach ($roles as $role => $description) {
            Role::firstOrCreate(
                ['name' => $role],
                ['guard_name' => 'web']
            );
        }
    }
}
