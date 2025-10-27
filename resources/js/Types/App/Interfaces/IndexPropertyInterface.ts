import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface IndexPropertyInterface {
    uuid: string;
    bedrooms: number;
    bathrooms: number;
    type: PropertyTypeEnum;
    image: string;
    caption: string;
    title: string;
    description: string;
    price: string;
    canShowProperty: boolean;
}
