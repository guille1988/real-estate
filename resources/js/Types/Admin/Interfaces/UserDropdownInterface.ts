import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';

export interface UserDropdownInterface {
    name: string;
    route: string;
    method?: FormMethodEnum;
}
