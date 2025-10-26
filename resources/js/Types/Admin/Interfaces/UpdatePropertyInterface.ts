export interface UpdatePropertyInterface {
    [key: string]: null | boolean | number | string;
    uuid: string;
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
