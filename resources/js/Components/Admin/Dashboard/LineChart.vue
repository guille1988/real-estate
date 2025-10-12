<template>
    <div class="h-full">
        <Line id="line-chart-id" :options="chartOptions" :data="chartData" />
    </div>
</template>

<script setup lang="ts">
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
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [
        {
            label: 'Visitors',
            data: [120, 150, 90, 170, 200, 140, 180],
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
