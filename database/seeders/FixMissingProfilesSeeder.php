<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;

class FixMissingProfilesSeeder extends Seeder
{
    public function run(): void
    {
        $studentUsers = User::role('student')->get();
        
        foreach ($studentUsers as $user) {
            if (!$user->student) {
                Student::create([
                    'user_id' => $user->id,
                    'enrollment_date' => $user->created_at ?? now(),
                ]);
            }
        }
    }
}
