<template>
    <!-- Mobile sidebar -->
    <TransitionRoot as="template" :show="isOpen">
        <Dialog class="relative z-50 lg:hidden" @close="emitClose()">
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to=""
                leave="transition-opacity ease-linear duration-300"
                leave-from=""
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-900/80" />
            </TransitionChild>

            <div class="fixed inset-0 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative mr-16 flex w-full max-w-xs flex-1"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to=""
                            leave="ease-in-out duration-300"
                            leave-from=""
                            leave-to="opacity-0"
                        >
                            <div
                                class="absolute left-full top-0 flex w-16 justify-center pt-5"
                            >
                                <button
                                    type="button"
                                    class="-m-2.5 p-2.5"
                                    @click="emitClose()"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon
                                        class="size-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>

                        <!-- Sidebar content -->
                        <div
                            class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-purple-800 px-6 pb-4 ring-1 ring-white/10"
                        >
                            <div class="flex h-16 shrink-0 items-center">
                                <img
                                    class="h-8 w-auto"
                                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white"
                                    alt="Your Company"
                                />
                            </div>
                            <nav class="flex flex-1 flex-col">
                                <ul
                                    role="list"
                                    class="flex flex-1 flex-col gap-y-7"
                                >
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li
                                                v-for="item in navigation"
                                                :key="item.name"
                                            >
                                                <a
                                                    :href="item.route"
                                                    :class="[
                                                        item.current
                                                            ? 'bg-purple-950/25 text-white'
                                                            : 'text-purple-100 hover:bg-purple-950/25 hover:text-white',
                                                        'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                                    ]"
                                                >
                                                    <component
                                                        :is="item.icon"
                                                        :class="[
                                                            item.current
                                                                ? 'text-white'
                                                                : 'text-purple-100 group-hover:text-white',
                                                            'size-6 shrink-0',
                                                        ]"
                                                        aria-hidden="true"
                                                    />
                                                    {{ item.name }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <!-- Desktop sidebar -->
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <div
            class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-purple-800 px-6 pb-4 after:pointer-events-none after:absolute after:inset-y-0 after:right-0 after:w-px after:bg-white/10"
        >
            <div class="flex h-16 shrink-0 items-center">
                <img
                    class="h-8 w-auto"
                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white"
                    alt="Your Company"
                />
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li v-for="item in navigation" :key="item.name">
                                <a
                                    :href="item.route"
                                    :class="[
                                        item.current
                                            ? 'bg-purple-950/25 text-white'
                                            : 'text-purple-100 hover:bg-purple-950/25 hover:text-white',
                                        'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        :class="[
                                            item.current
                                                ? 'text-white'
                                                : 'text-purple-100 group-hover:text-white',
                                            'size-6 shrink-0',
                                        ]"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup lang="ts">
import { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import {
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline';
import { computed, ComputedRef } from 'vue';

const navigation: SidebarNavigationInterface[] = [
    { name: 'Dashboard', route: '#', icon: HomeIcon, current: true },
    { name: 'Team', route: '#', icon: UsersIcon, current: false },
    { name: 'Projects', route: '#', icon: FolderIcon, current: false },
    { name: 'Calendar', route: '#', icon: CalendarIcon, current: false },
    {
        name: 'Documents',
        route: '#',
        icon: DocumentDuplicateIcon,
        current: false,
    },
    { name: 'Reports', route: '#', icon: ChartPieIcon, current: false },
];

const { open }: { open: boolean } = defineProps<{
    open: boolean;
}>();

const emit = defineEmits<{ (e: 'update:open', value: boolean): void }>();

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => open ?? false,
    set: (value: boolean): void => emit('update:open', value),
});

const emitClose = (): void => emit('update:open', false);
</script>
