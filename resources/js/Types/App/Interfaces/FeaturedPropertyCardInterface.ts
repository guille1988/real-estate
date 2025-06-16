import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';

export interface FeaturedPropertyCardInterface {
    id: number;
    bedroom_count: number;
    bathroom_count: number;
    type: PropertyTypeEnum;
    image: string;
    caption: string;
    title: string;
    description: string;
    price: string;
}
