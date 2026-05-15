<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        
        $admins = [
            'parul900174@gmail.com',
            'rashmipandit678@gmail.com',
            'rashmipandit768@gmail.com',
            'rashmipandit6789@gmail.com'
        ];

        foreach ($admins as $email) {
            $admin = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'System Admin',
                    'password' => Hash::make('admin123'),
                    'email_verified_at' => now(),
                ]
            );

            $admin->assignRole($role);
        }
    }
}
