export interface LetsConnectFormInterface {
    [key: string]: string | boolean;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    inquiry_type: string;
    source: string;
    message: string;
    accept_terms: boolean;
}
