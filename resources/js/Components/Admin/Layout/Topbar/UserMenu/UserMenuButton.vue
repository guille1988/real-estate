<template>
    <MenuButton class="relative flex items-center">
        <span class="absolute -inset-1.5" />
        <img
            class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"
            :src="$page.props.auth.user.thumbnail ?? ''"
            alt=""
        />
        <span class="hidden lg:flex lg:items-center">
            <span
                class="ml-4 text-sm/6 font-semibold text-white"
                aria-hidden="true"
                >{{ $page.props.auth.user.name }}</span
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
