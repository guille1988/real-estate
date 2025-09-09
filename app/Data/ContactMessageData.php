<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class ContactMessageData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        #[WithCast(EnumCast::class)]
        public ContactMessageInquiryTypeEnum $inquiryType,
        #[WithCast(EnumCast::class)]
        public ContactMessageSourceEnum $source,
        public ?string $message,
        public bool $termsAgreed,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'between:2,200'],
            'last_name' => ['required', 'string', 'between:2,200'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string', 'between:8,20'],
            'inquiry_type' => ['required', Rule::enum(ContactMessageInquiryTypeEnum::class)],
            'source' => ['required', 'string', Rule::enum(ContactMessageSourceEnum::class)],
            'message' => ['nullable', 'string', 'between:2,2000'],
            'terms_agreed' => ['accepted'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        unset($data['terms_agreed']);

        return $data;
    }
}
