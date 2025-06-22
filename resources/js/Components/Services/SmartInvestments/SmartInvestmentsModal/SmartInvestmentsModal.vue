<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                Smart Investments, Informed Decisions
            </h2>

            <SmartInvestmentsModalItem
                v-for="item in modalItems"
                :key="item.id"
                :item="item"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import { SmartInvestmentsModalItemInterface } from '@/Types/App/Interfaces/SmartInvestmentsModalItemInterface';
import { computed, ComputedRef, EmitFn } from 'vue';
import SmartInvestmentsModalItem from './SmartInvestmentsModalItem.vue';

const { modelValue }: { modelValue: boolean } = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
});

const emit: EmitFn<'update:modelValue'[]> = defineEmits(['update:modelValue']);

const isOpen: ComputedRef<boolean> = computed({
    get: (): boolean => modelValue,
    set: (value: boolean): void => emit('update:modelValue', value),
});

const modalItems: SmartInvestmentsModalItemInterface[] = [
    {
        id: 1,
        subtitle: 'Market Insight',
        paragraphs: [
            'Stay ahead of market trends with our expert Market Analysis. We provide in-depth insights into real estate market conditions, helping you identify opportunities and avoid potential pitfalls. Our team of analysts continuously monitors market indicators, providing you with timely and actionable information.',
            "With our Market Insight service, you'll have access to comprehensive reports on property values, rental yields, and market forecasts. This knowledge empowers you to make strategic investment decisions based on solid data rather than speculation.",
        ],
    },
    {
        id: 2,
        subtitle: 'ROI Assessment',
        paragraphs: [
            'Make investment decisions with confidence. Our ROI Assessment services evaluate the potential returns on your investments, taking into account all relevant factors such as purchase costs, renovation expenses, ongoing maintenance, and projected rental income or resale value.',
            "We provide detailed financial projections that help you understand the true value of your investment over time. Our comprehensive approach considers both immediate returns and long-term appreciation, giving you a complete picture of your investment's performance.",
        ],
    },
    {
        id: 3,
        subtitle: 'Customized Strategies',
        paragraphs: [
            "Every investor is unique and so are their goals. We develop Customized Investment Strategies tailored to your specific needs, risk tolerance, and financial objectives. Whether you're looking for steady income, capital appreciation, or a balanced approach, we create a roadmap that aligns with your vision.",
            'Our personalized strategies take into account your timeline, budget constraints, and preferred property types. We work closely with you to understand your investment philosophy and design a plan that maximizes your chances of success.',
        ],
    },
    {
        id: 4,
        subtitle: 'Diversification Mastery',
        paragraphs: [
            'Diversify your real estate portfolio effectively. Our experts guide you in spreading your investments across various property types and locations to minimize risk and optimize returns. We help you achieve the right balance between residential, commercial, and specialized properties.',
            'Geographic diversification is also key to a resilient portfolio. We identify promising markets across different regions, allowing you to benefit from various economic cycles and reduce your exposure to localized downturns.',
        ],
    },
    {
        id: 5,
        subtitle: 'Investment Advisory',
        paragraphs: [
            'Our Investment Advisory service provides ongoing support and guidance throughout your investment journey. We offer regular portfolio reviews, market updates, and strategic recommendations to help you adapt to changing conditions and capitalize on emerging opportunities.',
            "With our advisory service, you'll have a dedicated consultant who understands your investment goals and provides personalized advice. This continuous support ensures that your real estate investments remain aligned with your evolving financial objectives.",
        ],
    },
    {
        id: 6,
        subtitle: 'Due Diligence Support',
        paragraphs: [
            'Thorough due diligence is essential for successful real estate investments. Our team conducts comprehensive property assessments, including physical inspections, title searches, and financial analysis to identify any potential issues before you commit.',
            'We also evaluate the legal and regulatory aspects of each investment opportunity, ensuring compliance with all relevant laws and regulations. This meticulous approach helps you avoid costly surprises and make informed decisions with complete confidence.',
        ],
    },
];
</script>
