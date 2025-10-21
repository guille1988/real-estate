<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Property;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PropertyInquireData extends Data
{
    public function __construct(
        public string $propertyUuid,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public ?string $message,
        public bool $termsAgreed,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property_uuid' => ['required', 'string', Rule::exists(Property::class, 'uuid')],
            'first_name' => ['required', 'string', 'between:2,200'],
            'last_name' => ['required', 'string', 'between:2,200'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string', 'between:8,20'],
            'message' => ['nullable', 'string', 'between:2,2000'],
            'terms_agreed' => ['accepted'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        /**
         * @var array<string, mixed> $data
         */
        $data = parent::toArray();

        $fieldsToUnset = [
            'property_uuid',
            'terms_agreed',
        ];

        foreach ($fieldsToUnset as $field) {
            unset($data[$field]);
        }

        return $data;
    }
}
