import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';

export interface IndexPropertyPaginatedInterface {
    data: IndexPropertyInterface[];
    currentPage: number;
    perPage: number;
    total: number;
}
