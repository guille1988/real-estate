import { FaqModalItemInterface } from './FaqModalItemInterface';

export interface FaqCardInterface {
    id: number;
    title: string;
    description: string;
    modalItems: FaqModalItemInterface[];
}
