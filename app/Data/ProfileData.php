<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\ImageFormatEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class ProfileData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null,
        public ?UploadedFile $thumbnail = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'between:2,100'],
            'email' => ['required', 'string', 'email', 'between:2,200', Rule::unique(User::class, 'email')],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'thumbnail' => ['nullable', File::types(ImageFormatEnum::values())->max('2mb')],
        ];
    }

    /*
     * Check if the thumbnail is not null.
     */
    public function hasThumbnail(): bool
    {
        return $this->thumbnail instanceof UploadedFile;
    }

    /*
     * Converts the data to an array.
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        if (is_null($this->password)) {
            unset($data['password']);
        }

        unset($data['thumbnail']);

        return $data;
    }
}
