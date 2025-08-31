<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OfficeLocationTypeEnum;
use Carbon\CarbonImmutable;
use Database\Factories\OfficeLocationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $email
 *  @property-read OfficeLocationTypeEnum $type
 *  @property-read string $title
 *  @property-read string $address
 *  @property-read string $description
 *  @property-read string $phone
 *  @property-read string $location
 *  @property-read string $url
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class OfficeLocation extends Model
{
    /** @use HasFactory<OfficeLocationFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'office_locations';

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
}
