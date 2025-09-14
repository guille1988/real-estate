<template>
    <div class="flex h-16 shrink-0 items-center">
        <RealEstateIcon /> &nbsp;&nbsp;&nbsp;&nbsp;
        <b class="text-lg font-black uppercase text-white"> {{ appName }} </b>
    </div>
</template>

<script setup lang="ts">
import RealEstateIcon from '@/Components/Icons/RealEstateIcon.vue';

const appName: string = import.meta.env.VITE_APP_NAME || 'Laravel';
</script>
