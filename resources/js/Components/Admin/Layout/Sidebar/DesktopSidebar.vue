<template>
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <div
            class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-purple-800 px-6 pb-4 after:pointer-events-none after:absolute after:inset-y-0 after:right-0 after:w-px after:bg-white/10"
        >
            <RealStateSidebarTitle />
            <SidebarNav :items="items" />
        </div>
    </div>
</template>

<script setup lang="ts">
import RealStateSidebarTitle from '@/Components/Admin/Layout/Sidebar/RealStateSidebarTitle.vue';
import SidebarNav from '@/Components/Admin/Layout/Sidebar/SidebarNav.vue';
import type { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';

defineProps<{
    items: SidebarNavigationInterface[];
}>();
</script>
