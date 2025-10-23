<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\ImageFormatEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Rules\AtLeastOneDefaultImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PropertyStoreData extends Data
{
    public function __construct(
        public string $title,
        public string $caption,
        public string $address,
        public string $description,
        public int $bedrooms,
        public int $bathrooms,
        public int $area,
        public int $price,
        public PropertyTypeEnum $type,
        public PropertyLocationEnum $location,
        public bool $isFeatured,
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
            'title' => ['required', 'string', 'between:2,200'],
            'caption' => ['required', 'string', 'between:2,200'],
            'address' => ['required', 'string', 'between:2,200'],
            'description' => ['required', 'string', 'between:2,1000'],
            'bedrooms' => ['required', 'integer', 'between:1,10'],
            'bathrooms' => ['required', 'integer', 'between:1,10'],
            'area' => ['required', 'integer', 'between:10,1000000'],
            'price' => ['required', 'integer', 'between:10,1000000000'],
            'type' => ['required', 'string', Rule::enum(PropertyTypeEnum::class)],
            'location' => ['required', 'string', Rule::enum(PropertyLocationEnum::class)],
            'is_featured' => ['required', 'boolean'],
            'images' => ['required', 'array', 'between:1,30', new AtLeastOneDefaultImage],
            'images.*.file' => ['required', File::types(ImageFormatEnum::values())->max('2mb')],
            'images.*.is_default' => ['required', 'boolean'],
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
        unset($data['images']);

        return $data;
    }
}
