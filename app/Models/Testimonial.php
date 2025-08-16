<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\TestimonialFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $name
 *  @property-read string $thumbnail
 *  @property-read string $location
 *  @property-read string $title
 *  @property-read string $description
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class Testimonial extends Model
{
    /** @use HasFactory<TestimonialFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'testimonials';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * Get the field to use on route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Get the fields from which will be unique.
     *
     * @return list<string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /*
     * Returns the thumbnail url.
     */
    public function getUrl(): string
    {
        return Storage::disk('testimonials')
            ->url($this->thumbnail);
    }
}
