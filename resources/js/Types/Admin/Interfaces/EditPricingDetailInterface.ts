import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';

export interface EditPricingDetailInterface {
    uuid: string;
    name: string;
    category: PricingDetailCategoryEnum;
    description: string;
    price: string;
}
