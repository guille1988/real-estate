<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                Terms of Use
            </h2>

            <TermsOfUseModalItem
                v-for="item in modalItems"
                :key="item.id"
                :item="item"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import TermsOfUseModalItem from '@/Components/Shared/Modals/TermsOfUseModal/TermsOfUseModalItem.vue';
import { TermsOfUseModalItemInterface } from '@/Types/App/Interfaces/TermsOfUseModalItemInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';
import { computed, ComputedRef, EmitFn } from 'vue';

const { modelValue }: { modelValue: boolean } = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
});

const emit: EmitFn<'update:modelValue'[]> =
    defineEmits<EmitInputFunctionType>();

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => modelValue,
    set: (value: boolean): void => emit('update:modelValue', value),
});

const modalItems: TermsOfUseModalItemInterface[] = [
    {
        id: 1,
        subtitle: '1. Acceptance of Terms',
        paragraphs: [
            'By accessing and using this website, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to abide by the above, please do not use this service.',
        ],
    },
    {
        id: 2,
        subtitle: '2. Use License',
        paragraphs: [
            'Permission is granted to temporarily download one copy of the materials on this website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:',
            'Modify or copy the materials',
            'Use the materials for any commercial purpose',
            'Attempt to decompile or reverse engineer any software contained on the website',
            'Remove any copyright or other proprietary notations from the materials',
            'Transfer the materials to another person or "mirror" the materials on any other server',
        ],
    },
    {
        id: 3,
        subtitle: '3. Disclaimer',
        paragraphs: [
            "The materials on this website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.",
        ],
    },
    {
        id: 4,
        subtitle: '4. Limitations',
        paragraphs: [
            'In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on this website, even if we or an authorized representative has been notified orally or in writing of the possibility of such damage.',
        ],
    },
    {
        id: 5,
        subtitle: '5. Revisions and Errata',
        paragraphs: [
            'The materials appearing on this website could include technical, typographical, or photographic errors. We do not warrant that any of the materials on this website are accurate, complete or current. We may make changes to the materials contained on this website at any time without notice.',
        ],
    },
    {
        id: 6,
        subtitle: '6. Links',
        paragraphs: [
            "We have not reviewed all of the sites linked to this website and are not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by us of the site. Use of any such linked website is at the user's own risk.",
        ],
    },
    {
        id: 7,
        subtitle: '7. Modifications to Terms of Use',
        paragraphs: [
            'We may revise these terms of use for this website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.',
        ],
    },
    {
        id: 8,
        subtitle: '8. Governing Law',
        paragraphs: [
            'These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.',
        ],
    },
];
</script>
