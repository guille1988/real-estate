<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PropertyMessage;
use Illuminate\Database\Seeder;

final class PropertyMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyMessage::factory(20)->create();
    }
}
