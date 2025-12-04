<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\InquiryBuilder;
use Carbon\CarbonImmutable;
use Database\Factories\InquiryFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $first_name
 *  @property-read string $last_name
 *  @property-read string $email
 *  @property-read string $phone
 *  @property-read string|null $message
 *  @property-read int $property_id
 *  @property-read CarbonImmutable|null $read_at
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
#[UseEloquentBuilder(InquiryBuilder::class)]
final class Inquiry extends Model
{
    /** @use HasFactory<InquiryFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'inquiries';

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
}
