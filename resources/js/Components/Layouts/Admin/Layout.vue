<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <AdminSidebar v-model:open="sidebarOpen" :navigation="navigation" />

        <div class="lg:pl-72">
            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-white/10 bg-gray-900 px-4 sm:gap-x-6 sm:px-6 lg:px-8"
            >
                <button
                    type="button"
                    class="-m-2.5 p-2.5 text-gray-400 hover:text-white lg:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="size-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div
                    class="h-6 w-px bg-white/10 lg:hidden"
                    aria-hidden="true"
                />

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <form
                        class="grid flex-1 grid-cols-1"
                        action="#"
                        method="GET"
                    >
                        <input
                            name="search"
                            aria-label="Search"
                            class="col-start-1 row-start-1 block size-full rounded-md border border-white/10 bg-gray-900 pl-10 pr-3 text-base text-white caret-purple-400 selection:bg-purple-600 selection:text-white placeholder:text-gray-500 focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-0 sm:text-sm/6"
                            placeholder="Search"
                        />
                        <MagnifyingGlassIcon
                            class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400"
                            aria-hidden="true"
                        />
                    </form>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <button
                            type="button"
                            class="-m-2.5 p-2.5 text-gray-400 hover:text-white"
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="size-6" aria-hidden="true" />
                        </button>

                        <!-- Separator -->
                        <div
                            class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-100/10"
                            aria-hidden="true"
                        />

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="relative flex items-center">
                                <span class="absolute -inset-1.5" />
                                <span class="sr-only">Open user menu</span>
                                <img
                                    class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                />
                                <span class="hidden lg:flex lg:items-center">
                                    <span
                                        class="ml-4 text-sm/6 font-semibold text-white"
                                        aria-hidden="true"
                                        >Tom Cook</span
                                    >
                                    <ChevronDownIcon
                                        class="ml-2 size-5 text-gray-500"
                                        aria-hidden="true"
                                    />
                                </span>
                            </MenuButton>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-gray-800 py-2 outline -outline-offset-1 outline-white/10"
                                >
                                    <MenuItem
                                        v-for="item in userNavigation"
                                        :key="item.name"
                                        v-slot="{ active }"
                                    >
                                        <a
                                            :href="item.href"
                                            :class="[
                                                active
                                                    ? 'outline-hidden bg-white/5'
                                                    : '',
                                                'block px-3 py-1 text-sm/6 text-white',
                                            ]"
                                            >{{ item.name }}</a
                                        >
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import { SidebarNavigationInterface } from '@/Types/App/Interfaces/Admin/SidebarNavigationInterface';
import { UserNavigationInterface } from '@/Types/App/Interfaces/Admin/UserNavigationInterface';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
import {
    Bars3Icon,
    BellIcon,
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline';
import { Ref, ref } from 'vue';
import AdminSidebar from './Sidebar.vue';

const navigation: SidebarNavigationInterface[] = [
    { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
    { name: 'Team', href: '#', icon: UsersIcon, current: false },
    { name: 'Projects', href: '#', icon: FolderIcon, current: false },
    { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    {
        name: 'Documents',
        href: '#',
        icon: DocumentDuplicateIcon,
        current: false,
    },
    { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
];
const userNavigation: UserNavigationInterface[] = [
    { name: 'Your profile', href: '#' },
    { name: 'Sign out', href: '#' },
];

const sidebarOpen: Ref<boolean> = ref<boolean>(false);
</script>
