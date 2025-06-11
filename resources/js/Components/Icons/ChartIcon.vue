<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        :class="classes"
    >
        <path d="M3 3v18h18" />
        <path d="M7 17v-4h4" />
        <path d="M17 17v-8h4" />
        <path d="M13 17v-6h4" />
    </svg>
</template>
<script setup lang="ts">
defineProps<{
    classes: string | object;
}>();
</script>
