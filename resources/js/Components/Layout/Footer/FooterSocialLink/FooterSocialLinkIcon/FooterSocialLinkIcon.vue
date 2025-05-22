<template>
    <a class="text-gray-400 hover:text-white">
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
            <slot></slot>
        </svg>
    </a>
</template>

<script setup lang="ts">
import { SocialLinkIconEnum } from '@/Types/App/Enums';

defineProps<{
    icon: SocialLinkIconEnum;
}>();
</script>
