<template>
    <Link
        :href="DashboardController.url()"
        class="flex h-16 shrink-0 items-center"
    >
        <RealEstateIcon /> &nbsp;&nbsp;&nbsp;&nbsp;
        <b class="text-lg font-black uppercase text-white"> {{ appName }} </b>
    </Link>
</template>

<script setup lang="ts">
import RealEstateIcon from '@/Components/Icons/RealEstateIcon.vue';
import DashboardController from '@/Routes/actions/App/Http/Controllers/Admin/DashboardController';
import { Link } from '@inertiajs/vue3';

const appName: string = import.meta.env.VITE_APP_NAME || 'Laravel';
</script>
