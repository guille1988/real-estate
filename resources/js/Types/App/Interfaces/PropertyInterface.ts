import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { AmenityInterface } from '@/Types/App/Interfaces/AmenityInterface';
import { ImageInterface } from '@/Types/App/Interfaces/ImageInterface';
import { PricingCardInterface } from '@/Types/App/Interfaces/PricingCardInterface';

export interface PropertyInterface {
    uuid: string;
    title: string;
    description: string;
    address: string;
    price: string;
    type: PropertyTypeEnum;
    bathrooms: string;
    bedrooms: string;
    area: string;
    amenities: AmenityInterface[];
    images: ImageInterface[];
    pricingDetails: PricingCardInterface[];
}
