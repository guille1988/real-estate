import { OfficeLocationTypeEnum } from '@/Types/App/Enums/OfficeLocationTypeEnum';

export interface OfficeLocationInterface {
    uuid: string;
    type: OfficeLocationTypeEnum;
    title: string;
    address: string;
    description: string;
    email: string;
    phone: string;
    location: string;
    url: string;
}
