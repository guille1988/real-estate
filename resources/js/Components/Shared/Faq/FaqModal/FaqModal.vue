<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                {{ card.title }}
            </h2>

            <FaqModalItem
                v-for="item in card.modalItems"
                :key="item.id"
                :item="item"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import { FaqCardInterface } from '@/Types/App/Interfaces/FaqCardInterface';
import { computed, ComputedRef, EmitFn } from 'vue';
import FaqModalItem from './FaqModalItem.vue';

const { modelValue, card }: { modelValue: boolean; card: FaqCardInterface } =
    defineProps({
        modelValue: {
            type: Boolean,
            required: true,
        },
        card: {
            type: Object as () => FaqCardInterface,
            required: true,
        },
    });

const emit: EmitFn<'update:modelValue'[]> = defineEmits(['update:modelValue']);

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => modelValue,
    set: (value: boolean): void => emit('update:modelValue', value),
});
</script>
