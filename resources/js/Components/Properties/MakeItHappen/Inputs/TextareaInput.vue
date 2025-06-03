<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <textarea
            :id="id"
            :value="model_value"
            @input="
                $emit(
                    'update:model_value',
                    ($event.target as HTMLTextAreaElement).value,
                )
            "
            :rows="rows"
            :placeholder="placeholder"
            class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
        ></textarea>
    </div>
</template>

<script setup lang="ts">
import { MakeItHappenTextareaInputInterface } from '@/Types/App/Interfaces';

defineProps<MakeItHappenTextareaInputInterface>();

defineEmits(['update:model_value']);
</script>
