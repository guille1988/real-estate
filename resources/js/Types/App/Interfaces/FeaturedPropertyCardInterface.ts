import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface FeaturedPropertyCardInterface {
    uuid: string;
    bedrooms: number;
    bathrooms: number;
    type: PropertyTypeEnum;
    image: string;
    caption: string;
    title: string;
    description: string;
    price: string;
}
