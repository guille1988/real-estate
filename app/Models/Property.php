<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PropertyTypeEnum;
use Carbon\CarbonImmutable;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  @property-read string $name
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
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
     * Get the fields which will be unique.
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
