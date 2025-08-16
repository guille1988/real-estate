import { FaqItemInterface } from './FaqItemInterface';

export interface FaqInterface {
    id: number;
    title: string;
    description: string;
    faqItems: FaqItemInterface[];
}
