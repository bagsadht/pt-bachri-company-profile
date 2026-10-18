<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['admin@bachrisamudera.id', 'Admin', User::ROLE_ADMIN, config('admin.password')],
            ['hrd@bachrisamudera.id',   'HRD',   User::ROLE_HRD,   config('admin.hrd_password')],
        ];

        foreach ($accounts as [$email, $name, $role, $password]) {
            if (blank($password)) {
                throw new \RuntimeException("Password untuk {$email} belum diatur di .env");
            }

            User::updateOrCreate(
                ['email' => $email],
                ['name' => $name, 'role' => $role, 'password' => $password]
            );
        }
    }
}