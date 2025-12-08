import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { PropertyMessageBudgetEnum } from '@/Types/App/Enums/PropertyMessageBudgetEnum';

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
