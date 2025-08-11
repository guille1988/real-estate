<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\PropertyBuilder;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use Carbon\CarbonImmutable;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Number;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $caption
 *  @property-read string $title
 *  @property-read string $description
 *  @property-read string $address
 *  @property-read PropertyTypeEnum $type
 *  @property-read PropertyLocationEnum $location
 *  @property-read int $bathrooms
 *  @property-read int $bedrooms
 *  @property-read int $area
 *  @property-read int $price
 *  @property-read bool $is_featured
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
#[UseEloquentBuilder(PropertyBuilder::class)]
final class Property extends Model
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'properties';

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
        return [
            'type' => PropertyTypeEnum::class,
            'location' => PropertyLocationEnum::class,
            'is_featured' => 'boolean',
        ];
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
     * Formats the price to dollar.
     */
    public function getDollarPrice(): string
    {
        /** @var string */
        return Number::currency(
            number: $this->price,
            in: 'USD',
            precision: 0,
        );
    }

    /*
     * Formats the bathrooms and bedrooms to have a left pad.
     */
    public function getBathroomWithLeftPad(): string
    {
        return str((string) $this->bathrooms)
            ->padLeft(2, '0')
            ->toString();
    }

    /*
     * Formats the bathrooms and bedrooms to have a left pad.
     */
    public function getBedroomWithLeftPad(): string
    {
        return str((string) $this->bedrooms)
            ->padLeft(2, '0')
            ->toString();
    }

    /*
     * Formats the area to square feet.
     */
    public function getAreaOnSquareFeet(): string
    {
        /**
         * @var string $area
         */
        $area = Number::format($this->area);

        return str($area)
            ->append(' Square Feet')
            ->toString();
    }

    /*
     * Formats the address with the location.
     */
    public function getFullAddress(): string
    {
        return str($this->address)
            ->append(', ', $this->location->title())
            ->toString();
    }

    /**
     * Get the default image for the property.
     *
     * @return HasOne<Image, $this>
     */
    public function defaultImage(): HasOne
    {
        return $this->hasOne(Image::class)
            ->whereDefault();
    }

    /**
     * Get the amenities for the property.
     *
     * @return HasMany<Amenity, $this>
     */
    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    /**
     * Get the images for the property.
     *
     * @return HasMany<Image, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class)
            ->orderByDesc('is_default');
    }

    /**
     * Get the pricing details for the property.
     *
     * @return HasMany<PricingDetail, $this>
     */
    public function pricingDetails(): HasMany
    {
        return $this->hasMany(PricingDetail::class);
    }
}
