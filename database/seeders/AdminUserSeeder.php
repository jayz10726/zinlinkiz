<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@zinlinktech.com'],
            [
                'name'     => 'zinlinktech Admin',
                'email'    => 'admin@zinlinktech.com',
                'password' => Hash::make('caston@2030@!!'),
                'is_admin' => true,
            ]
        );

        $this->command->info('✅ Admin user created: admin@zinlinktech.com / caston@2030@!!');
    }
}