import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface ShowPropertyMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    bathrooms: number;
    bedrooms: number;
    propertyType: PropertyTypeEnum;
    message: string;
    readAt: null | string;
    createdAt: null | string;
    updatedAt: null | string;
}
