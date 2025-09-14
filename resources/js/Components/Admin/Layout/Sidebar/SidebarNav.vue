<template>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li v-for="item in items" :key="item.name">
                        <Link
                            :href="item.route"
                            :class="[
                                item.current
                                    ? 'bg-purple-950/25 text-white'
                                    : 'text-purple-100 hover:bg-purple-950/25 hover:text-white',
                                'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                            ]"
                        >
                            <component
                                :is="item.icon"
                                :class="[
                                    item.current
                                        ? 'text-white'
                                        : 'text-purple-100 group-hover:text-white',
                                    'size-6 shrink-0',
                                ]"
                                aria-hidden="true"
                            />
                            {{ item.name }}
                        </Link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import type { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';
import { Link } from '@inertiajs/vue3';

defineProps<{ items: SidebarNavigationInterface[] }>();
</script>
