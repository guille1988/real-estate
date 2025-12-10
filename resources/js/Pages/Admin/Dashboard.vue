<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <div class="mb-4 md:mb-6">
                <Stats />
            </div>
            <div
                class="grid min-h-0 flex-1 grid-cols-1 gap-4 md:grid-cols-2 md:gap-6"
            >
                <div
                    class="flex min-h-0 flex-col rounded-lg bg-gray-800/75 p-4"
                >
                    <div class="min-h-0 flex-1">
                        <BarChart />
                    </div>
                </div>
                <div
                    class="flex min-h-0 flex-col rounded-lg bg-gray-800/75 p-4"
                >
                    <div class="min-h-0 flex-1">
                        <LineChart />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import BarChart from '@/Components/Admin/Dashboard/BarChart.vue';
import LineChart from '@/Components/Admin/Dashboard/LineChart.vue';
import Stats from '@/Components/Admin/Dashboard/Stats.vue';
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    monthlyMessagesData: object;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
