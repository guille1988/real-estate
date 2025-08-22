<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class HomeData extends Data
{
    public function __construct(
        public ?int $page = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'digits_between:1,100'],
        ];
    }

    /*
     * Get the cache key for the data.
     */
    public function getCacheKey(): string
    {
        $tag = 'featured_properties';

        if (is_int($this->page)) {
            $tag .= "_page:$this->page";
        }

        return $tag;
    }
}
