<template>
    <a
        :href="socialLink.url"
        target="_blank"
        rel="noopener noreferrer"
        class="text-gray-400 hover:text-white"
    >
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
            :class="`lucide lucide-${socialLink.icon}`"
        >
            <component :is="getPathComponent(socialLink.icon)" />
        </svg>
    </a>
</template>

<script setup lang="ts">
import FacebookPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/LinkedinPath.vue';
import TwitterPath from '@/Components/Layout/Footer/FooterSocialLink/Paths/TwitterPath.vue';
import YoutubePath from '@/Components/Layout/Footer/FooterSocialLink/Paths/YoutubePath.vue';
import { SocialLinkIconEnum } from '@/Types/App/Enums';
import { SocialLinkInterface } from '@/Types/App/Interfaces';
import { PathComponent } from '@/Types/App/Types';

const { socialLink }: { socialLink: SocialLinkInterface } = defineProps<{
    socialLink: SocialLinkInterface;
}>();

const pathComponents: Record<SocialLinkIconEnum, PathComponent> = {
    [SocialLinkIconEnum.FACEBOOK]: FacebookPath,
    [SocialLinkIconEnum.LINKEDIN]: LinkedinPath,
    [SocialLinkIconEnum.TWITTER]: TwitterPath,
    [SocialLinkIconEnum.YOUTUBE]: YoutubePath,
};

const getPathComponent = (icon: SocialLinkIconEnum): PathComponent =>
    pathComponents[icon];
</script>
