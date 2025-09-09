import { OfficeLocationTypeEnum } from '@/Types/App/Enums/OfficeLocationTypeEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface MakeItHappenFormInterface {
    [key: string]: null | boolean | number | string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    location: OfficeLocationTypeEnum | null;
    propertyType: PropertyTypeEnum | null;
    bathrooms: number | null;
    bedrooms: number | null;
    budget: string;
    message: string;
    termsAgreed: boolean;
}
