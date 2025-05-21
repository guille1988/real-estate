<template>
    <div class="mt-4 md:mt-0">
        <h3 class="mb-4 text-sm font-semibold text-white">
            {{ category.title }}
        </h3>
        <ul class="space-y-2 text-sm text-gray-400">
            <li v-for="link in category.links" :key="link.id">
                <a :href="link.url" class="hover:text-white">{{ link.text }}</a>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { FooterCategoryInterface } from '@/Types/App/Interfaces';

const { category }: { category: FooterCategoryInterface } = defineProps<{
    category: FooterCategoryInterface;
}>();
</script>
