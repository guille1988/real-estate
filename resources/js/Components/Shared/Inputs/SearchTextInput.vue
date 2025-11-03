<template>
    <div class="relative">
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <input
                ref="inputRef"
                :id="id"
                v-model="searchText"
                type="text"
                :placeholder="placeholder"
                class="w-full rounded border border-gray-700 bg-black/70 p-3 pr-10 text-sm focus:border-purple-500 focus:outline-none"
                @focus="open = true"
                @blur="onBlur"
                @keydown.down.prevent="highlightNext()"
                @keydown.up.prevent="highlightPrev()"
                @keydown.enter.prevent="selectHighlighted()"
                @keydown.esc.prevent="open = false"
            />
            <button
                v-if="hasText"
                type="button"
                class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 hover:text-white focus:outline-none"
                @mousedown.prevent
                @click="clearSearch"
                aria-label="Clear search"
                :title="'Clear'"
            >
                <CancelSearchIcon />
            </button>
            <div
                v-if="open"
                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md border border-white/10 bg-black/95 py-1 shadow-lg"
            >
                <template v-if="filteredOptions.length > 0">
                    <button
                        v-for="(option, idx) in filteredOptions"
                        :key="`${id}-option-${option.value}`"
                        type="button"
                        @mousedown.prevent="selectOption(option)"
                        :class="[
                            'flex w-full items-center px-3 py-2 text-left text-sm',
                            highlightedIndex === idx
                                ? 'bg-white/10 text-white'
                                : 'text-gray-200 hover:bg-white/10 hover:text-white',
                        ]"
                    >
                        {{ option.label }}
                    </button>
                </template>
                <div v-else class="px-3 py-2 text-sm text-gray-400">
                    No results found
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import CancelSearchIcon from '@/Components/Icons/CancelSearchIcon.vue';
import { DropdownInputInterface } from '@/Types/App/Interfaces/DropdownInputInterface';
import { DropdownInputOptionsInterface } from '@/Types/App/Interfaces/DropdownInputOptionsInterface';
import {
    computed,
    ComputedRef,
    nextTick,
    onMounted,
    Ref,
    ref,
    watch,
} from 'vue';

const {
    label,
    modelValue,
    placeholder,
    options,
}: {
    label: string;
    modelValue: null | number | string;
    placeholder: string;
    options: DropdownInputOptionsInterface[];
} = defineProps<DropdownInputInterface>();

type Emits = {
    (e: 'update:modelValue', value: string | number | null): void;
};

const emit = defineEmits<Emits>();

const open = ref<boolean>(false);
const searchText = ref<string>('');
const highlightedIndex = ref<number>(-1);
const suppressSearchWatch = ref<boolean>(false);
const inputRef: Ref<HTMLInputElement | null> = ref(null);
const hasText = computed<boolean>(() => searchText.value.trim().length > 0);

const clearSearch = (): void => {
    suppressSearchWatch.value = true;
    searchText.value = '';

    emit('update:modelValue', null);

    open.value = true;
    highlightedIndex.value = options.length > 0 ? 0 : -1;

    nextTick((): void => {
        suppressSearchWatch.value = false;
        inputRef.value?.focus();
    });
};

const findLabelByValue = (value: null | number | string): string => {
    if (value === null || value === '' || typeof value === 'undefined') {
        return '';
    }
    const found = options.find(
        (option: DropdownInputOptionsInterface) => option.value === value,
    );
    return found ? found.label : '';
};

const filteredOptions: ComputedRef<
    DropdownInputOptionsInterface<string | number>[]
> = computed<DropdownInputOptionsInterface[]>(
    (): DropdownInputOptionsInterface[] => {
        const term = searchText.value.trim().toLowerCase();

        if (term.length === 0) {
            return options;
        }

        return options.filter(
            (option: DropdownInputOptionsInterface<string | number>) =>
                option.label.toLowerCase().includes(term),
        );
    },
);

const selectOption = (option: DropdownInputOptionsInterface): void => {
    suppressSearchWatch.value = true;

    emit('update:modelValue', option.value);

    searchText.value = option.label;
    open.value = false;
    highlightedIndex.value = -1;

    nextTick((): void => {
        suppressSearchWatch.value = false;
    });
};

const highlightNext = (): void => {
    if (!open.value) {
        open.value = true;
    }
    if (filteredOptions.value.length === 0) {
        highlightedIndex.value = -1;

        return;
    }
    highlightedIndex.value =
        (highlightedIndex.value + 1) % filteredOptions.value.length;
};

const highlightPrev = (): void => {
    if (!open.value) {
        open.value = true;
    }
    if (filteredOptions.value.length === 0) {
        highlightedIndex.value = -1;

        return;
    }
    highlightedIndex.value =
        (highlightedIndex.value - 1 + filteredOptions.value.length) %
        filteredOptions.value.length;
};

const qualifiesForSelection: ComputedRef<boolean> = computed(
    (): boolean =>
        open.value &&
        highlightedIndex.value >= 0 &&
        highlightedIndex.value < filteredOptions.value.length,
);

const selectHighlighted = (): void => {
    if (qualifiesForSelection.value) {
        selectOption(filteredOptions.value[highlightedIndex.value]);
    } else {
        if (filteredOptions.value.length === 1) {
            selectOption(filteredOptions.value[0]);
        }
    }
};

const onBlur = (): void => {
    setTimeout((): void => {
        open.value = false;
        highlightedIndex.value = -1;
    }, 0);
};

watch(
    (): null | number | string => modelValue,
    (newValue: null | number | string): void => {
        suppressSearchWatch.value = true;
        searchText.value = findLabelByValue(newValue);
        nextTick((): void => {
            suppressSearchWatch.value = false;
        });
    },
);

watch(
    (): string => searchText.value,
    (): void => {
        if (suppressSearchWatch.value) {
            return;
        }

        open.value = true;
        highlightedIndex.value = filteredOptions.value.length > 0 ? 0 : -1;

        if (searchText.value.trim() === '') {
            emit('update:modelValue', null);
        }
    },
);

onMounted((): void => {
    suppressSearchWatch.value = true;
    searchText.value = findLabelByValue(modelValue);

    nextTick((): void => {
        suppressSearchWatch.value = false;
    });
});
</script>
