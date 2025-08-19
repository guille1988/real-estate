import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';

export interface IndexPropertyPaginatedInterface {
    data: IndexPropertyInterface[];
    links: {
        next: string | null;
    };
    meta: {
        current_page: number;
        total: number;
    };
}
