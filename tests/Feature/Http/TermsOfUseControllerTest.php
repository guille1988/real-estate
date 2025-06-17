<?php

declare(strict_types=1);

it('works on terms of use page.', function (): void {
    $this->get(route('terms-of-use'))->assertOk();
});
