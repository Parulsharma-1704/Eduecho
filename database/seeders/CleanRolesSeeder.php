<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class CleanRolesSeeder extends Seeder
{
    public function run(): void
    {
        $primaryRoles = ['admin', 'student', 'special_educator', 'therapist'];
        
        // Delete roles that are not in the primary list
        $rolesToDelete = Role::whereNotIn('name', $primaryRoles)->get();
        
        foreach ($rolesToDelete as $role) {
            // Remove role from all users first (Spatie does this automatically on delete, but let's be sure)
            $role->delete();
        }
    }
}
