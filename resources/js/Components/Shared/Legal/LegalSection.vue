<template>
    <div class="w-full bg-black">
        <div class="container mx-auto px-4 py-12">
            <h1 class="mb-8 text-4xl font-bold">{{ section.title }}</h1>

            <div class="prose prose-lg prose-invert max-w-none">
                <LegalSectionItem
                    v-for="sectionItem in section.section_items"
                    :key="sectionItem.id"
                    :section_item="sectionItem"
                />

                <div class="mt-12 text-right">
                    <button
                        @click="router.visit(section.previous_url)"
                        class="rounded-md bg-purple-500 px-6 py-3 text-white transition duration-300 hover:bg-purple-600"
                    >
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import LegalSectionItem from '@/Components/Shared/Legal/LegalSectionItem.vue';
import { LegalSectionInterface } from '@/Types/App/Interfaces/LegalSectionInterface';
import { router } from '@inertiajs/vue3';

defineProps<{
    section: LegalSectionInterface;
}>();
</script>
