import { IndexPropertyInterface } from '@/Types/Admin/Interfaces/IndexPropertyInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexPropertyPaginatedInterface {
    data: IndexPropertyInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    perPage: number;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
