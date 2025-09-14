<template>
    <Menu as="div" class="relative">
        <UserMenuButton />
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <UserDropdown />
        </transition>
    </Menu>
</template>

<script setup lang="ts">
import UserDropdown from '@/Components/Admin/Layout/Topbar/UserMenu/UserDropdown.vue';
import UserMenuButton from '@/Components/Admin/Layout/Topbar/UserMenu/UserMenuButton.vue';
import { Menu } from '@headlessui/vue';
</script>
