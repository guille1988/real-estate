<template>
    <td class="whitespace-nowrap px-4 py-5 text-sm">
        <div class="flex items-center">
            <div class="size-11 shrink-0">
                <img
                    class="size-11 rounded-full outline outline-white/10"
                    :src="image"
                    :alt="text"
                />
            </div>
            <div class="ml-4">
                <div class="font-medium text-white">
                    {{ text }}
                </div>
            </div>
        </div>
    </td>
</template>

<script setup lang="ts">
defineProps<{
    image: string;
    text: string;
}>();
</script>
