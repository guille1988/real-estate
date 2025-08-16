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
            'title' => 'Buying a Property',
            'description' => 'Learn more about the process of purchasing a property, from start to finish.',
        ],
        [
            'title' => 'Selling a Property',
            'description' => 'Understand the steps involved in selling your home quickly and at the best price.',
        ],
        [
            'title' => 'Financing Options',
            'description' => 'Explore different mortgage and financing options available for property buyers.',
        ],
        [
            'title' => 'Legal Aspects',
            'description' => 'Get insights into the legal aspects of property transactions.',
        ],
        [
            'title' => 'Property Valuation',
            'description' => 'Find out how property values are assessed and what factors influence them.',
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
