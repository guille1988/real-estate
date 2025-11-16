import { IndexAmenityInterface } from '@/Types/Admin/Interfaces/IndexAmenityInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexAmenitiesPaginatedInterface {
    data: IndexAmenityInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
