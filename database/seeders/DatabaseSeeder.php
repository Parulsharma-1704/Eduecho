<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\SpecialEducator;
use App\Models\Therapist;
use App\Models\CareGiver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run role and permission seeders
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdaptiveContentSeeder::class,
        ]);

        // Create test users for each role
        $users = [
            ['name' => 'Admin User', 'email' => 'rashmipandit678@gmail.com', 'role' => 'admin'],
            ['name' => 'John Student', 'email' => 'student@test.com', 'role' => 'student'],
            ['name' => 'Sarah Educator', 'email' => 'educator@test.com', 'role' => 'special_educator'],
            ['name' => 'Dr. Thompson', 'email' => 'therapist@test.com', 'role' => 'therapist'],
            ['name' => 'Maria Garcia', 'email' => 'caregiver@test.com', 'role' => 'care_giver'],
            ['name' => 'Mike Support', 'email' => 'support@test.com', 'role' => 'support_staff'],
        ];

        foreach ($users as $userData) {
            $user = User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
            ]);
            
            // Assign role
            $user->assignRole($userData['role']);

            // Create related records for specific roles
            if ($userData['role'] === 'student') {
                Student::firstOrCreate([
                    'user_id' => $user->id,
                ], [
                    'enrollment_date' => now(),
                ]);
            } elseif ($userData['role'] === 'special_educator') {
                SpecialEducator::firstOrCreate([
                    'user_id' => $user->id,
                ]);
            } elseif ($userData['role'] === 'therapist') {
                Therapist::firstOrCreate([
                    'user_id' => $user->id,
                ]);
            } elseif ($userData['role'] === 'care_giver') {
                CareGiver::firstOrCreate([
                    'user_id' => $user->id,
                ], [
                    'relation_to_student' => 'Parent',
                ]);
            }
        }
    }
}
