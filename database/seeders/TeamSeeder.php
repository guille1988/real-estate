<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

final class TeamSeeder extends Seeder
{
    /**
     * @var array<int, array<string, string>>
     */
    private array $team = [
        [
            'name' => 'Max Mitchell',
            'position' => 'Founder',
            'thumbnail' => 'thumbnails/max_mitchell.jpg',
        ],
        [
            'name' => 'Sarah Johnson',
            'position' => 'Chief Real Estate Officer',
            'thumbnail' => 'thumbnails/sara_johnson.jpg',
        ],
        [
            'name' => 'David Brown',
            'position' => 'Head of Property Management',
            'thumbnail' => 'thumbnails/david_brown.jpg',
        ],
        [
            'name' => 'Michael Turner',
            'position' => 'Legal Counsel',
            'thumbnail' => 'thumbnails/michael_turner.jpg',
        ],
        [
            'name' => 'Ian McHill',
            'position' => 'Accountant',
            'thumbnail' => 'thumbnails/ian_mc_hill.jpg',
        ],
        [
            'name' => 'Devon Mills',
            'position' => 'Surveyor',
            'thumbnail' => 'thumbnails/devon_mills.jpg',
        ],
    ];

    /**
     * Deletes all the current images of the storage.
     */
    private function deleteCurrentTeam(): void
    {
        File::deleteDirectory(storage_path('app/public/team'));
    }

    /**
     * Copies seeded images to storage.
     */
    private function copyTeamToSeed(): void
    {
        File::copyDirectory(
            storage_path('app/private/seeders/team'),
            storage_path('app/public/team'),
        );
    }

    /**
     * Seeds all testimonials to the database.
     */
    private function seedTeam(): void
    {
        Team::fillAndInsert($this->team);
    }

    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deleteCurrentTeam();
        $this->copyTeamToSeed();
        $this->seedTeam();
    }
}
