import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';

export interface UpdatePricingDetailInterface {
    [key: string]: number | string | PricingDetailCategoryEnum;
    name: string;
    category: PricingDetailCategoryEnum;
    description: string;
    price: number;
    property: string;
}
