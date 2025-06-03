<template>
    <div>
        <label class="flex items-center">
            <input
                :id="id"
                type="checkbox"
                :checked="model_value"
                @input="
                    $emit(
                        'update:model_value',
                        ($event.target as HTMLInputElement).checked,
                    )
                "
                class="mr-2 h-4 w-4 accent-purple-600"
            />
            <span class="text-sm" :class="text_class">{{ label }}</span>
        </label>
    </div>
</template>

<script setup lang="ts">
import { MakeItHappenCheckboxInputInterface } from '@/Types/App/Interfaces';

defineProps<MakeItHappenCheckboxInputInterface>();

defineEmits(['update:model_value']);
</script>
