<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class LoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'between:2,200', Rule::exists(User::class, 'email')],
            'password' => ['required', Password::defaults()],
        ];
    }
}
