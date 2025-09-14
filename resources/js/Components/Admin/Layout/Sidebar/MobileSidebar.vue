<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-50 lg:hidden" @close="emitClose()">
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to=""
                leave="transition-opacity ease-linear duration-300"
                leave-from=""
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-900/80" />
            </TransitionChild>

            <div class="fixed inset-0 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative mr-16 flex w-full max-w-xs flex-1"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to=""
                            leave="ease-in-out duration-300"
                            leave-from=""
                            leave-to="opacity-0"
                        >
                            <div
                                class="absolute left-full top-0 flex w-16 justify-center pt-5"
                            >
                                <button
                                    type="button"
                                    class="-m-2.5 p-2.5"
                                    @click="emitClose()"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon
                                        class="size-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>

                        <div
                            class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-purple-800 px-6 pb-4 ring-1 ring-white/10"
                        >
                            <RealStateSidebarTitle />
                            <SidebarNav :items="items" />
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import RealStateSidebarTitle from '@/Components/Admin/Layout/Sidebar/RealStateSidebarTitle.vue';
import SidebarNav from '@/Components/Admin/Layout/Sidebar/SidebarNav.vue';
import type { SidebarNavigationInterface } from '@/Types/Admin/Interfaces/SidebarNavigationInterface';
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { XMarkIcon } from '@heroicons/vue/24/outline';

defineProps<{
    open: boolean;
    items: SidebarNavigationInterface[];
}>();

const emit = defineEmits<{ (e: 'update:open', value: boolean): void }>();

function emitClose(): void {
    emit('update:open', false);
}
</script>
