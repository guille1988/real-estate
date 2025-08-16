<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\ImageBuilder;
use Carbon\CarbonImmutable;
use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $path
 *  @property-read bool $is_default
 *  @property-read int $property_id
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
#[UseEloquentBuilder(ImageBuilder::class)]
final class Image extends Model
{
    /** @use HasFactory<ImageFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // @pest-arch-ignore-line
    {
        return ['is_default' => 'boolean'];
    }

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

    /**
     * Get the property that owns the image.
     *
     * @return BelongsTo<Property, $this>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /*
     * Returns the image url.
     */
    public function getUrl(): string
    {
        return Storage::disk('images')
            ->url($this->path);
    }
}
