<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Traits\Traceable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

final class NotFoundHttpException extends Exception
{
    use Traceable;

    /**
     * @var string
     */
    protected $message = 'Not found.';

    /**
     * @var int
     */
    protected $code = ResponseCode::HTTP_NOT_FOUND;

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse|Response
    {
        return $request->expectsJson() ?
            response()->json(['message' => $this->getTraceMessage()], $this->code) :
            response()->view('errors.not_found', status: $this->code);
    }
}
