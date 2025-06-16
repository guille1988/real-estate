<template>
    <section class="w-full max-w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div
                class="flex flex-wrap items-center justify-between border-b border-gray-800 pb-4"
            >
                <div class="mb-2 flex flex-wrap items-center gap-2 sm:mb-0">
                    <h1 class="text-xl font-semibold">
                        Seaside Serenity Villa
                    </h1>
                    <div class="flex items-center text-sm text-gray-400">
                        <LocalizationIcon class="mr-1 h-4 w-4" />
                        Malibu, California
                    </div>
                </div>
                <div class="text-xl font-semibold">$1,250,000</div>
            </div>

            <div class="mb-6 mt-6 w-full">
                <div class="-mx-4 overflow-x-auto">
                    <div class="flex min-w-max gap-2 px-4 pb-2 pt-3">
                        <div
                            v-for="image in images"
                            :key="image.id"
                            class="h-14 w-20 flex-shrink-0 cursor-pointer overflow-hidden rounded-lg transition-all duration-200 sm:h-16 sm:w-24"
                            :class="{
                                'ring-2 ring-white ring-offset-2 ring-offset-black':
                                    currentImage === image.id,
                            }"
                            @click="currentImage = image.id"
                        >
                            <img
                                :src="image.url"
                                :alt="image.alt"
                                class="h-full w-full object-cover transition-opacity hover:opacity-75"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <div class="mx-auto overflow-hidden rounded-lg">
                    <img
                        :src="getCurrentImage.url"
                        :alt="getCurrentImage.alt"
                        class="h-[300px] w-full object-cover sm:h-[400px] md:h-[500px]"
                    />
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 py-4">
                <button
                    class="rounded-full bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                    @click="previousImage"
                >
                    <PreviousSliderArrowIcon />
                </button>

                <div
                    class="flex max-w-[60vw] justify-center gap-1 overflow-x-auto py-1"
                >
                    <button
                        v-for="image in images"
                        :key="image.id"
                        class="h-2 w-2 flex-shrink-0 rounded-full"
                        :class="{
                            'bg-white': currentImage === image.id,
                            'bg-gray-600': currentImage !== image.id,
                        }"
                        @click="currentImage = image.id"
                    ></button>
                </div>
                <button
                    class="rounded-full bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                    @click="nextImage"
                >
                    <NextSliderArrowIcon />
                </button>
            </div>

            <div
                class="grid grid-cols-1 gap-8 border-t border-gray-800 py-8 md:grid-cols-2"
            >
                <div>
                    <h2 class="mb-4 text-xl font-semibold">Description</h2>
                    <p class="mb-6 text-gray-400">
                        Perched on a stunning piece of paradise with the Seaside
                        Serenity Villa, 7 MIN lift open concept living area with
                        views down from every room and direct access to a
                        pristine sandy beach, this property is the epitome of
                        coastal living.
                    </p>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <Description
                            v-for="descriptionCard in descriptionCards"
                            :key="descriptionCard.id"
                            :card="descriptionCard"
                        />
                    </div>
                </div>

                <div>
                    <h2 class="mb-8 text-2xl font-medium">
                        Key Features and Amenities
                    </h2>
                    <ul class="space-y-6">
                        <Amenities
                            v-for="amenitiesCard in amenitiesCards"
                            :key="amenitiesCard.id"
                            :card="amenitiesCard"
                        />
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import LocalizationIcon from '@/Components/Icons/LocalizationIcon.vue';
import NextSliderArrowIcon from '@/Components/Icons/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Icons/PreviousSliderArrowIcon.vue';
import Amenities from '@/Components/PropertyDetails/Gallery/Amenities.vue';
import Description from '@/Components/PropertyDetails/Gallery/Description.vue';
import { AmenitiesInterface } from '@/Types/App/Interfaces/AmenitiesInterface';
import { DescriptionInterface } from '@/Types/App/Interfaces/DescriptionInterface';
import { GalleryImageInterface } from '@/Types/App/Interfaces/GalleryImageInterface';
import { computed, ComputedRef, type Ref, ref } from 'vue';

const descriptionCards: DescriptionInterface[] = [
    {
        id: 1,
        icon: 'BedroomIcon',
        title: 'Bedrooms',
        description: '04',
    },
    {
        id: 2,
        icon: 'BathroomIcon',
        title: 'Bathrooms',
        description: '03',
    },
    {
        id: 3,
        icon: 'HouseIcon',
        title: 'Area',
        description: '2.500 Square Feet',
    },
];

const amenitiesCards: AmenitiesInterface[] = [
    {
        id: 1,
        description: 'Expansive oceanfront terrace for outdoor entertaining',
    },
    {
        id: 2,
        description: 'Gourmet kitchen with top-of-the-line appliances',
    },
    {
        id: 3,
        description:
            'Private beach access for morning strolls and sunset views',
    },
    {
        id: 4,
        description:
            'Master suite with a spa-inspired bathroom and ocean-facing balcony',
    },
    {
        id: 5,
        description: 'Private garage and ample storage space',
    },
];

const images: GalleryImageInterface[] = [
    {
        id: 1,
        url: 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=1200&q=80',
        alt: 'Modern luxury house with swimming pool',
    },
    {
        id: 2,
        url: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
        alt: 'Contemporary home with large windows',
    },
    {
        id: 3,
        url: 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80',
        alt: 'Elegant kitchen with island',
    },
    {
        id: 4,
        url: 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=80',
        alt: 'Spacious living room with fireplace',
    },
    {
        id: 5,
        url: 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1200&q=80',
        alt: 'Master bedroom with ocean view',
    },
    {
        id: 6,
        url: 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=1200&q=80',
        alt: 'Outdoor patio with dining area',
    },
    {
        id: 7,
        url: 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
        alt: 'Home office with natural light',
    },
    {
        id: 8,
        url: 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80',
        alt: 'Aerial view of property and surroundings',
    },
];

const currentImage: Ref<number> = ref<number>(1);

const getCurrentImage: ComputedRef<GalleryImageInterface> =
    computed<GalleryImageInterface>(() => {
        return (
            images.find(
                (image: GalleryImageInterface) =>
                    image.id === currentImage.value,
            ) || images[0]
        );
    });

const nextImage = (): void => {
    const currentIndex: number = images.findIndex(
        (image: GalleryImageInterface) => image.id === currentImage.value,
    );
    const nextIndex: number = (currentIndex + 1) % images.length;
    currentImage.value = images[nextIndex].id;
};

const previousImage = (): void => {
    const currentIndex: number = images.findIndex(
        (image: GalleryImageInterface) => image.id === currentImage.value,
    );
    const prevIndex: number =
        (currentIndex - 1 + images.length) % images.length;
    currentImage.value = images[prevIndex].id;
};
</script>
