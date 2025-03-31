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
