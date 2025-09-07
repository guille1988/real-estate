export interface InquireFormInterface {
    [key: string]: boolean | string;
    propertyUuid: string;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    message: string;
    termsAgreed: boolean;
}
