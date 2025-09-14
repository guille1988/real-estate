<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 mb-8 flex min-h-screen w-full flex-col rounded-xl bg-black p-6 text-white"
        >
            <div class="mb-6">
                <Stats />
            </div>
            <div class="grid min-h-0 flex-1 grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="flex h-full flex-col rounded-lg bg-gray-800/75 p-4">
                    <div class="min-h-0 flex-1">
                        <BarChart />
                    </div>
                </div>
                <div class="flex h-full flex-col rounded-lg bg-gray-800/75 p-4">
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
</script>
