import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';
import { PricingDetailInterface } from '@/Types/Admin/Interfaces/PricingDetailInterface';

export interface StorePricingDetailInterface {
    [key: string]:
        | null
        | string
        | PricingDetailCategoryEnum
        | PricingDetailInterface[];
    property: string;
    category: null | PricingDetailCategoryEnum;
    pricingDetails: PricingDetailInterface[];
}
