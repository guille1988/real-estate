<template>
    <a
        :href="socialLink.url"
        target="_blank"
        rel="noopener noreferrer"
        class="text-gray-400 hover:text-white"
    >
        <SocialLinkIcon :icon="socialLink.icon" />
    </a>
</template>

<script setup lang="ts">
import SocialLinkIcon from '@/Components/Icons/SocialLinkIcon.vue';
import { SocialLinkInterface } from '@/Types/App/Interfaces/SocialLinkInterface';

const { socialLink }: { socialLink: SocialLinkInterface } = defineProps<{
    socialLink: SocialLinkInterface;
}>();
</script>
