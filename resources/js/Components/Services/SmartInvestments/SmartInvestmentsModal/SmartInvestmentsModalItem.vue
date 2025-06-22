<template>
    <div>
        <h3 class="mt-6 text-xl font-semibold text-purple-400">
            {{ item.subtitle }}
        </h3>

        <template v-for="(paragraph, index) in item.paragraphs" :key="index">
            <p :class="{ 'mt-4': index > 0 }">
                <span
                    v-if="paragraph.includes('\n')"
                    v-html="formatText(paragraph)"
                ></span>
                <span v-else>{{ paragraph }}</span>
            </p>
        </template>
    </div>
</template>

<script setup lang="ts">
import { formatText } from '@/Composables/useTextFormatting';
import { SmartInvestmentsModalItemInterface } from '@/Types/App/Interfaces/SmartInvestmentsModalItemInterface';

const { item }: { item: SmartInvestmentsModalItemInterface } = defineProps<{
    item: SmartInvestmentsModalItemInterface;
}>();
</script>
