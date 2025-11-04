import { ImageInterface } from '@/Types/Admin/Interfaces/ImageInterface';

export interface StoreImageInterface {
    [key: string]: string | ImageInterface[];
    property: string;
    images: ImageInterface[];
}
