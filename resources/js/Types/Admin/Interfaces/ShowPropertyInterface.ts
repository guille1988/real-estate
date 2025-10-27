import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface ShowPropertyInterface {
    uuid: string;
    title: string;
    description: string;
    address: string;
    price: string;
    type: PropertyTypeEnum;
    bathrooms: string;
    bedrooms: string;
    area: string;
    createdAt: string;
    updatedAt: string;
    location: string;
}
