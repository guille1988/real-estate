<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Creates admin user.
     */
    private function seedAdmin(): void
    {
        User::create([
            'name' => 'Guillermo Felipetti',
            'email' => 'guill388@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('gf33238307'),
            'is_admin' => true,
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAdmin();
        User::factory(10)->create();
    }
}
