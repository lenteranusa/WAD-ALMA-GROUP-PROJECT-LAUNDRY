<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['Admin',    'admin@dondone.test',    'admin', true],
            ['Staff',    'staff@dondone.test',    'staff', true],
            ['Inactive', 'inactive@dondone.test', 'staff', false],
        ];

        foreach ($accounts as [$name, $email, $role, $active]) {
            // Safe to run more than once: existing emails are updated, not duplicated.
            $user = User::firstOrNew(['email' => $email]);
            $user->forceFill([
                'name'      => $name,
                'password'  => Hash::make('password'),
                'role'      => $role,
                'is_active' => $active,
            ])->save();
        }
    }
}
