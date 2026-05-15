<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Spatie\Permission\Models\Role;

class FixUserRolesSeeder extends Seeder
{
    public function run(): void
    {
        $emails = ['ps8526397908@gmail.com', 'sharma@gmail.com'];
        $role = Role::firstOrCreate(['name' => 'student']);
        
        foreach ($emails as $email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($role);
                
                if (!$user->student) {
                    Student::create([
                        'user_id' => $user->id,
                        'enrollment_date' => $user->created_at ?? now(),
                    ]);
                }
            }
        }
    }
}
