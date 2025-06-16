import FacebookPath from '@/Components/Icons/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Icons/Paths/LinkedinPath.vue';
import XPath from '@/Components/Icons/Paths/XPath.vue';
import YoutubePath from '@/Components/Icons/Paths/YoutubePath.vue';

export type PathComponentType =
    | typeof FacebookPath
    | typeof LinkedinPath
    | typeof XPath
    | typeof YoutubePath;
