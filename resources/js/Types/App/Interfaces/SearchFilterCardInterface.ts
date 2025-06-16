import { SearchFilterOptionInterface } from './SearchFilterOptionInterface';

export interface SearchFilterCardInterface {
    id: number;
    icon: string;
    label: string;
    options: SearchFilterOptionInterface[];
}
