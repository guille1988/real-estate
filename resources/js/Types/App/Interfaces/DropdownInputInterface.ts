export interface DropdownInputInterface {
    id: string;
    label: string;
    modelValue: string | number | null;
    placeholder: string;
    options: Record<string | number, string>;
}
