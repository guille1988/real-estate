import { PropertyMessageBudgetEnum } from '@/Types/App/Enums/PropertyMessageBudgetEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface ShowPropertyMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    bathrooms: number;
    bedrooms: number;
    propertyType: PropertyTypeEnum;
    budget: PropertyMessageBudgetEnum;
    message: string;
    readAt: null | string;
    createdAt: null | string;
    updatedAt: null | string;
}
