<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <AdminSidebar v-model:open="open" />

        <div class="lg:pl-72">
            <AdminTopbar v-model:open="open" />

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Ref, ref } from 'vue';
import AdminSidebar from './Sidebar.vue';
import AdminTopbar from './Topbar/Topbar.vue';

const open: Ref<boolean> = ref<boolean>(false);
</script>
