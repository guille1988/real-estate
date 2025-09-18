<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\ImageFormatEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
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

    /*
     * Check if the password is null.
     */
    private function doesntHavePassword(): bool
    {
        return is_null($this->password);
    }

    /*
     * Check if the password is not null.
     */
    private function hasPassword(): bool
    {
        return is_string($this->password);
    }

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
     * Check if the password is the same
     * as the current password of the user.
     */
    public function hasCurrentPasswordOf(User $user): bool
    {
        /**
         * @var string $password
         */
        $password = $this->password;

        return $this->hasPassword() &&
            Hash::check($password, $user->password);
    }

    /*
     * Converts the data to an array.
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        if ($this->doesntHavePassword()) {
            unset($data['password']);
        }

        unset($data['thumbnail']);

        return $data;
    }
}
