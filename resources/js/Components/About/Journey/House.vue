<template>
    <div class="lg:col-span-5">
        <div
            class="flex h-full w-full items-center justify-center lg:justify-end"
        >
            <img
                :src="house"
                alt="Hand holding a model house"
                class="mx-auto h-auto w-11/12 object-contain"
            />
        </div>
    </div>
</template>
<script setup lang="ts">
defineProps<{
    house: string;
}>();
</script>
