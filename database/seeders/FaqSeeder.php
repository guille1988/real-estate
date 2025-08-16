<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

final class FaqSeeder extends Seeder
{
    /**
     * @var array<int, array<string, string>>
     */
    private array $faq = [
        [
            'title' => 'How do I search for properties on Real estate?',
            'description' => 'Learn how to use our user-friendly search tools to find properties that match your criteria.',
        ],
        [
            'title' => 'What documents do I need to sell my property through Real estate?',
            'description' => 'Find out about the necessary documentation for listing your property with us.',
        ],
        [
            'title' => 'How can I contact an Real estate agent?',
            'description' => 'Discover the different ways you can get in touch with our experienced agents.',
        ],
        [
            'title' => 'What are the benefits of working with Real estate?',
            'description' => 'Learn about the advantages of choosing our agency for your real estate needs.',
        ],
        [
            'title' => 'How does the property buying process work?',
            'description' => 'Get a step-by-step overview of the property buying journey with Real estate.',
        ],
        [
            'title' => 'What financing options are available for buyers?',
            'description' => 'Explore the various financing solutions we can help you access for your property purchase.',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::fillAndInsert($this->faq);
    }
}
