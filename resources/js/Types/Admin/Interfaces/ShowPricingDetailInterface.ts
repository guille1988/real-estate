import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';

export interface ShowPricingDetailInterface {
    uuid: string;
    name: string;
    category: PricingDetailCategoryEnum;
    description: string;
    price: string;
    createdAt: null | string;
    updatedAt: null | string;
}
