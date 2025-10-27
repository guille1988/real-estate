<template>
    <h1>Here is show view</h1>
</template>

<script setup lang="ts">
import { ShowPropertyInterface } from '@/Types/Admin/Interfaces/ShowPropertyInterface';

defineProps<{
    property: ShowPropertyInterface;
}>();
</script>
