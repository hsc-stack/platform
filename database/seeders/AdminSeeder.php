<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => config('app.admin_email')],
            [
                'name'              => config('app.admin_name', 'ADMIN'),
                'password'          => Hash::make(config('app.admin_password')),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');

        $manager = User::updateOrCreate(
            ['email' => "check@example.com"],
            [
                'name'              => "manager",
                'password'          => Hash::make('check123'),
                'email_verified_at' => now(),
            ]
        );

        $manager->assignRole('manager');
    }
}
