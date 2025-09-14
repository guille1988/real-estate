<template>
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
</template>

<script setup lang="ts">
import { MenuButton } from '@headlessui/vue';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
</script>
