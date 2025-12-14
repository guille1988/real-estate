<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

final class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now()->toImmutable();

        $lastMonth = $now->subMonth()
            ->startOfMonth();

        Subscriber::factory(20)
            ->createdOn($lastMonth)
            ->create();

        Subscriber::factory(22)
            ->createdOn($now)
            ->create();
    }
}
