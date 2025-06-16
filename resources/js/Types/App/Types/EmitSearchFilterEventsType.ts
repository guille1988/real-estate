import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';

export type EmitSearchFilterEventsType = {
    optionSelected: [cardId: number, option: SearchFilterOptionInterface];
};
