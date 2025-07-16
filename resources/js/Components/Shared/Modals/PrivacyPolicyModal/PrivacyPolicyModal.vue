<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                Privacy Policy
            </h2>

            <PrivacyPolicyModalItem
                v-for="item in modalItems"
                :key="item.id"
                :item="item"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import PrivacyPolicyModalItem from '@/Components/Shared/Modals/PrivacyPolicyModal/PrivacyPolicyModalItem.vue';
import { PrivacyPolicyModalItemInterface } from '@/Types/App/Interfaces/PrivacyPolicyModalItemInterface';
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

const modalItems: PrivacyPolicyModalItemInterface[] = [
    {
        id: 1,
        subtitle: '1. Introduction',
        paragraphs: [
            'We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.',
        ],
    },
    {
        id: 2,
        subtitle: '2. The Data We Collect About You',
        paragraphs: [
            'Personal data, or personal information, means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:',
            'Identity Data includes first name, last name, username or similar identifier.',
            'Contact Data includes email address and telephone numbers.',
            'Technical Data includes internet protocol (IP) address, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.',
            'Usage Data includes information about how you use our website and services.',
        ],
    },
    {
        id: 3,
        subtitle: '3. How We Use Your Personal Data',
        paragraphs: [
            'We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:',
            'Where we need to perform the contract we are about to enter into or have entered into with you.',
            'Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.',
            'Where we need to comply with a legal obligation.',
        ],
    },
    {
        id: 4,
        subtitle: '4. Data Security',
        paragraphs: [
            'We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.',
        ],
    },
    {
        id: 5,
        subtitle: '5. Data Retention',
        paragraphs: [
            'We will only retain your personal data for as long as reasonably necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting or reporting requirements.',
        ],
    },
    {
        id: 6,
        subtitle: '6. Your Legal Rights',
        paragraphs: [
            'Under certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to:',
            'Request access to your personal data.',
            'Request correction of your personal data.',
            'Request erasure of your personal data.',
            'Object to processing of your personal data.',
            'Request restriction of processing your personal data.',
            'Request transfer of your personal data.',
            'Right to withdraw consent.',
        ],
    },
    {
        id: 7,
        subtitle: '7. Changes to the Privacy Policy',
        paragraphs: [
            'We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page.',
        ],
    },
    {
        id: 8,
        subtitle: '8. Contact Us',
        paragraphs: [
            'If you have any questions about this privacy policy or our privacy practices, please contact us.',
        ],
    },
];
</script>
