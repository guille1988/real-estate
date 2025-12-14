<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

final class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now()->toImmutable();

        $lastMonth = $now->subMonth()
            ->startOfMonth();

        ContactMessage::factory(21)
            ->createdOn($lastMonth)
            ->create();

        ContactMessage::factory(20)
            ->createdOn($now)
            ->create();
    }
}
