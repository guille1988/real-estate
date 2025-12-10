<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PropertyMessage;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

final class PropertyMessageSeeder extends Seeder
{
    /**
     * @var array<int, int>
     */
    private array $lastYearMapping = [
        1 => 16,
        2 => 22,
        3 => 18,
        4 => 24,
        5 => 20,
        6 => 26,
        7 => 28,
        8 => 29,
        9 => 30,
        10 => 43,
        11 => 54,
        12 => 68,
    ];

    /**
     * @var array<int, int>
     */
    private array $lastWeekMapping = [
        1 => 16,
        2 => 22,
        3 => 18,
        4 => 24,
        5 => 20,
        6 => 26,
        7 => 28,
    ];

    /*
     * Seed last year's property messages.
     */
    private function seedLastYearPropertyMessages(): void
    {
        foreach ($this->lastYearMapping as $month => $count) {
            /**
             * @var CarbonImmutable $date
             */
            $date = now()->subMonths(12 - $month)
                ->startOfMonth();

            PropertyMessage::factory($count)
                ->createdOn($date)
                ->create();
        }
    }

    /*
     * Seed last week property messages.
     */
    private function seedLastWeekPropertyMessages(): void
    {
        foreach ($this->lastWeekMapping as $day => $count) {
            /**
             * @var CarbonImmutable $date
             */
            $date = now()->subDays(7 - $day);

            PropertyMessage::factory($count)
                ->createdOn($date)
                ->create();
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedLastYearPropertyMessages();
        $this->seedLastWeekPropertyMessages();
    }
}
