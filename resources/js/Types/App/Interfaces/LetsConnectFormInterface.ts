import { InquiryTypeEnum } from '@/Types/App/Enums/InquiryTypeEnum';
import { SourceEnum } from '@/Types/App/Enums/SourceEnum';

export interface LetsConnectFormInterface {
    [key: string]: string | boolean;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: InquiryTypeEnum;
    source: SourceEnum;
    message: string;
    termsAgreed: boolean;
}
