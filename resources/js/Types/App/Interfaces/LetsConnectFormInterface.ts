import { InquiryTypeEnum } from '@/Types/App/Enums/InquiryTypeEnum';
import { SourceEnum } from '@/Types/App/Enums/SourceEnum';

export interface LetsConnectFormInterface {
    [key: string]: null | boolean | string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: InquiryTypeEnum | null;
    source: SourceEnum | null;
    message: string;
    termsAgreed: boolean;
}
