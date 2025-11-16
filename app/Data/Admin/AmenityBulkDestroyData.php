<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Models\Amenity;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class AmenityBulkDestroyData extends Data
{
    public function __construct(
        /**
         * @var string[]
         */
        public array $uuids
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'uuids' => ['required', 'array', 'min:1'],
            'uuids.*' => ['required', 'string', 'between:1,200', Rule::exists(Amenity::class, 'uuid')],
        ];
    }
}
