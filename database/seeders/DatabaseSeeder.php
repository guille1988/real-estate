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
        PricingDetailSeeder::class,
        TestimonialSeeder::class,
        FaqSeeder::class,
        FaqItemSeeder::class,
        TeamSeeder::class,
        ClientSeeder::class,
        OfficeLocationSeeder::class,
        PropertyMessageSeeder::class,
        InquirySeeder::class,
        ContactMessageSeeder::class,
        SubscriberSeeder::class,
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
