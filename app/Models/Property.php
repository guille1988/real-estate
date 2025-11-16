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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Throwable;

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
     * Returns the folder path for the property.
     *
     * @throws Throwable
     */
    public function getFolderPath(): string
    {
        /** @var null|Image $image */
        $image = $this->images()
            ->first();

        throw_if(is_null($image), message: 'No images found for the property.');

        return $image->getFolderPath();
    }

    /**
     * Returns the folder path for the property
     * only for the new images.
     */
    public function getFolderPathForNewImages(): string
    {
        return "{$this->type->plural()}/$this->uuid";
    }

    /*
     * Returns the file path for the property
     * only for the new images.
     */
    public function getFilePathForNewImages(): string
    {
        return str($this->getFolderPathForNewImages())
            ->append('/', Str::random())
            ->append('.', config()->string('app.default_image_format'))
            ->toString();
    }

    /*
     * Returns the default image for the property.
     * Otherwise, returns the wildcard image.
     */
    public function getDefaultImage(): string
    {
        return is_null($defaultImage = $this->defaultImage)
            ? Storage::disk('images')->url('property_image_wildcard.jpeg')
            : $defaultImage->getUrl();
    }

    /*
     * Returns 'can_show' property cache key.
     */
    public function getCanShowPropertyCacheKey(): string
    {
        return "can_show_property_$this->uuid";
    }

    /*
     * Returns true if the property can be shown.
     * We cannot let the user see the property if
     * the default image is not set, the amenities
     * of that property are not set, and the pricing
     * details of that property are not set.
     */
    public function canShowProperty(bool $loadCount = false): bool
    {
        $relations = ['amenities', 'images', 'pricingDetails'];

        if ($loadCount) {
            $this->loadCount($relations);
        }

        foreach ($relations as $relation) {
            $field = str($relation)
                ->snake()
                ->append('_count')
                ->toString();

            if (! isset($this->$field) || $this->$field === 0) {
                return false;
            }
        }

        return true;
    }

    /*
     * Sets all images of the property as non-default.
     */
    public function setAllImagesAsNonDefault(): void
    {
        $this->images()->update(['is_default' => false]);
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
     * Get the inquiries for the property.
     *
     * @return HasMany<Inquiry, $this>
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
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
