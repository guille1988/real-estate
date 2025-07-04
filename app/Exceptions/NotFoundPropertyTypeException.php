<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\PropertyTypeEnum;
use Exception;
use Symfony\Component\HttpFoundation\Response;

final class NotFoundPropertyTypeException extends Exception
{
    /**
     * @phpstan-ignore-next-line
     */
    protected $code = Response::HTTP_NOT_FOUND;

    /**
     * @phpstan-ignore-next-line
     */
    protected $message = 'This property type is missing. Please add it to '.PropertyTypeEnum::class.' enum class.';
}
