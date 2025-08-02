<template>
    <section class="w-full max-w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div
                class="flex flex-wrap items-center justify-between border-b border-gray-800 pb-4"
            >
                <div class="mb-2 flex flex-wrap items-center gap-2 sm:mb-0">
                    <h1 class="text-xl font-semibold">
                        {{ property.title }}
                    </h1>
                    <div class="flex items-center text-sm text-gray-400">
                        <LocalizationIcon class="mr-1 h-4 w-4" />
                        {{ property.address }}
                    </div>
                </div>
                <div class="text-xl font-semibold">{{ property.price }}</div>
            </div>

            <div class="mb-6 mt-6 w-full">
                <div class="-mx-4 overflow-x-auto" ref="thumbnailContainer">
                    <div class="flex min-w-max gap-2 px-4 pb-2 pt-3">
                        <div
                            v-for="image in property.images"
                            :key="image.uuid"
                            :ref="(el) => setThumbnailRef(el, image.uuid)"
                            class="h-14 w-20 flex-shrink-0 cursor-pointer overflow-hidden rounded-lg transition-all duration-200 sm:h-16 sm:w-24"
                            :class="{
                                'ring-2 ring-white ring-offset-2 ring-offset-black':
                                    currentImage === image.uuid,
                            }"
                            @click="currentImage = image.uuid"
                        >
                            <img
                                :src="image.url"
                                alt="Property Photo"
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
                        alt="Property Photo"
                        class="h-[300px] w-full object-cover sm:h-[400px] md:h-[500px]"
                    />
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 py-4">
                <button
                    class="rounded-full bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                    @click="previousImage"
                >
                    <ChevronIcon :direction="ChevronDirectionEnum.LEFT" />
                </button>

                <div
                    class="flex max-w-[60vw] justify-center gap-1 overflow-x-auto py-1"
                >
                    <button
                        v-for="image in property.images"
                        :key="image.uuid"
                        class="h-2 w-2 flex-shrink-0 rounded-full"
                        :class="{
                            'bg-white': currentImage === image.uuid,
                            'bg-gray-600': currentImage !== image.uuid,
                        }"
                        @click="currentImage = image.uuid"
                    ></button>
                </div>
                <button
                    class="rounded-full bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                    @click="nextImage"
                >
                    <ChevronIcon :direction="ChevronDirectionEnum.RIGHT" />
                </button>
            </div>

            <div
                class="grid grid-cols-1 gap-8 border-t border-gray-800 py-8 md:grid-cols-2"
            >
                <div>
                    <h2 class="mb-4 text-xl font-semibold">Description</h2>
                    <p class="mb-6 text-gray-400">
                        {{ property.description }}
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
                        <Amenity
                            v-for="amenity in property.amenities"
                            :key="amenity.uuid"
                            :card="amenity"
                        />
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import LocalizationIcon from '@/Components/Icons/LocalizationIcon.vue';
import Amenity from '@/Components/PropertyDetails/Gallery/Amenity.vue';
import Description from '@/Components/PropertyDetails/Gallery/Description.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { DescriptionInterface } from '@/Types/App/Interfaces/DescriptionInterface';
import { ImageInterface } from '@/Types/App/Interfaces/ImageInterface';
import { PropertyInterface } from '@/Types/App/Interfaces/PropertyInterface';
import {
    ComponentPublicInstance,
    computed,
    ComputedRef,
    onMounted,
    type Ref,
    ref,
    watch,
} from 'vue';

const { property }: { property: PropertyInterface } = defineProps<{
    property: PropertyInterface;
}>();

const descriptionCards: DescriptionInterface[] = [
    {
        id: 1,
        icon: 'BathroomIcon',
        title: 'Bathrooms',
        description: property.bathrooms,
    },
    {
        id: 2,
        icon: 'BedroomIcon',
        title: 'Bedrooms',
        description: property.bedrooms,
    },
    {
        id: 3,
        icon: 'HouseIcon',
        title: 'Area',
        description: property.area,
    },
];

const thumbnailContainer: Ref<HTMLElement | null> = ref<HTMLElement | null>(
    null,
);
const thumbnailRefs: Record<string, HTMLElement> = {};

const setThumbnailRef = (
    el: Element | ComponentPublicInstance | null,
    uuid: string,
): void => {
    if (el instanceof Element) {
        thumbnailRefs[uuid] = el as HTMLElement;
    }
};

const currentImage: Ref<string> = ref<string>(
    property.images.length > 0 ? property.images[0].uuid : '',
);

const getCurrentImage: ComputedRef<ImageInterface> = computed<ImageInterface>(
    () => {
        return (
            property.images.find(
                (image: ImageInterface) => image.uuid === currentImage.value,
            ) || property.images[0]
        );
    },
);

const scrollToSelectedThumbnail = (): void => {
    if (!thumbnailContainer.value) return;

    const selectedThumbnail = thumbnailRefs[currentImage.value];

    if (!selectedThumbnail) return;

    const containerRect = (
        thumbnailContainer.value as HTMLElement
    ).getBoundingClientRect();

    const thumbnailRect = selectedThumbnail.getBoundingClientRect();

    if (isNotVisible(thumbnailRect, containerRect)) {
        const scrollLeft =
            selectedThumbnail.offsetLeft -
            containerRect.width / 2 +
            thumbnailRect.width / 2;

        (thumbnailContainer.value as HTMLElement).scrollTo({
            left: scrollLeft,
            behavior: 'smooth',
        });
    }
};

const isNotVisible = (
    thumbnailRect: DOMRect,
    containerRect: DOMRect,
): boolean => {
    return (
        thumbnailRect.left < containerRect.left ||
        thumbnailRect.right < containerRect.right
    );
};

const nextImage = (): void => {
    const currentIndex: number = property.images.findIndex(
        (image: ImageInterface) => image.uuid === currentImage.value,
    );
    const nextIndex: number = (currentIndex + 1) % property.images.length;
    currentImage.value = property.images[nextIndex].uuid;
};

const previousImage = (): void => {
    const currentIndex: number = property.images.findIndex(
        (image: ImageInterface) => image.uuid === currentImage.value,
    );
    const prevIndex: number =
        (currentIndex - 1 + property.images.length) % property.images.length;
    currentImage.value = property.images[prevIndex].uuid;
};

watch(currentImage, (): void => {
    scrollToSelectedThumbnail();
});

onMounted((): void => {
    scrollToSelectedThumbnail();
});
</script>
