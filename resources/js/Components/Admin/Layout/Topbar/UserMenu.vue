<template>
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
                    v-for="item in userMenu"
                    :key="item.name"
                    v-slot="{ active }"
                >
                    <a
                        :href="item.route"
                        :class="[
                            active ? 'outline-hidden bg-white/5' : '',
                            'block px-3 py-1 text-sm/6 text-white',
                        ]"
                        >{{ item.name }}</a
                    >
                </MenuItem>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup lang="ts">
import { UserMenuInterface } from '@/Types/Admin/Interfaces/UserMenuInterface';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';

const userMenu: UserMenuInterface[] = [
    { name: 'Your profile', route: '#' },
    { name: 'Sign out', route: '#' },
];
</script>
