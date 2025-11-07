import { IndexPricingDetailInterface } from '@/Types/Admin/Interfaces/IndexPricingDetailInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexPricingDetailsPaginatedInterface {
    data: IndexPricingDetailInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
