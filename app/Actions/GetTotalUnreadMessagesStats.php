<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\StatsData;
use App\Models\ContactMessage;
use App\Models\Inquiry;
use App\Models\PropertyMessage;

final readonly class GetTotalUnreadMessagesStats
{
    public function execute(): StatsData
    {
        $contactMessages = ContactMessage::all(['id', 'read_at']);
        $propertyMessages = PropertyMessage::all(['id', 'read_at']);
        $inquiries = Inquiry::all(['id', 'read_at']);

        $contactMessagesCount = $contactMessages->count();
        $propertyMessagesCount = $propertyMessages->count();
        $inquiriesCount = $inquiries->count();

        $unreadContactMessagesCount = $contactMessages->filter->unread()->count();
        $unreadPropertyMessagesCount = $propertyMessages->filter->unread()->count();
        $unreadInquiriesCount = $inquiries->filter->unread()->count();

        $stat = $unreadContactMessagesCount + $unreadPropertyMessagesCount + $unreadInquiriesCount;
        $previousStat = $contactMessagesCount + $propertyMessagesCount + $inquiriesCount;

        return StatsData::from([
            'name' => 'Total Unread Messages (Contact + Property + Inquiry)',
            'stat' => $stat,
            'previous_stat' => $previousStat,
            'change' => null,
            'change_type' => null,
        ]);
    }
}
