import { SocialLinkIconEnum } from '@/Types/App/Enums/SocialLinkIconEnum';

export interface SocialLinkInterface {
    id: number;
    icon: SocialLinkIconEnum;
    url: string;
}
