import { IndexPropertyInterface } from '@/Types/Admin/Interfaces/IndexPropertyInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexPropertyPaginatedInterface {
    data: IndexPropertyInterface[];
    currentPage: number;
    firstPageUrl: string;
    from: number;
    lastPage: number;
    lastPageUrl: string;
    nextPageUrl: string;
    path: string;
    perPage: number;
    prevPageUrl: null | string;
    to: number;
    total: number;
    links: PaginationLinksInterfaceInterface[];
}
