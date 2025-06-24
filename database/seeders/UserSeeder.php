<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Guillermo Felipetti',
            'email' => 'guill388@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(config()->string('app.admin_password')),
            'is_admin' => true,
        ]);

        User::factory(10)->create();
    }
}
