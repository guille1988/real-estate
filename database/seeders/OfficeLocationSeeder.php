<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\OfficeLocationTypeEnum;
use App\Models\OfficeLocation;
use Illuminate\Database\Seeder;

final class OfficeLocationSeeder extends Seeder
{
    /**
     * @var array<int, array<string,OfficeLocationTypeEnum|string>>
     */
    private array $officeLocations = [
        [
            'email' => 'main@realestate.com',
            'type' => OfficeLocationTypeEnum::REGIONAL,
            'title' => 'Main Headquarters',
            'address' => '123 Real estate Plaza, City Center, Metropolis',
            'description' => 'Our main headquarters serve as the heart of Real estate. Located in the bustling city center, this is where our core team of experts operates, driving the excellence and innovation that define us.',
            'phone' => '+1 123 456-7890',
            'location' => 'Metropolis',
            'url' => 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
        ],
        [
            'email' => 'regional@realestate.com',
            'type' => OfficeLocationTypeEnum::REGIONAL,
            'title' => 'Regional Offices',
            'address' => '456 Urban Avenue, Downtown District, Metropolis',
            'description' => "Real estate's presence extends to multiple regions, each with its own dynamic real estate landscape. Discover our regional offices, staffed by local experts who understand the nuances of their respective markets.",
            'phone' => '+1 123 456-7890',
            'location' => 'Metropolis',
            'url' => 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
        ],
        [
            'email' => 'international@realestate.com',
            'type' => OfficeLocationTypeEnum::INTERNATIONAL,
            'title' => 'International Headquarters',
            'address' => '789 Global Tower, Financial District, London',
            'description' => 'Our international headquarters connects Real estate to the global real estate market. Located in the heart of London, this office serves as our gateway to international clients and opportunities.',
            'phone' => '+44 20 1234-5678',
            'location' => 'London',
            'url' => 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficeLocation::fillAndInsert($this->officeLocations);
    }
}
