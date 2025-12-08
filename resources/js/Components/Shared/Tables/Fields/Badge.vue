<template>
    <td class="whitespace-nowrap px-4 py-5 text-sm text-gray-400">
        <span :class="getClass()">{{ getBadge() }}</span>
    </td>
</template>

<script setup lang="ts">
const {
    badge,
    mapping,
    label,
}: {
    badge: string;
    mapping?: Record<string, string>;
    label?: string;
} = defineProps<{
    badge: string;
    mapping?: Record<string, string>;
    label?: string;
}>();

const getClass = (): string => {
    let color: string = 'green';

    if (mapping && mapping[badge]) {
        color = mapping[badge];
    }

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};

const getBadge = (): string => (label ?? badge).replace(/_/g, ' ');
</script>
