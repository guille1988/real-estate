<template>
    <a class="text-gray-400 hover:text-white">
        <FooterSocialLinkIcon :icon="socialLink.icon">
            <path
                v-if="iconEqualsTo(SocialLinkIconEnum.FACEBOOK)"
                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
            />
            <template v-else-if="iconEqualsTo(SocialLinkIconEnum.LINKEDIN)">
                <path
                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                />
                <rect width="4" height="12" x="2" y="9" />
                <circle cx="4" cy="4" r="2" />
            </template>
            <path
                v-else-if="iconEqualsTo(SocialLinkIconEnum.TWITTER)"
                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"
            />
            <template v-else-if="iconEqualsTo(SocialLinkIconEnum.YOUTUBE)">
                <path
                    d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"
                />
                <path d="m10 15 5-3-5-3z" />
            </template>
        </FooterSocialLinkIcon>
    </a>
</template>

<script setup lang="ts">
import FooterSocialLinkIcon from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon.vue';
import { SocialLinkIconEnum } from '@/Types/App/Enums';
import { SocialLinkInterface } from '@/Types/App/Interfaces';

const { socialLink }: { socialLink: SocialLinkInterface } = defineProps<{
    socialLink: SocialLinkInterface;
}>();

const iconEqualsTo = (icon: SocialLinkIconEnum) => socialLink.icon === icon;
</script>
