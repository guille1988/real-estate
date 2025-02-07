<template>
    <section class="container mx-auto px-4 py-16">
        <h2 class="mb-8 text-3xl font-bold">Featured Properties</h2>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div
                v-for="i in 3"
                :key="i"
                class="overflow-hidden rounded-lg bg-gray-800"
            >
                <PropertyCard :i="i"></PropertyCard>/
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import PropertyCard from '@/Components/Home/Property/PropertyCard.vue';
</script>
