<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ContactMessageData;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;

final class ContactMessageController
{
    public function __invoke(ContactMessageData $data): RedirectResponse
    {
        ContactMessage::create($data->toArray());

        return back();
    }
}
