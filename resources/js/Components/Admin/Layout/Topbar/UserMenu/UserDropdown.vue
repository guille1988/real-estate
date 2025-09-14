<template>
    <MenuItems
        class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-gray-800 py-2 outline -outline-offset-1 outline-white/10"
    >
        <MenuItem
            v-for="item in userDropdown"
            :key="item.name"
            v-slot="{ active }"
        >
            <Link
                :href="item.route"
                :class="[
                    active ? 'outline-hidden bg-white/5' : '',
                    'block px-3 py-1 text-sm/6 text-white',
                ]"
                >{{ item.name }}
            </Link>
        </MenuItem>
    </MenuItems>
</template>

<script setup lang="ts">
import { UserDropdownInterface } from '@/Types/Admin/Interfaces/UserDropdownInterface';
import { MenuItem, MenuItems } from '@headlessui/vue';
import { Link } from '@inertiajs/vue3';

const userDropdown: UserDropdownInterface[] = [
    { name: 'Your profile', route: '#' },
    { name: 'Sign out', route: '#' },
];
</script>
