<template>
    <MenuButton class="relative flex items-center">
        <span class="absolute -inset-1.5" />
        <img
            class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"
            src="https://previews.123rf.com/images/ricochet64/ricochet641903/ricochet64190300178/121658809-person-symbol-icon-in-a-circle.jpg"
            alt=""
        />
        <span class="hidden lg:flex lg:items-center">
            <span
                class="ml-4 text-sm/6 font-semibold text-white"
                aria-hidden="true"
                >Guillermo Felipetti</span
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
