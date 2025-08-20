import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';

export interface IndexPropertyPaginatedInterface {
    data: IndexPropertyInterface[];
    currentPage: number;
    total: number;
}
