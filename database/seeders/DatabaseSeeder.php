<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * @var array<class-string<Seeder>>
     */
    private array $seeders = [
        UserSeeder::class,
        PropertySeeder::class,
        AmenitySeeder::class,
    ];

    /**
     * Run all the database seeders.
     */
    public function run(): void
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
