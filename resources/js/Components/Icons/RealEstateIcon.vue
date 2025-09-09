<template>
    <img
        :src="realEstateLogo"
        :width="width"
        :height="height"
        alt="Real estate logo"
        class="object-contain"
    />
</template>

<script setup lang="ts">
import { GlobalAssetsInterface } from '@/Types/App/Interfaces/GlobalAssetsInterface';
import type { Page } from '@inertiajs/core';
import { usePage } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        width?: number;
        height?: number;
    }>(),
    {
        width: 48,
        height: 48,
    },
);

const page: Page<GlobalAssetsInterface> = usePage<GlobalAssetsInterface>();
const realEstateLogo = page.props.globalAssets.realEstateLogo;
</script>
