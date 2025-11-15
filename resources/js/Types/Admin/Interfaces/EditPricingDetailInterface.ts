import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';

export interface EditPricingDetailInterface {
    [key: string]: number | string | PricingDetailCategoryEnum;
    uuid: string;
    name: string;
    category: PricingDetailCategoryEnum;
    description: string;
    price: number;
}
