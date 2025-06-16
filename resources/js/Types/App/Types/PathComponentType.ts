import FacebookPath from '@/Components/Icons/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Icons/Paths/LinkedinPath.vue';
import TwitterPath from '@/Components/Icons/Paths/TwitterPath.vue';
import YoutubePath from '@/Components/Icons/Paths/YoutubePath.vue';

export type PathComponentType =
    | typeof FacebookPath
    | typeof LinkedinPath
    | typeof TwitterPath
    | typeof YoutubePath;
