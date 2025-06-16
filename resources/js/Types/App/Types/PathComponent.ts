import FacebookPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/LinkedinPath.vue';
import TwitterPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/TwitterPath.vue';
import YoutubePath from '@/Components/Layout/Footer/FooterSocialLink/Paths/YoutubePath.vue';

export type PathComponent =
    | typeof FacebookPath
    | typeof LinkedinPath
    | typeof TwitterPath
    | typeof YoutubePath;
