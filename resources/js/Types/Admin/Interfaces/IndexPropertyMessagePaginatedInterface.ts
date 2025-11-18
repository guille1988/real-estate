import { IndexPropertyMessageInterface } from '@/Types/Admin/Interfaces/IndexPropertyMessageInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexPropertyMessagePaginatedInterface {
    data: IndexPropertyMessageInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
