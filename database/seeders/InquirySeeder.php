<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

final class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inquiry::factory(10)->create();
    }
}
