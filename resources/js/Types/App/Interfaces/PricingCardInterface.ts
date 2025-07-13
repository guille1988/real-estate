import { PricingDetailInterface } from './PricingDetailInterface';

export interface PricingCardInterface {
    id: number;
    subject: string;
    details: PricingDetailInterface[];
}
