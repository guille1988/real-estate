import { ChangeTypeEnum } from '@/Types/Admin/Enums/ChangeTypeEnum';

export interface StatsInterface {
    name: string;
    stat: string;
    previousStat: string;
    change: null | string;
    changeType: ChangeTypeEnum;
}
