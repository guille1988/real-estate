<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <Sidebar v-model:open="open" />

        <div class="lg:pl-72">
            <Topbar v-model:open="open" />

            <main class="h-[calc(100vh-4rem)] overflow-auto py-6">
                <div class="h-full min-h-0 px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import Sidebar from '@/Components/Admin/Layout/Sidebar/Sidebar.vue';
import Topbar from '@/Components/Admin/Layout/Topbar/Topbar.vue';
import { ref, Ref } from 'vue';

const open: Ref<boolean> = ref<boolean>(false);
</script>
