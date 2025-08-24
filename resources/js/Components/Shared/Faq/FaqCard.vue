<template>
    <div
        class="flex h-full flex-col rounded-xl border border-gray-800 bg-gray-900/50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
    >
        <h2 class="mb-6 text-2xl font-bold text-white">
            {{ card.title }}
        </h2>
        <p class="mb-8 flex-grow text-gray-400">
            {{ card.description }}
        </p>
        <button
            class="self-start rounded-md border border-gray-800 bg-black px-6 py-3 text-white transition-colors hover:bg-gray-900"
            @click="openModal()"
        >
            Read More
        </button>
    </div>

    <FaqModal v-model="showModal" :card="card" />
</template>

<script setup lang="ts">
import FaqModal from '@/Components/Shared/Faq/FaqModal/FaqModal.vue';
import { FaqInterface } from '@/Types/App/Interfaces/FaqInterface';
import { ref, Ref } from 'vue';

defineProps<{
    card: FaqInterface;
}>();

const showModal: Ref<boolean> = ref<boolean>(false);

const openModal = (): void => {
    showModal.value = true;
};
</script>
