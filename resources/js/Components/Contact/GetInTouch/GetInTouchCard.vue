<template>
    <a
        :href="card.link"
        class="group relative block cursor-pointer border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
    >
        <div class="absolute right-4 top-4">
            <LinkArrowIcon />
        </div>
        <div class="flex flex-col items-center text-center">
            <div
                class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-500/10"
            >
                <component
                    :is="icon"
                    :classes="{
                        'h-6 w-6 text-purple-500': [
                            'EmailIcon',
                            'LocalizationIcon',
                            'PhoneIcon',
                        ].includes(card.icon),
                    }"
                />
            </div>
            <span class="text-gray-400 group-hover:text-white">{{
                card.label
            }}</span>
        </div>
    </a>
</template>
<script setup lang="ts">
import LinkArrowIcon from '@/Components/Icons/LinkArrowIcon.vue';
import { GetInTouchCardInterface } from '@/Types/App/Interfaces';
import { type Component, defineAsyncComponent } from 'vue';

const { card }: { card: GetInTouchCardInterface } = defineProps<{
    card: GetInTouchCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./../../Icons/${card.icon}.vue`) as Promise<Component>,
);
</script>
