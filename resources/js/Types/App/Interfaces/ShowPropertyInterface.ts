import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { PricingCardInterface } from '@/Types/App/Interfaces/PricingCardInterface';
import { PropertyAmenityInterface } from '@/Types/App/Interfaces/PropertyAmenityInterface';
import { PropertyImageInterface } from '@/Types/App/Interfaces/PropertyImageInterface';

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
    amenities: PropertyAmenityInterface[];
    images: PropertyImageInterface[];
    pricingDetails: PricingCardInterface[];
}
