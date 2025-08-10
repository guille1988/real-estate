<?php

declare(strict_types=1);

use App\Http\Middleware\HandleInertiaRequestMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

it('replaces keys on query strings as it should.', function (string $snakeCaseQueryString): void {
    $camelCaseQueryStringKey = str($snakeCaseQueryString)
        ->camel()
        ->toString();

    Route::middleware(HandleInertiaRequestMiddleware::class)
        ->get('test', function (Request $request): JsonResponse {
            return response()->json($request->query->all());
        });

    $url = Uri::of(config('app.url'))
        ->withPath('test')
        ->withQuery([$camelCaseQueryStringKey => $snakeCaseQueryString])
        ->value();

    $response = $this->getJson($url)
        ->collect();

    expect($response->contains($snakeCaseQueryString))
        ->toBeTrue()
        ->and($response->doesntContain($camelCaseQueryStringKey))
        ->toBeTrue();
})->with([fake()->words(2, true)]);

it('replaces keys on json payloads as it should.', function (string $snakeCaseJsonPayload): void {
    $camelCaseJsonPayload = str($snakeCaseJsonPayload)
        ->camel()
        ->toString();

    Route::middleware(HandleInertiaRequestMiddleware::class)
        ->post('test', function (Request $request): JsonResponse {
            return response()->json($request->json()->all());
        });

    $url = Uri::of(config('app.url'))
        ->withPath('test')
        ->value();

    $response = $this->postJson($url, [
        $camelCaseJsonPayload => $snakeCaseJsonPayload,
    ])->collect();

    expect($response->contains($snakeCaseJsonPayload))
        ->toBeTrue()
        ->and($response->doesntContain($camelCaseJsonPayload))
        ->toBeTrue();
})->with([fake()->words(2, true)]);

it('replaces both query string and payload as it should.', function (string $snakeCaseQueryString, string $snakeCaseJsonPayload): void {
    $camelCaseQueryStringKey = str($snakeCaseQueryString)
        ->camel()
        ->toString();

    $camelCaseJsonPayload = str($snakeCaseJsonPayload)
        ->camel()
        ->toString();

    Route::middleware(HandleInertiaRequestMiddleware::class)
        ->post('test', function (Request $request): JsonResponse {
            return response()->json($request->all());
        });

    $url = Uri::of(config('app.url'))
        ->withPath('test')
        ->withQuery([$camelCaseQueryStringKey => $snakeCaseQueryString])
        ->value();

    $response = $this->postJson($url, [
        $camelCaseJsonPayload => $snakeCaseJsonPayload,
    ])->collect();

    expect($response->contains($snakeCaseQueryString))
        ->toBeTrue()
        ->and($response->doesntContain($camelCaseQueryStringKey))
        ->toBeTrue()
        ->and($response->contains($snakeCaseJsonPayload))
        ->toBeTrue()
        ->and($response->doesntContain($camelCaseJsonPayload))
        ->toBeTrue();
})->with(
    [fake()->unique()->words(2, true)],
    [fake()->unique()->words(2, true)],
);
