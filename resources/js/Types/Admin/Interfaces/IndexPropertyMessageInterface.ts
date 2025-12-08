import { PropertyMessageBudgetEnum } from '@/Types/App/Enums/PropertyMessageBudgetEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface IndexPropertyMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    bathrooms: number;
    bedrooms: number;
    propertyType: PropertyTypeEnum;
    budget: PropertyMessageBudgetEnum;
    readAt: null | string;
}
