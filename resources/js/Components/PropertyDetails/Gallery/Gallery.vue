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
                        <div class="rounded-lg bg-gray-900/50 p-4 text-center">
                            <div class="mb-2 flex items-center justify-center">
                                <BedroomIcon />
                            </div>
                            <div class="text-sm text-gray-400">Bedrooms</div>
                            <div class="font-semibold">04</div>
                        </div>
                        <div class="rounded-lg bg-gray-900/50 p-4 text-center">
                            <div class="mb-2 flex items-center justify-center">
                                <BathroomIcon />
                            </div>
                            <div class="text-sm text-gray-400">Bathrooms</div>
                            <div class="font-semibold">03</div>
                        </div>
                        <div class="rounded-lg bg-gray-900/50 p-4 text-center">
                            <div class="mb-2 flex items-center justify-center">
                                <HouseIcon />
                            </div>
                            <div class="text-sm text-gray-400">Area</div>
                            <div class="font-semibold">2,500 Square Feet</div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="mb-8 text-2xl font-medium">
                        Key Features and Amenities
                    </h2>
                    <ul class="space-y-6">
                        <li class="relative bg-gray-900/40 py-3 pl-12">
                            <div
                                class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"
                            ></div>
                            <div class="flex items-center gap-4">
                                <ThunderIcon />
                                <span class="text-lg text-gray-400"
                                    >Expansive oceanfront terrace for outdoor
                                    entertaining</span
                                >
                            </div>
                        </li>
                        <li class="relative bg-gray-900/40 py-3 pl-12">
                            <div
                                class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"
                            ></div>
                            <div class="flex items-center gap-4">
                                <ThunderIcon />
                                <span class="text-lg text-gray-400"
                                    >Gourmet kitchen with top-of-the-line
                                    appliances</span
                                >
                            </div>
                        </li>
                        <li class="relative bg-gray-900/40 py-3 pl-12">
                            <div
                                class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"
                            ></div>
                            <div class="flex items-center gap-4">
                                <ThunderIcon />
                                <span class="text-lg text-gray-400"
                                    >Private beach access for morning strolls
                                    and sunset views</span
                                >
                            </div>
                        </li>
                        <li class="relative bg-gray-900/40 py-3 pl-12">
                            <div
                                class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"
                            ></div>
                            <div class="flex items-center gap-4">
                                <ThunderIcon />
                                <span class="text-lg text-gray-400"
                                    >Master suite with a spa-inspired bathroom
                                    and ocean-facing balcony</span
                                >
                            </div>
                        </li>
                        <li class="relative bg-gray-900/40 py-3 pl-12">
                            <div
                                class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"
                            ></div>
                            <div class="flex items-center gap-4">
                                <ThunderIcon />
                                <span class="text-lg text-gray-400"
                                    >Private garage and ample storage
                                    space</span
                                >
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import BathroomIcon from '@/Components/PropertyDetails/Gallery/Icons/BathroomIcon.vue';
import BedroomIcon from '@/Components/PropertyDetails/Gallery/Icons/BedroomIcon.vue';
import HouseIcon from '@/Components/PropertyDetails/Gallery/Icons/HouseIcon.vue';
import LocalizationIcon from '@/Components/PropertyDetails/Gallery/Icons/LocalizationIcon.vue';
import ThunderIcon from '@/Components/PropertyDetails/Gallery/Icons/ThunderIcon.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import { type Ref, ref } from 'vue';

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
