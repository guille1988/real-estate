<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Models\Property;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PropertyBulkDestroyData extends Data
{
    public function __construct(
        /**
         * @var array<int, string>
         */
        public array $uuids
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'uuids' => ['required', 'array'],
            'uuids.*' => ['required', 'string', 'between:1,200', Rule::exists(Property::class, 'uuid')],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        /**
         * @var array<string, string[]> $data
         */
        $data = parent::toArray();

        return $data;
    }
}
