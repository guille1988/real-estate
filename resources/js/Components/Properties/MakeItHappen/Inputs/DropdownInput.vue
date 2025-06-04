<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <select
                :id="id"
                :value="model_value"
                @input="
                    $emit(
                        'update:model_value',
                        ($event.target as HTMLSelectElement).value,
                    )
                "
                class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
            >
                <option value="" disabled selected>{{ placeholder }}</option>
                <option
                    v-for="(option, index) in options"
                    :key="`${id}-option-${index}`"
                    :value="
                        typeof option === 'object' &&
                        option !== null &&
                        'value' in option
                            ? option.value
                            : option
                    "
                >
                    {{
                        typeof option === 'object' &&
                        option !== null &&
                        'label' in option
                            ? option.label
                            : option
                    }}
                </option>
            </select>
        </div>
    </div>
</template>

<script setup lang="ts">
import { MakeItHappenDropdownInputInterface } from '@/Types/App/Interfaces';

defineProps<MakeItHappenDropdownInputInterface>();
defineEmits(['update:model_value']);
</script>
