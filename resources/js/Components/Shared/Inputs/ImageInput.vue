<template>
    <div>
        <label
            :for="id"
            class="block text-sm/6 font-medium text-white sm:pt-1.5"
            >{{ label }}</label
        >
        <div class="mt-2">
            <div class="col-span-full">
                <div class="mt-2 flex items-center gap-x-3">
                    <input
                        ref="fileInput"
                        :id="id"
                        type="file"
                        :accept="accept"
                        class="hidden"
                        @change="onFileChange"
                    />
                    <div
                        :class="[
                            'flex items-center justify-center overflow-hidden bg-gray-700',
                            circle
                                ? 'size-12 rounded-full'
                                : 'h-12 w-12 rounded-md',
                        ]"
                    >
                        <img
                            :src="computedPreview"
                            :alt="alt"
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <button
                        type="button"
                        @click="openFilePicker"
                        class="inset-ring inset-ring-white/5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20"
                    >
                        {{ buttonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Ref, computed, onBeforeUnmount, ref, watch } from 'vue';

const {
    id,
    label,
    modelValue,
    defaultImage,
    alt,
    buttonText,
    circle,
}: {
    id: string;
    label: string;
    modelValue: File | null;
    defaultImage?: string | null;
    alt: string;
    buttonText: string;
    circle?: boolean;
} = withDefaults(
    defineProps<{
        id: string;
        label: string;
        modelValue: File | null;
        defaultImage?: string | null;
        alt: string;
        buttonText: string;
        circle?: boolean;
    }>(),
    {
        initialUrl: null,
        circle: true,
    },
);

type Emits = {
    (e: 'update:modelValue', value: File | null): void;
};

const accept: string = 'image/*';
const emit = defineEmits<Emits>();
const fileInput: Ref<HTMLInputElement | null> = ref(null);
const preview: Ref<string | null> = ref<string | null>(null);

const computedPreview = computed<string>((): string => {
    return preview.value || defaultImage || '';
});

const openFilePicker = (): void => {
    fileInput.value?.click();
};

const onFileChange = (event: Event): void => {
    const input: HTMLInputElement = event.target as HTMLInputElement;

    if (!input.files || input.files.length === 0) {
        emit('update:modelValue', null);
        return;
    }

    emit('update:modelValue', input.files[0]);

    if (preview.value) {
        URL.revokeObjectURL(preview.value);
    }

    preview.value = URL.createObjectURL(input.files[0]);
};

onBeforeUnmount((): void => {
    if (preview.value) {
        URL.revokeObjectURL(preview.value);
    }
});

watch(
    (): File | null => modelValue,
    (file: File | null): void => {
        if (!file && preview.value) {
            URL.revokeObjectURL(preview.value);
            preview.value = null;
        }
    },
);
</script>
