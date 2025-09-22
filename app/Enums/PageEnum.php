<?php

declare(strict_types=1);

namespace App\Enums;

enum PageEnum: string
{
    case ABOUT = 'About';
    case ADMIN_DASHBOARD = 'Admin/Dashboard';
    case ADMIN_LOGIN = 'Admin/Login';
    case ADMIN_PROFILE = 'Admin/Profile';
    case ADMIN_PROPERTIES = 'Admin/Properties';
    case CONTACT = 'Contact';
    case ERROR = 'Error';
    case HOME = 'Home';
    case PROPERTIES = 'Properties';
    case PROPERTY_DETAILS = 'PropertyDetails';
    case SERVICES = 'Services';
}
