<template>
    <Teleport to="#modal">
        <Transition>
            <div
                v-if="modelValue"
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
            >
                <div
                    class="fixed inset-0 bg-black opacity-75"
                    @click="closeModal"
                ></div>

                <div
                    class="relative max-h-[80vh] w-full max-w-5xl overflow-y-auto rounded-lg bg-black p-8 text-white shadow-xl"
                >
                    <button
                        @click="closeModal"
                        class="absolute right-4 top-4 text-white hover:text-purple-400"
                        aria-label="Close modal"
                    >
                        <CloseModalIcon />
                    </button>

                    <div>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup lang="ts">
import CloseModalIcon from '@/Components/Icons/CloseModalIcon.vue';
import { EmitFn } from 'vue';

defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
});

const emit: EmitFn<'update:modelValue'[]> = defineEmits(['update:modelValue']);

const closeModal = (): void => {
    emit('update:modelValue', false);
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 1s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
