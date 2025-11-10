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

    case ADMIN_PRICING_DETAILS_INDEX = 'Admin/PricingDetails/Index';
    case ADMIN_PRICING_DETAILS_CREATE = 'Admin/PricingDetails/Create';
}
