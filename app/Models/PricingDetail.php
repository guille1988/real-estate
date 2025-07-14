<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PricingDetailCategoryEnum;
use App\Models\Traits\Priceable;
use Carbon\CarbonImmutable;
use Database\Factories\PricingDetailFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $title
 *  @property-read ?string $description
 *  @property-read PricingDetailCategoryEnum $category
 *  @property-read int $price
 *  @property-read int $property_id
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class PricingDetail extends Model
{
    /** @use HasFactory<PricingDetailFactory> */
    use HasFactory, HasUuids, Priceable;

    /**
     * @var string
     */
    protected $table = 'pricing_details';

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
            'category' => PricingDetailCategoryEnum::class,
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

    /**
     * Get the property that owns the image.
     *
     * @return BelongsTo<Property, $this>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getTitleDescription(): ?string
    {
        if (is_null($this->description)) {
            return null;
        }

        return str($this->description)
            ->title()
            ->toString();
    }
}
