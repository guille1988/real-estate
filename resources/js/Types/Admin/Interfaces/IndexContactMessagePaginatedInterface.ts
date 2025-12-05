import { IndexContactMessageInterface } from '@/Types/Admin/Interfaces/IndexContactMessageInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexContactMessagePaginatedInterface {
    data: IndexContactMessageInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
