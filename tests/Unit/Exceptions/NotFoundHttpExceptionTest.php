<?php

declare(strict_types=1);

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

beforeEach(fn () => $this->app['env'] = 'local');

it('contains proper response on api request on production environment', function (): void {

    $this->app['env'] = 'production';

    $response = getJson('/not-found');

    $response->assertNotFound();

    expect($response->json('message'))
        ->toContain('Not found.')
        ->not->toContain('File');
});

it('contains proper response on api request on local environment', function (): void {
    $response = getJson('/not-found');

    $response->assertNotFound();

    expect($response->json('message'))
        ->toContain('Not found.')
        ->toContain('File');
});

it('contains proper response on web request on local environment', function (): void {
    $response = get('/not-found');

    $response->assertNotFound()
        ->assertViewIs('errors.not_found');
});
