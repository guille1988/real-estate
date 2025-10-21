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
     * @return array<string, string>
     */
    public static function messages(): array
    {
        return [
            'email.unique' => 'This e-mail is already subscribed.',
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', Rule::unique(Subscriber::class, 'email')],
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

        return $data;
    }
}
