<?php

declare(strict_types=1);

namespace App\Enums;

enum PageEnum: string
{
    case ABOUT = 'About';
    case CONTACT = 'Contact';
    case HOME = 'Home';
    case PROPERTIES = 'Properties';
    case PROPERTY_DETAILS = 'PropertyDetails';
    case SERVICES = 'Services';
}
