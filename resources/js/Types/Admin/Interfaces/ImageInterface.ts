export interface ImageInterface {
    [key: string]: null | boolean | File;
    file: File | null;
    isDefault: boolean;
}
