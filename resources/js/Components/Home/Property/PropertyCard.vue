<template>
    <img
        src="https://images.squarespace-cdn.com/content/v1/58487dc4b8a79b6d02499b60/1649818728006-EX0EE6EYY82VW5KZMX7Q/Francis+York+One+of+the+Most+Beautiful+Homes+For+Sale+in+Illinois+17.jpg?format=2500w"
        alt="Property"
        class="h-48 w-full object-cover"
    />
    <div class="p-4">
        <h3 class="mb-2 text-xl font-bold">Beautiful House {{ i }}</h3>
        <p class="mb-4 text-gray-400">123 Main St, City, State</p>
        <div class="flex items-center justify-between">
            <span class="font-bold text-blue-500">$500,000</span>
            <button class="rounded bg-blue-600 px-4 py-2 hover:bg-blue-700">
                View Details
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    i: number;
}>();
</script>
