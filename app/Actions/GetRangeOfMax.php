<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Number;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class GetRangeOfMax
{
    /**
     * @var array<int, string>
     */
    private array $permittedFields = [
        'bedrooms',
        'bathrooms',
    ];

    /**
     * @return array<int, array{label: string, value: int}>
     *
     * @throws Throwable
     *
     * Generate a range of label value numbers.
     */
    public function execute(string $field): array
    {
        throw_if(
            ! in_array($field, $this->permittedFields),
            InvalidArgumentException::class,
            [
                'message' => "The field $field is not permitted.",
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ]
        );

        $maxNumber = cache()
            ->rememberForever("max_$field", function () use ($field): int {
                /**
                 * @var int $max
                 */
                $max = Property::max($field);

                return $max;
            });

        return array_map(function (int $number): array {
            /**
             * @var string $label
             */
            $label = Number::spell($number);

            return [
                'label' => ucfirst($label),
                'value' => $number,
            ];
        }, range(1, $maxNumber));

    }
}
