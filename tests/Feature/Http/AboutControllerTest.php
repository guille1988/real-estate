<?php

declare(strict_types=1);

it('works on about page.', function (): void {
    $this->get(route('about'))->assertOk();
});
