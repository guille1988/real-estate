<template>
    <MobileSidebar v-model:open="isOpen" :items="items" />
    <DesktopSidebar :items="items" />
</template>

<script setup lang="ts">
import DesktopSidebar from '@/Components/Admin/Layout/Sidebar/DesktopSidebar.vue';
import MobileSidebar from '@/Components/Admin/Layout/Sidebar/MobileSidebar.vue';
import AmenityController from '@/Routes/actions/App/Http/Controllers/Admin/AmenityController';
import ContactMessageController from '@/Routes/actions/App/Http/Controllers/Admin/ContactMessageController';
import DashboardController from '@/Routes/actions/App/Http/Controllers/Admin/DashboardController';
import ImageController from '@/Routes/actions/App/Http/Controllers/Admin/ImageController';
import InquiryController from '@/Routes/actions/App/Http/Controllers/Admin/InquiryController';
import PricingDetailController from '@/Routes/actions/App/Http/Controllers/Admin/PricingDetailController';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import PropertyMessageController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyMessageController';
import SubscriberController from '@/Routes/actions/App/Http/Controllers/Admin/SubscriberController';
import { PageEnum } from '@/Types/Admin/Enums/PageEnum';
import type { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';
import { PageProps } from '@/Types/Core';
import {
    ChartPieIcon,
    CurrencyDollarIcon,
    EnvelopeIcon,
    GiftIcon,
    HomeIcon,
    InboxIcon,
    InboxStackIcon,
    PhotoIcon,
    UserGroupIcon,
} from '@heroicons/vue/24/outline';
import { Page } from '@inertiajs/core';
import { usePage } from '@inertiajs/vue3';
import { computed, ComputedRef } from 'vue';

const navigationItems: SidebarNavigationInterface[] = [
    {
        name: PageEnum.DASHBOARD,
        route: DashboardController.url(),
        icon: ChartPieIcon,
        current: true,
    },
    {
        name: PageEnum.PROPERTIES,
        route: PropertyController.index().url,
        icon: HomeIcon,
        current: false,
    },
    {
        name: PageEnum.IMAGES,
        route: ImageController.index().url,
        icon: PhotoIcon,
        current: false,
    },
    {
        name: PageEnum.PRICING_DETAILS,
        route: PricingDetailController.index().url,
        icon: CurrencyDollarIcon,
        current: false,
    },
    {
        name: PageEnum.AMENITIES,
        route: AmenityController.index().url,
        icon: GiftIcon,
        current: false,
    },
    {
        name: PageEnum.PROPERTY_MESSAGES,
        route: PropertyMessageController.index().url,
        icon: EnvelopeIcon,
        current: false,
    },
    {
        name: PageEnum.INQUIRIES,
        route: InquiryController.index().url,
        icon: InboxIcon,
        current: false,
    },
    {
        name: PageEnum.CONTACT_MESSAGES,
        route: ContactMessageController.index().url,
        icon: InboxStackIcon,
        current: false,
    },
    {
        name: PageEnum.SUBSCRIBERS,
        route: SubscriberController.index().url,
        icon: UserGroupIcon,
        current: false,
    },
];

const { open }: { open: boolean } = defineProps<{
    open: boolean;
}>();

const emit = defineEmits<{ (e: 'update:open', value: boolean): void }>();

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => open ?? false,
    set: (value: boolean): void => emit('update:open', value),
});

const items = computed<SidebarNavigationInterface[]>(
    (): SidebarNavigationInterface[] => {
        const page: Page<PageProps> = usePage();
        const currentPath: string = (page.url ?? '').split('?')[0] || '/';

        let found: boolean = false;

        const mapped = navigationItems.map(
            (item: SidebarNavigationInterface): SidebarNavigationInterface => {
                const isCurrent = item.route === currentPath;

                if (isCurrent) {
                    found = true;
                }

                return { ...item, current: isCurrent };
            },
        );

        if (!found) {
            return mapped.map(
                (
                    item: SidebarNavigationInterface,
                ): SidebarNavigationInterface => ({
                    ...item,
                    current: item.name === PageEnum.DASHBOARD,
                }),
            );
        }

        return mapped;
    },
);
</script>
