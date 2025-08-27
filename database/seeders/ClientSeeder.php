<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

final class ClientSeeder extends Seeder
{
    private array $clients = [
        [
            'since' => 2019,
            'url' => 'https://www.google.com',
            'company' => 'ABC Corporation',
            'domain' => 'Commercial Real State',
            'category' => 'Luxury Home Development',
            'opinion' => "Real estate's expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.",
        ],
        [
            'since' => 2018,
            'url' => 'https://www.google.com',
            'company' => 'GreenTech Enterprises',
            'domain' => 'Commercial Real State',
            'category' => 'Retail Space',
            'opinion' => "Real estate's ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.",
        ],
        [
            'since' => 2020,
            'url' => 'https://www.google.com',
            'company' => 'TechSolutions Inc',
            'domain' => 'Commercial Real State',
            'category' => 'Office Space',
            'opinion' => 'Working with Real estate has been a game-changer for our business. Their expertise in finding the perfect location for our headquarters was exceptional.',
        ],
        [
            'since' => 2017,
            'url' => 'https://www.google.com',
            'company' => 'Global Ventures',
            'domain' => 'Residential Real State',
            'category' => 'Luxury Apartments',
            'opinion' => "Real estate's team went above and beyond to understand our specific needs. Their attention to detail and market knowledge is unmatched.",
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::fillAndInsert($this->clients);
    }
}
