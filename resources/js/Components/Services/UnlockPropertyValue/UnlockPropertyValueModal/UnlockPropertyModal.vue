<template>
    <Modal v-model="isOpen">
        <div class="space-y-4 text-gray-300">
            <h2 class="mb-8 text-3xl font-bold text-purple-500">
                Unlock Property Value
            </h2>

            <UnlockPropertyModalItem
                v-for="modalItem in modalItems"
                :key="modalItem.id"
                :item="modalItem"
            />
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import { UnlockPropertyModalItemInterface } from '@/Types/App/Interfaces/UnlockPropertyModalItemInterface';
import { computed, ComputedRef, EmitFn, ref } from 'vue';
import UnlockPropertyModalItem from './UnlockPropertyModalItem.vue';

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

const modalItems = ref<UnlockPropertyModalItemInterface[]>([
    {
        id: 1,
        subtitle: "Maximizing Your Property's Potential",
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.',
        ],
    },
    {
        id: 2,
        subtitle: 'Our Approach',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
        ],
    },
    {
        id: 3,
        subtitle: 'Benefits',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
        ],
    },
    {
        id: 4,
        subtitle: 'Additional Information',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.',
            'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper.',
        ],
    },
    {
        id: 5,
        subtitle: 'Get Started Today',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
        ],
    },
    {
        id: 6,
        subtitle: 'Market Analysis',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam quis risus eget urna mollis ornare vel eu leo. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla.',
            'Vestibulum id ligula porta felis euismod semper. Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
        ],
    },
    {
        id: 7,
        subtitle: 'Property Enhancement Strategies',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
            'Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
        ],
    },
    {
        id: 8,
        subtitle: 'Client Testimonials',
        paragraphs: [
            '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit."',
            '"Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui."',
            '"Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh."',
        ],
    },
    {
        id: 9,
        subtitle: 'Frequently Asked Questions',
        paragraphs: [
            'How long does it typically take to sell a property?',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper.',
            'What makes your property valuation service different?',
            'Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod.',
            'Do you handle international properties?',
            'Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
        ],
    },
    {
        id: 10,
        subtitle: 'Contact Information',
        paragraphs: [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper.',
            'Email: info@realestate.com\nPhone: (123) 456-7890\nAddress: 123 Property Lane, Real Estate City, RE 12345',
        ],
    },
]);
</script>
