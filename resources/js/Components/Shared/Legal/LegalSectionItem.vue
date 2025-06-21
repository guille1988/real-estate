<template>
    <div>
        <h2 class="mb-4 mt-8 text-2xl font-semibold text-purple-500">
            {{ section_item.title }}
        </h2>
        <p v-if="section_item.is_string">
            {{ section_item.content }}
        </p>
        <ul v-else class="mb-4 list-disc pl-6">
            <li v-for="(item, index) in section_item.content" :key="index">
                {{ item }}
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { LegalSectionItemInterface } from '@/Types/App/Interfaces/LegalSectionItemInterface';

defineProps<{
    section_item: LegalSectionItemInterface;
}>();
</script>
