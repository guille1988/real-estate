import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface ShowPropertyInterface {
    uuid: string;
    title: string;
    caption: string;
    description: string;
    address: string;
    price: string;
    type: PropertyTypeEnum;
    bathrooms: string;
    bedrooms: string;
    area: string;
    isFeatured: string;
    createdAt: null | string;
    updatedAt: null | string;
    location: string;
}
