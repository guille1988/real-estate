import { LocationTypeEnum } from '@/Types/App/Enums/LocationTypeEnum';

export interface OfficeLocationCardInterface {
    id: number;
    locationType: LocationTypeEnum;
    title: string;
    address: string;
    description: string;
    email: string;
    phone: string;
    location: string;
    url: string;
}
