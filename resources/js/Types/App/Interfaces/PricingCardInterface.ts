import { PricingDetailInterface } from './PricingDetailInterface';

export interface PricingCardInterface {
    id: number;
    subject: string;
    link: string;
    details: PricingDetailInterface[];
}
