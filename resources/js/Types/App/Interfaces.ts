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
    location_type: string;
    title: string;
    address: string;
    description: string;
    email: string;
    phone: string;
    location: string;
    url: string;
}
