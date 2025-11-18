import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface IndexPropertyMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    read_at: null | string;
    propertyType: PropertyTypeEnum;
}
