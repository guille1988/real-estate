import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';

export interface FiltersInterface {
    modelValue?: boolean;
    filters: Record<string, SelectFilterOptionType[]>;
}
