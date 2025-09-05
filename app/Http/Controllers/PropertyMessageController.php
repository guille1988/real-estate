<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\PropertyMessageData;
use App\Models\PropertyMessage;
use Illuminate\Http\RedirectResponse;

final class PropertyMessageController
{
    public function __invoke(PropertyMessageData $data): RedirectResponse
    {
        PropertyMessage::create($data->toArray());

        return back();
    }
}
