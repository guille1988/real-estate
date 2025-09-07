import { DropdownInputOptionsInterface } from '@/Types/App/Interfaces/DropdownInputOptionsInterface';

export interface DropdownInputInterface {
    id: string;
    label: string;
    modelValue: string | number | null;
    placeholder: string;
    options: DropdownInputOptionsInterface[];
}
