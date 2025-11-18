<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyMessageBudgetEnum;
use App\Enums\PropertyTypeEnum;
use Carbon\CarbonImmutable;
use Database\Factories\PropertyMessageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $first_name
 *  @property-read string $last_name
 *  @property-read string $email
 *  @property-read string $phone
 *  @property-read PropertyLocationEnum $location
 *  @property-read PropertyTypeEnum $property_type
 *  @property-read PropertyMessageBudgetEnum $budget
 *  @property-read int $bedrooms
 *  @property-read int $bathrooms
 *  @property-read string|null $message
 *  @property-read CarbonImmutable|null $read_at
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class PropertyMessage extends Model
{
    /** @use HasFactory<PropertyMessageFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'property_messages';

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
            'read_at' => 'datetime',
            'location' => PropertyLocationEnum::class,
            'property_type' => PropertyTypeEnum::class,
            'budget' => PropertyMessageBudgetEnum::class,
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
}
