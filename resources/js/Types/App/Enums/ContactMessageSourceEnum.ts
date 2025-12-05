export enum ContactMessageSourceEnum {
    SEARCH = 'search',
    SOCIAL = 'social',
    REFERRAL = 'referral',
    OTHER = 'other',
}

export const ContactMessageSourceColors: Record<
    ContactMessageSourceEnum,
    string
> = {
    [ContactMessageSourceEnum.SEARCH]: 'green',
    [ContactMessageSourceEnum.SOCIAL]: 'indigo',
    [ContactMessageSourceEnum.REFERRAL]: 'yellow',
    [ContactMessageSourceEnum.OTHER]: 'purple',
};
