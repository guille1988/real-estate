export interface ProfileFormInterface {
    [key: string]: string | File | null;
    name: string;
    password: string;
    passwordConfirmation: string;
    thumbnail: File | null;
}
