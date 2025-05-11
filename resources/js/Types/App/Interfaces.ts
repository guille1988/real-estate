import { LocationTypeEnum, PagesEnum, ScreenSizeEnum } from '@/Types/App/Enums';

export interface UserInterface {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
}

export interface NavigationPagesInterface {
    name: string;
    url: string;
    page: PagesEnum;
}

export interface ClientCardInterface {
    id: number;
    url: string;
    since: number;
    company: string;
    domain: string;
    category: string;
    what_they_said: string;
}

export interface AchievementCardInterface {
    id: number;
    title: string;
    content: string;
}

export interface JourneyCardInterface {
    id: number;
    title: string;
    subtitle: string;
}

export interface MemberCardInterface {
    id: number;
    name: string;
    position: string;
    image: string;
}

export interface NavigatingExperienceCardInterface {
    id: number;
    title: string;
    description: string;
}

export interface ValueCardInterface {
    id: number;
    icon: string;
    title: string;
    description: string;
}

export interface ExploreCardInterface {
    id: number;
    image: string;
    alt: string;
    is_split: boolean;
}

export interface GetInTouchCardInterface {
    id: number;
    link: string;
    icon: string;
    label: string;
}

export interface LetsConnectFormInterface {
    [key: string]: string | boolean;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    inquiry_type: string;
    source: string;
    message: string;
    accept_terms: boolean;
}

export interface LetsConnectOptionsInterface {
    id: number;
    label: string;
    value: string;
}

export interface OfficeLocationCardInterface {
    id: number;
    location_type: LocationTypeEnum;
    title: string;
    address: string;
    description: string;
    email: string;
    phone: string;
    location: string;
    url: string;
}

export interface ClientTestimonialCardInterface {
    id: number;
    title: string;
    description: string;
    name: string;
    location: string;
    thumbnail: string;
}

export interface ScreenSizeConfigInterface {
    max: number;
    type: ScreenSizeEnum;
}
