<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\SubscriberData;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;

final class SubscriberController
{
    public function __invoke(SubscriberData $data): RedirectResponse
    {
        Subscriber::create($data->toArray());

        return back();
    }
}
