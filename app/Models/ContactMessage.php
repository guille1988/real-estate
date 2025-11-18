<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use Carbon\CarbonImmutable;
use Database\Factories\ContactMessageFactory;
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
 *  @property-read ContactMessageInquiryTypeEnum $inquiry_type
 *  @property-read ContactMessageSourceEnum $source
 *  @property-read string|null $message
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'contact_messages';

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
            'inquiry_type' => ContactMessageInquiryTypeEnum::class,
            'source' => ContactMessageSourceEnum::class,
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
