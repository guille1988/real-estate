import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { AmenityInterface } from '@/Types/App/Interfaces/AmenityInterface';
import { ImageInterface } from '@/Types/App/Interfaces/ImageInterface';

export interface PropertyInterface {
    uuid: string;
    caption: string;
    title: string;
    description: string;
    price: string;
    type: PropertyTypeEnum;
    bathrooms: number;
    bedrooms: number;
    area: number;
    amenities: AmenityInterface[];
    images: ImageInterface[];
}
