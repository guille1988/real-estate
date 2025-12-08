export enum PropertyMessageBudgetEnum {
    UNDER_100_000 = 'under-100000',
    BETWEEN_100_000_AND_250_000 = '100000-250000',
    BETWEEN_250_000_AND_500_000 = '250000-500000',
    BETWEEN_500_000_AND_750_000 = '500000-750000',
    BETWEEN_750_000_AND_1_000_000 = '750000-1000000',
    MORE_THAN_1_000_000 = '1000000-plus',
}

export const PropertyMessageBudgetColors: Record<
    PropertyMessageBudgetEnum,
    string
> = {
    [PropertyMessageBudgetEnum.UNDER_100_000]: 'green',
    [PropertyMessageBudgetEnum.BETWEEN_100_000_AND_250_000]: 'indigo',
    [PropertyMessageBudgetEnum.BETWEEN_250_000_AND_500_000]: 'yellow',
    [PropertyMessageBudgetEnum.BETWEEN_500_000_AND_750_000]: 'purple',
    [PropertyMessageBudgetEnum.BETWEEN_750_000_AND_1_000_000]: 'red',
    [PropertyMessageBudgetEnum.MORE_THAN_1_000_000]: 'white',
};

export const PropertyMessageBudgetLabels: Record<
    PropertyMessageBudgetEnum,
    string
> = {
    [PropertyMessageBudgetEnum.UNDER_100_000]: 'Under $100,000',
    [PropertyMessageBudgetEnum.BETWEEN_100_000_AND_250_000]:
        '$100,000 - $250,000',
    [PropertyMessageBudgetEnum.BETWEEN_250_000_AND_500_000]:
        '$250,000 - $500,000',
    [PropertyMessageBudgetEnum.BETWEEN_500_000_AND_750_000]:
        '$500,000 - $750,000',
    [PropertyMessageBudgetEnum.BETWEEN_750_000_AND_1_000_000]:
        '$750,000 - $1,000,000',
    [PropertyMessageBudgetEnum.MORE_THAN_1_000_000]: 'More than $1,000,000',
};
