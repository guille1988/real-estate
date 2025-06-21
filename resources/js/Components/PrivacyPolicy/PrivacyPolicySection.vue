<template>
    <div>
        <h2 class="mb-4 mt-8 text-2xl font-semibold text-purple-500">
            {{ section.title }}
        </h2>
        <p v-if="typeof section.content === 'string'">
            {{ section.content }}
        </p>
        <ul v-else class="mb-4 list-disc pl-6">
            <li v-for="(item, index) in section.content" :key="index">
                {{ item }}
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { PrivacyPolicyInterface } from '@/Types/App/Interfaces/PrivacyPolicyInterface';

defineProps<{
    section: PrivacyPolicyInterface;
}>();
</script>
