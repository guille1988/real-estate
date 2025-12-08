<?php

declare(strict_types=1);

namespace App\Enums;

enum PageEnum: string
{
    case ABOUT = 'About';
    case CONTACT = 'Contact';
    case ERROR = 'Error';
    case HOME = 'Home';
    case PROPERTIES = 'Properties';
    case PROPERTY_DETAILS = 'PropertyDetails';
    case SERVICES = 'Services';

    // Admin pages.
    case ADMIN_DASHBOARD = 'Admin/Dashboard';
    case ADMIN_LOGIN = 'Admin/Login';
    case ADMIN_PROFILE = 'Admin/Profile';

    case ADMIN_PROPERTIES_INDEX = 'Admin/Properties/Index';
    case ADMIN_PROPERTIES_CREATE = 'Admin/Properties/Create';
    case ADMIN_PROPERTIES_EDIT = 'Admin/Properties/Edit';
    case ADMIN_PROPERTIES_SHOW = 'Admin/Properties/Show';

    case ADMIN_IMAGES_INDEX = 'Admin/Images/Index';
    case ADMIN_IMAGES_CREATE = 'Admin/Images/Create';
    case ADMIN_IMAGES_EDIT = 'Admin/Images/Edit';

    case ADMIN_PRICING_DETAILS_INDEX = 'Admin/PricingDetails/Index';
    case ADMIN_PRICING_DETAILS_CREATE = 'Admin/PricingDetails/Create';
    case ADMIN_PRICING_DETAILS_SHOW = 'Admin/PricingDetails/Show';
    case ADMIN_PRICING_DETAILS_EDIT = 'Admin/PricingDetails/Edit';

    case ADMIN_AMENITIES_INDEX = 'Admin/Amenities/Index';
    case ADMIN_AMENITIES_CREATE = 'Admin/Amenities/Create';
    case ADMIN_AMENITIES_SHOW = 'Admin/Amenities/Show';
    case ADMIN_AMENITIES_EDIT = 'Admin/Amenities/Edit';

    case ADMIN_PROPERTY_MESSAGES_INDEX = 'Admin/PropertyMessages/Index';
    case ADMIN_PROPERTY_MESSAGES_SHOW = 'Admin/PropertyMessages/Show';

    case ADMIN_INQUIRIES_INDEX = 'Admin/Inquiries/Index';
    case ADMIN_INQUIRIES_SHOW = 'Admin/Inquiries/Show';

    case ADMIN_CONTACT_MESSAGES_INDEX = 'Admin/ContactMessages/Index';
    case ADMIN_CONTACT_MESSAGES_SHOW = 'Admin/ContactMessages/Show';

    case ADMIN_SUBSCRIBERS_INDEX = 'Admin/Subscribers/Index';
}
