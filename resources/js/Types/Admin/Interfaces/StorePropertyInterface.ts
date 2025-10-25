import type { ImageInterface } from '@/Types/Admin/Interfaces/ImageInterface';

export interface StorePropertyInterface {
    [key: string]: null | boolean | string | ImageInterface[];
    caption: string;
    title: string;
    description: string;
    address: string;
    type: string | null;
    location: string | null;
    bathrooms: string;
    bedrooms: string;
    area: string;
    price: string;
    isFeatured: boolean;
}
