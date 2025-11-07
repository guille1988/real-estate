<template>
    <tbody class="divide-y divide-white/10 bg-gray-900">
        <tr v-for="n in 7" :key="`${resource}-skeleton-${n}`">
            <td class="relative w-10 px-4">
                <div class="h-4 w-4 rounded bg-gray-800/40"></div>
            </td>
            <td class="whitespace-nowrap px-4 py-5">
                <div class="flex items-center gap-3">
                    <div
                        class="size-11 shrink-0 rounded-full bg-gray-800/60"
                    ></div>
                    <div class="h-5 w-40 rounded bg-gray-800/40"></div>
                </div>
            </td>
            <td class="whitespace-nowrap px-4 py-5">
                <div class="h-5 w-10 rounded bg-gray-800/40"></div>
            </td>
            <td class="whitespace-nowrap px-4 py-5">
                <div class="h-5 w-10 rounded bg-gray-800/40"></div>
            </td>
            <td class="whitespace-nowrap px-4 py-5">
                <div class="h-6 w-20 rounded-full bg-gray-800/40"></div>
            </td>
            <td class="whitespace-nowrap px-4 py-5">
                <div class="h-5 w-16 rounded bg-gray-800/40"></div>
            </td>
            <td class="whitespace-nowrap px-4 py-5 text-right">
                <div class="ml-auto flex w-24 justify-end gap-2">
                    <div class="h-8 w-8 rounded bg-gray-800/40"></div>
                    <div class="h-8 w-8 rounded bg-gray-800/40"></div>
                    <div class="h-8 w-8 rounded bg-gray-800/40"></div>
                </div>
            </td>
        </tr>
    </tbody>
</template>

<script setup lang="ts">
defineProps<{
    resource: string;
}>();
</script>
