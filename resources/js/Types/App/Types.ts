import FacebookPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/LinkedinPath.vue';
import TwitterPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/TwitterPath.vue';
import YoutubePath from '@/Components/Layout/Footer/FooterSocialLink/Paths/YoutubePath.vue';
import { SearchFilterOptionInterface } from '@/Types/App/Interfaces';

export type PathComponent =
    | typeof FacebookPath
    | typeof LinkedinPath
    | typeof TwitterPath
    | typeof YoutubePath;

export type EmitEvents = {
    optionSelected: [cardId: number, option: SearchFilterOptionInterface];
};

export type EmitFunction = {
    <T extends keyof EmitEvents>(event: T, ...args: EmitEvents[T]): void;
};
