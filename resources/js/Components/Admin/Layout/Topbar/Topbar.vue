<template>
    <div
        class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-white/10 bg-gray-900 px-4 sm:gap-x-6 sm:px-6 lg:px-8"
    >
        <button
            type="button"
            class="-m-2.5 p-2.5 text-gray-400 hover:text-white lg:hidden"
            @click="emitOpen()"
        >
            <span class="sr-only">Open sidebar</span>
            <Bars3Icon class="size-6" aria-hidden="true" />
        </button>

        <div class="h-6 w-px bg-white/10 lg:hidden" aria-hidden="true" />

        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
            <SearchBar />
            <div class="flex items-center gap-x-4 lg:gap-x-6">
                <Bell />

                <div
                    class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-100/10"
                    aria-hidden="true"
                />

                <UserMenu />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Bell from '@/Components/Admin/Layout/Topbar/Bell.vue';
import SearchBar from '@/Components/Admin/Layout/Topbar/SearchBar.vue';
import UserMenu from '@/Components/Admin/Layout/Topbar/UserMenu.vue';
import { Bars3Icon } from '@heroicons/vue/24/outline';

defineProps<{
    open: boolean;
}>();

const emit = defineEmits<{ (e: 'update:open', value: boolean): void }>();
const emitOpen = (): void => emit('update:open', true);
</script>
