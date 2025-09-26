import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface IndexPropertyInterface {
    uuid: string;
    bedrooms: number;
    bathrooms: number;
    type: PropertyTypeEnum;
    image: string;
    title: string;
    price: string;
}
