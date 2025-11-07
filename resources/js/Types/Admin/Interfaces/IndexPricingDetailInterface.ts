import { PricingDetailCategoryEnum } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';

export interface IndexPricingDetailInterface {
    uuid: string;
    name: string;
    category: PricingDetailCategoryEnum;
    price: string;
    propertyTitle: string;
    propertyDefaultImage: string;
}
