<template>
    <section class="w-full max-w-full bg-black py-16 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div
                class="flex flex-wrap items-center justify-between border-b border-gray-800 pb-4"
            >
                <div class="mb-2 flex flex-wrap items-center gap-2 sm:mb-0">
                    <h1 class="text-xl font-semibold">
                        Seaside Serenity Villa
                    </h1>
                    <div class="flex items-center text-sm text-gray-400">
                        <LocalizationIcon />
                        Malibu, California
                    </div>
                </div>
                <div class="text-xl font-semibold">$1,250,000</div>
            </div>

            <div class="mb-6 mt-6 w-full">
                <div class="-mx-4 overflow-x-auto">
                    <div class="flex min-w-max gap-2 px-4 pb-2 pt-3">
                        <div
                            v-for="i in 9"
                            :key="i"
                            class="h-14 w-20 flex-shrink-0 cursor-pointer overflow-hidden rounded-lg transition-all duration-200 sm:h-16 sm:w-24"
                            :class="{
                                'ring-2 ring-white ring-offset-2 ring-offset-black':
                                    currentImage === i,
                            }"
                            @click="currentImage = i"
                        >
                            <img
                                src="https://wallpapercat.com/w/full/6/8/e/743660-3840x2160-desktop-4k-house-wallpaper-photo.jpg"
                                :alt="`Property view ${i}`"
                                class="h-full w-full object-cover transition-opacity hover:opacity-75"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <div class="mx-auto overflow-hidden rounded-lg">
                    <img
                        src="https://wallpapercat.com/w/full/6/8/e/743660-3840x2160-desktop-4k-house-wallpaper-photo.jpg"
                        :alt="`Property view ${currentImage}`"
                        class="h-[300px] w-full object-cover sm:h-[400px] md:h-[500px]"
                    />
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 py-4">
                <button
                    class="rounded-full bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                    @click="prevImage"
                >
                    <PreviousSliderArrowIcon />
                </button>

                <div
                    class="flex max-w-[60vw] justify-center gap-1 overflow-x-auto py-1"
                >
                    <button
                        v-for="i in 9"
                        :key="i"
                        class="h-2 w-2 flex-shrink-0 rounded-full"
                        :class="{
                            'bg-white': currentImage === i,
                            'bg-gray-600': currentImage !== i,
                        }"
                        @click="currentImage = i"
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
import Amenities from '@/Components/PropertyDetails/Gallery/Amenities/Amenities.vue';
import Description from '@/Components/PropertyDetails/Gallery/Description/Description.vue';
import LocalizationIcon from '@/Components/PropertyDetails/Gallery/LocalizationIcon.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import {
    AmenitiesInterface,
    DescriptionInterface,
} from '@/Types/App/Interfaces';
import { type Ref, ref } from 'vue';

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

const currentImage: Ref<number> = ref<number>(1);
const totalImages: number = 9;

const nextImage = (): void => {
    currentImage.value =
        currentImage.value === totalImages ? 1 : currentImage.value + 1;
};

const prevImage = (): void => {
    currentImage.value =
        currentImage.value === 1 ? totalImages : currentImage.value - 1;
};
</script>
