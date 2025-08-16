<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\FaqItemFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @property-read int $id
 *  @property-read string $uuid
 *  @property-read string $subtitle
 *  @property-read array<int, string> $paragraphs
 *  @property-read int $faq_id
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class FaqItem extends Model
{
    /** @use HasFactory<FaqItemFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'faq_items';

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
            'paragraphs' => 'array',
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
     * Get the faq that owns the faq item.
     *
     * @return BelongsTo<Faq, $this>
     */
    public function faq(): BelongsTo
    {
        return $this->belongsTo(Faq::class);
    }
}
