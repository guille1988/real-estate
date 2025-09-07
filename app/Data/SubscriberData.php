<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Subscriber;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

final class SubscriberData extends Data
{
    public function __construct(
        public string $email,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', Rule::unique(Subscriber::class, 'email')],
        ];
    }
}
