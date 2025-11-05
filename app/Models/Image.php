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

    /*
     * Returns the image url.
     */
    public function getUrl(): string
    {
        return Storage::disk('images')
            ->url($this->path);
    }

    /*
     * Returns if the image is the default one.
     */
    public function isDefault(): bool
    {
        return $this->is_default;
    }

    /*
     * Returns if the image is not the default one.
     */
    public function isNotDefault(): bool
    {
        return ! $this->isDefault();
    }

    /*
     * Returns the folder path of the image.
     */
    public function getFolderPath(): string
    {
        return str($this->path)
            ->beforeLast('/')
            ->toString();
    }

    /*
     * Deletes the image completely from
     * the storage and the database.
     */
    public function deleteCompletely(): void
    {
        $wasDeleted = Storage::disk('images')
            ->delete($this->path);

        if ($wasDeleted) {
            $this->delete();
            $this->deleteFolderIfEmpty();
        }
    }

    /*
     * Deletes the folder if it is empty.
     */
    public function deleteFolderIfEmpty(): void
    {
        $remainingFiles = Storage::disk('images')
            ->allFiles($this->getFolderPath());

        if (count($remainingFiles) === 0) {
            Storage::disk('images')
                ->deleteDirectory($this->getFolderPath());
        }
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
}
