import { ContactMessageInquiryTypeEnum } from '@/Types/App/Enums/ContactMessageInquiryTypeEnum';
import { ContactMessageSourceEnum } from '@/Types/App/Enums/ContactMessageSourceEnum';

export interface LetsConnectFormInterface {
    [key: string]: null | boolean | string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: ContactMessageInquiryTypeEnum | null;
    source: ContactMessageSourceEnum | null;
    message: string;
    termsAgreed: boolean;
}
