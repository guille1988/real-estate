<template>
    <MobileSidebar v-model:open="isOpen" :items="navigationItems" />
    <DesktopSidebar :items="navigationItems" />
</template>

<script setup lang="ts">
import DesktopSidebar from '@/Components/Admin/Layout/Sidebar/DesktopSidebar.vue';
import MobileSidebar from '@/Components/Admin/Layout/Sidebar/MobileSidebar.vue';
import DashboardController from '@/Routes/actions/App/Http/Controllers/Admin/DashboardController';
import { PageEnum } from '@/Types/Admin/Enums/PageEnum';
import type { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';
import { ChartPieIcon, HomeIcon } from '@heroicons/vue/24/outline';
import { computed, ComputedRef } from 'vue';

const navigationItems: SidebarNavigationInterface[] = [
    {
        name: PageEnum.DASHBOARD,
        route: DashboardController.url(),
        icon: ChartPieIcon,
        current: true,
    },
    { name: PageEnum.PROPERTIES, route: '#', icon: HomeIcon, current: false },
];

const { open }: { open: boolean } = defineProps<{
    open: boolean;
}>();

const emit = defineEmits<{ (e: 'update:open', value: boolean): void }>();

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => open ?? false,
    set: (value: boolean): void => emit('update:open', value),
});
</script>
