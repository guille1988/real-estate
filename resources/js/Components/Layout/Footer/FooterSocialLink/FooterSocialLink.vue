<template>
    <a class="text-gray-400 hover:text-white">
        <FooterSocialLinkIcon :icon="socialLink.icon">
            <FacebookPath v-if="iconEqualsTo(SocialLinkIconEnum.FACEBOOK)" />
            <LinkedinPath
                v-else-if="iconEqualsTo(SocialLinkIconEnum.LINKEDIN)"
            />
            <TwitterPath v-else-if="iconEqualsTo(SocialLinkIconEnum.TWITTER)" />
            <YoutubePath v-else-if="iconEqualsTo(SocialLinkIconEnum.YOUTUBE)" />
        </FooterSocialLinkIcon>
    </a>
</template>

<script setup lang="ts">
import FooterSocialLinkIcon from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon/FooterSocialLinkIcon.vue';
import FacebookPath from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon/Paths/FacebookPath.vue';
import LinkedinPath from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon/Paths/LinkedinPath.vue';
import TwitterPath from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon/Paths/TwitterPath.vue';
import YoutubePath from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLinkIcon/Paths/YoutubePath.vue';
import { SocialLinkIconEnum } from '@/Types/App/Enums';
import { SocialLinkInterface } from '@/Types/App/Interfaces';

const { socialLink }: { socialLink: SocialLinkInterface } = defineProps<{
    socialLink: SocialLinkInterface;
}>();

const iconEqualsTo = (icon: SocialLinkIconEnum) => socialLink.icon === icon;
</script>
