<template>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script setup lang="ts">
import { Bar } from 'vue-chartjs';

import {
    BarElement,
    CategoryScale,
    Chart as ChartJS,
    Legend,
    LinearScale,
    Title,
    Tooltip,
} from 'chart.js';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
);

const chartData: Object = {
    labels: ['January', 'February', 'March'],
    datasets: [{ data: [40, 20, 12] }],
};

const chartOptions: Object = {
    responsive: true,
};
</script>
