<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PricingDetailCategoryEnum;
use App\Models\PricingDetail;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

final class PricingDetailSeeder extends Seeder
{
    /**
     * @var array<int, array<string, mixed>>
     */
    private array $pricingDetails = [
        [
            'name' => 'Property Transfer Tax',
            'description' => 'Based on the sale price and local regulations',
            'category' => PricingDetailCategoryEnum::ADDITIONAL_FEES,
            'price' => 2500000,
        ],
        [
            'name' => 'Legal Fees',
            'description' => 'Approximate cost for legal services including title transfer',
            'category' => PricingDetailCategoryEnum::ADDITIONAL_FEES,
            'price' => 300000,
        ],
        [
            'name' => 'Home Inspection',
            'description' => 'Recommended for due diligence',
            'category' => PricingDetailCategoryEnum::ADDITIONAL_FEES,
            'price' => 50000,
        ],
        [
            'name' => 'Property Insurance',
            'description' => 'Annual cost for comprehensive property insurance',
            'category' => PricingDetailCategoryEnum::ADDITIONAL_FEES,
            'price' => 120000,
        ],
        [
            'name' => 'Brokerage Fees',
            'description' => 'If applicable, consult with your broker for specific details',
            'category' => PricingDetailCategoryEnum::ADDITIONAL_FEES,
            'price' => 0,
        ],
        [
            'name' => 'Property Taxes',
            'description' => 'Approximate monthly property tax based on the sale price and local rates',
            'category' => PricingDetailCategoryEnum::MONTHLY_COSTS,
            'price' => 125000,
        ],
        [
            'name' => 'HOA Association Fee',
            'description' => 'Monthly fee for common area maintenance and security',
            'category' => PricingDetailCategoryEnum::MONTHLY_COSTS,
            'price' => 30000,
        ],
        [
            'name' => 'Listing Price',
            'description' => '',
            'category' => PricingDetailCategoryEnum::TOTAL_INITIAL_COSTS,
            'price' => 125000000,
        ],
        [
            'name' => 'Additional Fees',
            'description' => 'Property transfer tax, legal fees, inspection, insurance',
            'category' => PricingDetailCategoryEnum::TOTAL_INITIAL_COSTS,
            'price' => 2970000,
        ],
        [
            'name' => 'Down Payment',
            'description' => '20%',
            'category' => PricingDetailCategoryEnum::TOTAL_INITIAL_COSTS,
            'price' => 25000000,
        ],
        [
            'name' => 'Mortgage Amount',
            'description' => 'If applicable',
            'category' => PricingDetailCategoryEnum::TOTAL_INITIAL_COSTS,
            'price' => 100000000,
        ],
        [
            'name' => 'Property Taxes',
            'description' => '',
            'category' => PricingDetailCategoryEnum::MONTHLY_EXPENSES,
            'price' => 125000,
        ],
        [
            'name' => 'HOA Association Fee',
            'description' => '',
            'category' => PricingDetailCategoryEnum::MONTHLY_EXPENSES,
            'price' => 30000,
        ],
        [
            'name' => 'Mortgage Payment',
            'description' => 'Varies based on terms and interest rate',
            'category' => PricingDetailCategoryEnum::MONTHLY_EXPENSES,
            'price' => 0,
        ],
        [
            'name' => 'Property Insurance',
            'description' => 'Approximate monthly cost',
            'category' => PricingDetailCategoryEnum::MONTHLY_EXPENSES,
            'price' => 10000,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::query()
            ->get('id')
            ->flatMap(function (Property $property): array {
                return array_map(function (array $pricingDetail) use ($property): array {
                    $pricingDetail['property_id'] = $property->id;

                    return $pricingDetail;
                }, $this->pricingDetails);
            })
            ->lazy()
            ->chunk(100)
            ->each(function (LazyCollection $pricingDetailsChunk): void {
                /**
                 * @var array<int, array<string, mixed>> $pricingDetails
                 */
                $pricingDetails = $pricingDetailsChunk->toArray();

                PricingDetail::fillAndInsert($pricingDetails);
            });
    }
}
