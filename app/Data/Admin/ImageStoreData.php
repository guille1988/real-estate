<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\ImageFormatEnum;
use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class ImageStoreData extends Data
{
    public function __construct(
        public string $property,
        /**
         * @var array<int, array{file: UploadedFile, is_default: bool}>
         */
        public array $images,
    ) {}

    /**
     * @return array<string, string>
     */
    public static function messages(): array
    {
        return [
            'images.*.file.max' => 'Image must not be greater than 2MB.',
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property' => ['required', 'string', Rule::exists(Property::class, 'uuid')],
            'images' => ['required', 'array', 'between:1,30'],
            'images.*.file' => ['required', File::types(ImageFormatEnum::values())->max('2mb')],
            'images.*.is_default' => ['required', 'boolean'],
        ];
    }
}
