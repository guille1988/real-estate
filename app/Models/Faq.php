<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $title
 *  @property-read string $description
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class Faq extends Model
{
    /** @use HasFactory<FaqFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'faq';

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

    /**
     * Get the faq items for the faq.
     *
     * @return HasMany<FaqItem, $this>
     */
    public function faqItems(): HasMany
    {
        return $this->hasMany(FaqItem::class);
    }
}
