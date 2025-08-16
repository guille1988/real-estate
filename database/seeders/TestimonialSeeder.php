<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

final class TestimonialSeeder extends Seeder
{
    /**
     * @var array<int, array<string, string>>
     */
    private array $testimonials = [
        [
            'title' => 'Exceptional Service!',
            'description' => "Our experience with Real estate was outstanding. Their team's dedication and professionalism made finding our dream home a breeze. Highly recommended!",
            'name' => 'Wade Warren',
            'location' => 'USA, California',
            'thumbnail' => 'thumbnails/wade_warren.jpg',
        ],
        [
            'title' => 'Efficient and Reliable',
            'description' => "Real estate provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn't be happier with the results.",
            'name' => 'Emelie Thompson',
            'location' => 'USA, Florida',
            'thumbnail' => 'thumbnails/emelie_thompson.jpg',
        ],
        [
            'title' => 'Trusted Advisors',
            'description' => 'The Real estate team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!',
            'name' => 'John Mans',
            'location' => 'USA, Nevada',
            'thumbnail' => 'thumbnails/john_mans.jpg',
        ],
    ];

    /**
     * Deletes all the current images of the storage.
     */
    private function deleteCurrentTestimonials(): void
    {
        File::deleteDirectory(storage_path('app/public/testimonials'));
    }

    /**
     * Copies seeded images to storage.
     */
    private function copyTestimonialsToSeed(): void
    {
        File::copyDirectory(
            storage_path('app/private/seeders/testimonials'),
            storage_path('app/public/testimonials'),
        );
    }

    /**
     * Seeds all testimonials to the database.
     */
    private function seedTestimonials(): void
    {
        Testimonial::fillAndInsert($this->testimonials);
    }

    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deleteCurrentTestimonials();
        $this->copyTestimonialsToSeed();
        $this->seedTestimonials();
    }
}
