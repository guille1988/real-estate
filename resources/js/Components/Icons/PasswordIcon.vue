<template>
    <svg
        v-if="showPassword"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.5"
        class="h-5 w-5"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.32 16.168 7.258 19.178 11.898 19.178c1.52 0 2.969-.302 4.286-.849M6.228 6.228A10.45 10.45 0 0111.898 4.822c4.64 0 8.577 3.01 9.964 7.178-.34.993-.848 1.917-1.492 2.742M6.228 6.228L3 3m3.228 3.228L21 21M14.121 9.879a3 3 0 00-4.242 4.242"
        />
    </svg>
    <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.5"
        class="h-5 w-5"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.207.07.437 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
        />
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
        />
    </svg>
</template>

<script setup lang="ts">
defineProps<{
    showPassword: boolean;
}>();
</script>
