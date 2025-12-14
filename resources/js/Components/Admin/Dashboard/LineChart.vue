<template>
    <div class="h-full">
        <Line id="line-chart-id" :options="chartOptions" :data="chartData" />
    </div>
</template>

<script setup lang="ts">
import { LastSevenDaysMessagesInterface } from '@/Types/App/Interfaces/LastSevenDaysMessagesInterface';
import {
    CategoryScale,
    Chart as ChartJS,
    Filler,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    Title,
    Tooltip,
} from 'chart.js';
import { Line } from 'vue-chartjs';

const {
    lastSevenDaysMessages,
}: { lastSevenDaysMessages: LastSevenDaysMessagesInterface } = defineProps<{
    lastSevenDaysMessages: LastSevenDaysMessagesInterface;
}>();

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
    Filler,
);

const chartData: any = {
    labels: lastSevenDaysMessages.labels,
    datasets: [
        {
            label: 'Last Seven Days Property Messages + Inquiries',
            data: lastSevenDaysMessages.counts,
            borderColor: '#60a5fa',
            backgroundColor: 'rgba(96, 165, 250, 0.2)',
            tension: 0.35,
            fill: true,
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
        title: {
            display: false,
        },
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
