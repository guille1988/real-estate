import { IndexImageInterface } from '@/Types/Admin/Interfaces/IndexImageInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexImagePaginatedInterface {
    data: IndexImageInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
