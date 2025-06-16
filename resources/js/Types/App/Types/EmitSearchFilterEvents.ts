import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';

export type EmitSearchFilterEvents = {
    optionSelected: [cardId: number, option: SearchFilterOptionInterface];
};
