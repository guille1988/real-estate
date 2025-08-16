import { FaqItemInterface } from './FaqItemInterface';

export interface FaqInterface {
    uuid: string;
    title: string;
    description: string;
    faqItems: FaqItemInterface[];
}
