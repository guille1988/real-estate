import { LegalSectionItemInterface } from '@/Types/App/Interfaces/LegalSectionItemInterface';

export interface LegalSectionInterface {
    id: number;
    title: string;
    section_items: LegalSectionItemInterface[];
    previous_url: string;
}
