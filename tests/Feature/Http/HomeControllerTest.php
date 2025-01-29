<?php

declare(strict_types=1);

it('works on home page.', function () {
    $this->get('/')->assertOk();
});
