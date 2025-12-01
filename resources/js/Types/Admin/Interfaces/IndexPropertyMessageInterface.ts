import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface IndexPropertyMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    bathrooms: number;
    bedrooms: number;
    propertyType: PropertyTypeEnum;
    readAt: null | string;
}
