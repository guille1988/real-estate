<?php

declare(strict_types=1);

it('works on home page.', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
