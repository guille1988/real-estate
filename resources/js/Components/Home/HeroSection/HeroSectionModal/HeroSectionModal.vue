<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                Discover Your Dream Property
            </h2>

            <HeroSectionModalItem
                v-for="item in modalItems"
                :key="item.id"
                :item="item"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import HeroSectionModalItem from '@/Components/Home/HeroSection/HeroSectionModal/HeroSectionModalItem.vue';
import Modal from '@/Components/Shared/Modals/Modal.vue';
import { HeroSectionModalItemInterface } from '@/Types/App/Interfaces/HeroSectionModalItemInterface';
import { computed, ComputedRef, EmitFn } from 'vue';

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

const modalItems: HeroSectionModalItemInterface[] = [
    {
        id: 1,
        subtitle: 'Find Your Perfect Home',
        paragraphs: [
            "At Real Estate, we understand that finding the perfect home is more than just a transaction—it's about finding a place where you can build your future. Our dedicated team of real estate professionals is committed to helping you navigate the complex world of property buying with ease and confidence.",
            "We offer a personalized approach to home buying, taking the time to understand your unique needs, preferences, and budget. Whether you're a first-time buyer or looking to upgrade to your dream home, we're here to guide you every step of the way.",
        ],
    },
    {
        id: 2,
        subtitle: 'Expert Guidance Throughout Your Journey',
        paragraphs: [
            'Our team of experienced real estate agents brings deep local market knowledge and industry expertise to help you make informed decisions. From initial property search to final closing, we provide comprehensive support and guidance.',
            "We leverage cutting-edge technology and market analytics to ensure you have access to the latest listings and market trends, giving you a competitive edge in today's fast-paced real estate market.",
        ],
    },
    {
        id: 3,
        subtitle: 'Tailored Property Solutions',
        paragraphs: [
            "Every client has unique needs, which is why we offer tailored property solutions designed to meet your specific requirements. Whether you're looking for a family home, an investment property, or a luxury estate, we have the expertise to help you find exactly what you're looking for.",
            "Our extensive network of industry connections allows us to provide access to exclusive listings and off-market opportunities that you won't find anywhere else.",
        ],
    },
    {
        id: 4,
        subtitle: 'Seamless Buying Experience',
        paragraphs: [
            'We strive to make the property buying process as smooth and stress-free as possible. Our streamlined approach eliminates unnecessary complications and ensures a transparent, efficient experience from start to finish.',
            "Our team handles all the details, from coordinating property viewings and inspections to negotiating the best possible terms on your behalf. We're committed to protecting your interests and ensuring you get the best value for your investment.",
        ],
    },
    {
        id: 5,
        subtitle: 'Beyond the Purchase',
        paragraphs: [
            "Our relationship doesn't end when you get the keys to your new property. We offer ongoing support and resources to help you settle into your new home and community.",
            "From recommending trusted contractors for renovations to providing information about local amenities and services, we're here to ensure your transition is seamless and your experience with your new property is exceptional.",
        ],
    },
    {
        id: 6,
        subtitle: 'Start Your Journey Today',
        paragraphs: [
            'Ready to find your dream property? Contact our team today to schedule a consultation and discover how we can help you navigate the exciting journey of property ownership.',
            "With Real Estate as your partner, you're not just buying a property—you're investing in a future filled with possibilities and the peace of mind that comes from knowing you've made the right choice.",
        ],
    },
];
</script>
