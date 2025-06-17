<?php

declare(strict_types=1);

it('works on privacy policy page.', function (): void {
    $this->get(route('privacy-policy'))->assertOk();
});
