import { FooterLinkInterface } from './FooterLinkInterface';

export interface FooterCategoryInterface {
    id: number;
    title: string;
    links: FooterLinkInterface[];
}
