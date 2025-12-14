<template>
    <div class="h-full">
        <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
    </div>
</template>

<script setup lang="ts">
import { Bar } from 'vue-chartjs';

import { LastTwelveMonthsMessagesInterface } from '@/Types/App/Interfaces/LastTwelveMonthsMessagesInterface';
import {
    BarElement,
    CategoryScale,
    Chart as ChartJS,
    Legend,
    LinearScale,
    Title,
    Tooltip,
} from 'chart.js';

const {
    lastTwelveMonthsMessages,
}: { lastTwelveMonthsMessages: LastTwelveMonthsMessagesInterface } =
    defineProps<{
        lastTwelveMonthsMessages: LastTwelveMonthsMessagesInterface;
    }>();

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
);

const chartData: any = {
    labels: lastTwelveMonthsMessages.labels,
    datasets: [
        {
            label: 'Last Twelve Months Property Messages + Inquiries',
            data: lastTwelveMonthsMessages.counts,
            backgroundColor: '#4f46e5',
            borderColor: '#6366f1',
            borderWidth: 1,
            borderRadius: 6,
        },
    ],
};

const chartOptions: Object = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: '#e5e7eb',
            },
        },
        title: { display: false },
        tooltip: { enabled: true },
    },
    scales: {
        x: {
            ticks: { color: '#9ca3af' },
            grid: { color: 'rgba(255,255,255,0.05)' },
        },
        y: {
            ticks: { color: '#9ca3af' },
            grid: { color: 'rgba(255,255,255,0.05)' },
        },
    },
};
</script>
