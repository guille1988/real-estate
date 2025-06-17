import { InquiryTypeEnum } from '@/Types/App/Enums/InquiryTypeEnum';
import { SourceEnum } from '@/Types/App/Enums/SourceEnum';

export interface LetsConnectFormInterface {
    [key: string]: string | boolean;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    inquiry_type: InquiryTypeEnum;
    source: SourceEnum;
    message: string;
    terms_agreed: boolean;
}
