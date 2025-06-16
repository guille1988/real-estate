export interface DropdownInputInterface {
    id: string;
    label: string;
    model_value: string | number | null;
    placeholder: string;
    options: Record<string | number, string>;
}
