<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Database\Seeder;

final class InquirySeeder extends Seeder
{
    /*
     * Seed inquiries for each property if
     * there are any properties in the database.
     */
    private function seedInquiries(): void
    {
        $properties = Property::limit(10)->get(['id']);

        if ($properties->isEmpty()) {
            Inquiry::factory(10)->create();

            return;
        }

        $properties->each(function (Property $property): void {
            Inquiry::factory()
                ->for($property)
                ->create();
        });
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedInquiries();
    }
}
