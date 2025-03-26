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
