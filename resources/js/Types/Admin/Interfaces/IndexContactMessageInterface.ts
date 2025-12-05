import { ContactMessageInquiryTypeEnum } from '@/Types/App/Enums/ContactMessageInquiryTypeEnum';

export interface IndexContactMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: ContactMessageInquiryTypeEnum;
    source: ContactMessageInquiryTypeEnum;
    readAt: null | string;
}
