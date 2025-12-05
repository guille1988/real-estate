import { ContactMessageInquiryTypeEnum } from '@/Types/App/Enums/ContactMessageInquiryTypeEnum';
import { ContactMessageSourceEnum } from '@/Types/App/Enums/ContactMessageSourceEnum';

export interface ShowContactMessageInterface {
    uuid: string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: ContactMessageInquiryTypeEnum;
    source: ContactMessageSourceEnum;
    message: string;
    readAt: null | string;
    createdAt: null | string;
    updatedAt: null | string;
}
