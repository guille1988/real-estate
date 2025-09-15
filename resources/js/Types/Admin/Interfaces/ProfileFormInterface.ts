interface ProfileFormInterface {
    [key: string]: string | File | null;
    name: string;
    email: string;
    password: string;
    passwordConfirmation: string;
    thumbnail: File | null;
}
