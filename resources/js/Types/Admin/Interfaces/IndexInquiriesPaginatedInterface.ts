import { IndexInquiryInterface } from '@/Types/Admin/Interfaces/IndexInquiryInterface';
import { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface';

export interface IndexInquiriesPaginatedInterface {
    data: IndexInquiryInterface[];
    links: PaginationLinksInterfaceInterface[];
    from: number;
    lastPage: number;
    nextPageUrl: string;
    prevPageUrl: null | string;
    to: number;
    total: number;
}
