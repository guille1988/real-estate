import { IndexSubscriberInterface } from '@/Types/Admin/Interfaces/IndexSubscriberInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexSubscriberPaginatedInterface {
    data: IndexSubscriberInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
