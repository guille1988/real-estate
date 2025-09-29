<template>
    <td class="whitespace-nowrap px-4 py-5 text-sm text-gray-400">
        <div class="text-white">
            {{ text }}
        </div>
    </td>
</template>

<script setup lang="ts">
defineProps<{
    text: string | number;
}>();
</script>
