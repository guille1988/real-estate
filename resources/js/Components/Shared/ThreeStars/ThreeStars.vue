<template>
    <div class="mb-4 flex items-center">
        <div class="h-6 w-6 text-gray-400">
            <BigWhiteStar></BigWhiteStar>
        </div>
        <div class="mx-1 h-4 w-4 text-gray-600">
            <SmallGreyStar></SmallGreyStar>
        </div>
        <div class="h-4 w-4 text-gray-600">
            <SmallGreyStar></SmallGreyStar>
        </div>
    </div>
</template>
<script setup lang="ts">
import BigWhiteStar from '@/Components/Shared/ThreeStars/BigWhiteStar.vue';
import SmallGreyStar from '@/Components/Shared/ThreeStars/SmallGreyStar.vue';
</script>
