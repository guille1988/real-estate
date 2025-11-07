export enum PricingDetailCategoryEnum {
    ADDITIONAL_FEES = 'additional_fees',
    MONTHLY_COSTS = 'monthly_costs',
    TOTAL_INITIAL_COSTS = 'total_initial_costs',
    MONTHLY_EXPENSES = 'monthly_expenses',
}

export const PricingDetailCategoryColors: Record<
    PricingDetailCategoryEnum,
    string
> = {
    [PricingDetailCategoryEnum.ADDITIONAL_FEES]: 'green',
    [PricingDetailCategoryEnum.MONTHLY_COSTS]: 'indigo',
    [PricingDetailCategoryEnum.TOTAL_INITIAL_COSTS]: 'yellow',
    [PricingDetailCategoryEnum.MONTHLY_EXPENSES]: 'purple',
};
