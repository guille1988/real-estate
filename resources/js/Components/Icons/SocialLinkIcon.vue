<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="18"
        height="18"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        :class="`lucide lucide-${icon}`"
    >
        <component :is="getComponent()" />
    </svg>
</template>

<script setup lang="ts">
import FacebookPath from '@/Components/Icons/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Icons/Paths/LinkedinPath.vue';
import XPath from '@/Components/Icons/Paths/XPath.vue';
import YoutubePath from '@/Components/Icons/Paths/YoutubePath.vue';
import { SocialLinkIconEnum } from '@/Types/App/Enums/SocialLinkIconEnum';
import { PathComponentType } from '@/Types/App/Types/PathComponentType';

const { icon }: { icon: SocialLinkIconEnum } = defineProps<{
    icon: SocialLinkIconEnum;
}>();

const getComponent = (): PathComponentType => {
    const paths: Record<SocialLinkIconEnum, PathComponentType> = {
        [SocialLinkIconEnum.FACEBOOK]: FacebookPath,
        [SocialLinkIconEnum.LINKEDIN]: LinkedinPath,
        [SocialLinkIconEnum.X]: XPath,
        [SocialLinkIconEnum.YOUTUBE]: YoutubePath,
    };

    return paths[icon];
};
</script>
