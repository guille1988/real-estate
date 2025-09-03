<?php

declare(strict_types=1);

use App\Exceptions\Handler;
use App\Support\InertiaResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

it('delegates to parent for non validation exceptions.', function (): void {
    $handler = $this->app->make(Handler::class);
    $request = Request::create('/missing');

    $response = $handler->render($request, new NotFoundHttpException('missing'));

    expect($response->getStatusCode())
        ->toBe(Response::HTTP_NOT_FOUND);
});

it('returns json with camel cased errors when request wants json.', function (): void {
    $handler = $this->app->make(Handler::class);
    $request = Request::create(
        uri: '/submit',
        method: 'POST',
        server: ['HTTP_ACCEPT' => 'application/json'],
    );

    $validator = validator(
        ['first_name' => ''],
        ['first_name' => ['required', 'string']]
    );

    try {
        $validator->validate();
        expect()->fail('Validation should have thrown.');
    } catch (ValidationException $exception) {
        $response = $handler->render($request, $exception);

        expect($response->getStatusCode())
            ->toBe(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->and($json = $response->getContent())
            ->toBeJson()
            ->and($payload = json_decode($json, true))
            ->toHaveKeys(['message', 'errors'])
            ->and($payload['errors'])
            ->toHaveKey('firstName');
    }
});

it('redirects back with input and camel cased errors for non json requests.', function (): void {
    $handler = $this->app->make(Handler::class);
    $request = Request::create('/submit', 'POST', ['first_name' => '']);

    $validator = validator(
        ['first_name' => ''],
        ['first_name' => ['required', 'string']]
    );

    try {
        $validator->validate();
        expect()->fail('Validation should have thrown.');
    } catch (ValidationException $exception) {
        $response = $handler->render($request, $exception);

        expect($response->isRedirection())
            ->toBeTrue()
            ->and($response->headers->get('Location'))
            ->not()
            ->toBeNull();

        $errors = session()
            ->get('errors')
            ?->getBag('default')
            ->toArray();

        expect($errors)
            ->toHaveKey('firstName')
            ->and(session()->getOldInput())
            ->toHaveKey('first_name');
    }
});

it('uses the Inertia response helper through the container.', function (): void {
    $this->app->bind(InertiaResponseHelper::class, function (): object {
        return new class()
        {
            public function __invoke(mixed $data): array
            {
                return [
                    'customKey' => [
                        'nestedKey' => ['message'],
                    ],
                ];
            }
        };
    });

    $handler = $this->app->make(Handler::class);
    $request = Request::create(
        uri: '/submit',
        method: 'POST',
        server: ['HTTP_ACCEPT' => 'application/json'],
    );

    $validator = validator(
        ['foo_bar' => ''],
        ['foo_bar' => ['required']]
    );

    try {
        $validator->validate();
        expect()->fail('Validation should have thrown.');
    } catch (ValidationException $exception) {
        $response = $handler->render($request, $exception);
        $payload = json_decode($response->getContent(), true);

        expect($payload['errors'])
            ->toHaveKey('customKey')
            ->and($payload['errors']['customKey'])
            ->toHaveKey('nestedKey');
    }
});
