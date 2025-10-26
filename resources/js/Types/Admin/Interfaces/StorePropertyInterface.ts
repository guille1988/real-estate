export interface StorePropertyInterface {
    [key: string]: null | boolean | number | string;
    caption: string;
    title: string;
    description: string;
    address: string;
    type: string | null;
    location: string | null;
    bathrooms: number;
    bedrooms: number;
    area: number;
    price: number;
    isFeatured: boolean;
}
