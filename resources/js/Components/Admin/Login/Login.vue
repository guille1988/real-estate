<template>
    <div
        class="flex min-h-screen w-full flex-col items-center justify-center bg-black px-6 pb-64 lg:px-8"
    >
        <div class="text-white sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="flex justify-center">
                <RealEstateIcon :height="64" :width="64" />
            </div>
        </div>

        <div class="mt-10 text-white sm:mx-auto sm:w-full sm:max-w-sm">
            <form @submit.prevent="submit()" class="w-full space-y-6">
                <div class="flex flex-col">
                    <TextInput
                        id="email"
                        label="E-mail address"
                        v-model:modelValue="form.email"
                        type="email"
                        placeholder="Enter your e-mail"
                    />
                    <div
                        v-if="form.errors.email"
                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="flex flex-col">
                    <TextInput
                        id="password"
                        label="Password"
                        v-model:modelValue="form.password"
                        type="password"
                        placeholder="Enter your password"
                    />
                    <div
                        v-if="form.errors.password"
                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="shadow-xs flex w-full justify-center rounded-md bg-purple-700 px-3 py-2 text-sm font-semibold text-white hover:bg-purple-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                        :disabled="form.processing"
                        :class="{
                            'cursor-not-allowed opacity-50': form.processing,
                        }"
                    >
                        <span v-if="!form.processing">Sign in</span>
                        <span v-else>Signing in...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup lang="ts">
import RealEstateIcon from '@/Components/Icons/RealEstateIcon.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import LoginController from '@/Routes/actions/App/Http/Controllers/Admin/LoginController';
import { LoginFormInterface } from '@/Types/Admin/Interfaces/LoginFormInterface';
import { InertiaForm, useForm } from '@inertiajs/vue3';

const form: InertiaForm<LoginFormInterface> = useForm<LoginFormInterface>({
    email: '',
    password: '',
});

const submit = (): void => {
    form.post(LoginController.store.url(), {
        preserveScroll: true,
        onError: (): void => {
            setTimeout((): void => {
                form.clearErrors();
            }, 4000);
        },
    });
};
</script>
