<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\Property;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

final class InquirySeeder extends Seeder
{
    /**
     * @var array<int, int>
     */
    private array $lastTwelveMonthsMapping = [
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
    private array $lastSevenDaysMapping = [
        1 => 16,
        2 => 22,
        3 => 18,
        4 => 24,
        5 => 20,
        6 => 26,
        7 => 28,
    ];

    /**
     * Seed last twelve-months inquiries.
     *
     * @param  Collection<int,Property>  $properties
     */
    private function seedLastTwelveMonthsInquiries(Collection $properties): void
    {
        foreach ($this->lastTwelveMonthsMapping as $month => $count) {
            /**
             * @var CarbonImmutable $date
             */
            $date = now()->subMonths(12 - $month)
                ->startOfMonth();

            /**
             * @var Property $property
             */
            $property = $properties->first(
                fn (Property $property): bool => $property->id === $month
            );

            Inquiry::factory($count)
                ->for($property)
                ->createdOn($date)
                ->create();
        }
    }

    /**
     * Seed last seven-days inquiries.
     *
     * @param  Collection<int,Property>  $properties
     */
    private function seedLastSevenDaysInquiries(Collection $properties): void
    {
        foreach ($this->lastSevenDaysMapping as $day => $count) {
            /**
             * @var CarbonImmutable $date
             */
            $date = now()->subDays(7 - $day);

            /**
             * @var Property $property
             */
            $property = $properties->first(
                fn (Property $property): bool => $property->id === $day + 12
            );

            Inquiry::factory($count)
                ->for($property)
                ->createdOn($date)
                ->create();
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::query()
            ->limit(20)
            ->get(['id']);

        /**
         * @var Collection<int, Property> $properties
         */
        $firstTwelveProperties = $properties->take(12);

        /**
         * @var Collection<int, Property> $sevenPropertiesFromTheRest
         */
        $sevenPropertiesFromTheRest = $properties->skip(12)->take(7);

        $this->seedLastTwelveMonthsInquiries($firstTwelveProperties);
        $this->seedLastSevenDaysInquiries($sevenPropertiesFromTheRest);
    }
}
