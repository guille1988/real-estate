<template>
    <MenuItems
        class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-gray-800 py-2 outline -outline-offset-1 outline-white/10"
    >
        <MenuItem
            v-for="item in userDropdown"
            :key="item.name"
            v-slot="{ active }"
        >
            <template v-if="isGetMethod(item.method)">
                <Link
                    :href="item.route"
                    :class="[
                        active ? 'outline-hidden bg-white/5' : '',
                        'block px-3 py-1 text-sm/6 text-white',
                    ]"
                    >{{ item.name }}
                </Link>
            </template>
            <template v-else>
                <button
                    type="button"
                    :class="[
                        active ? 'outline-hidden bg-white/5' : '',
                        'block w-full px-3 py-1 text-left text-sm/6 text-white',
                    ]"
                    @click="submit(item)"
                >
                    {{ item.name }}
                </button>
            </template>
        </MenuItem>
    </MenuItems>
</template>

<script setup lang="ts">
import LoginController from '@/Routes/actions/App/Http/Controllers/Admin/LoginController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { UserDropdownInterface } from '@/Types/Admin/Interfaces/UserDropdownInterface';
import { MenuItem, MenuItems } from '@headlessui/vue';
import { Link, router } from '@inertiajs/vue3';

const userDropdown: UserDropdownInterface[] = [
    {
        name: 'Your profile',
        route: '#',
    },
    {
        name: 'Sign out',
        route: LoginController.destroy().url,
        method: FormMethodEnum.DELETE,
    },
];

const isGetMethod = (method?: FormMethodEnum): boolean => {
    return (method ?? FormMethodEnum.GET) === FormMethodEnum.GET;
};

const routeHandlers: Record<FormMethodEnum, (route: string) => void> = {
    [FormMethodEnum.GET]: (route: string) => router.get(route),
    [FormMethodEnum.POST]: (route: string) => router.post(route),
    [FormMethodEnum.PUT]: (route: string) => router.put(route),
    [FormMethodEnum.PATCH]: (route: string) => router.patch(route),
    [FormMethodEnum.DELETE]: (route: string) => router.delete(route),
};

const submit = (item: UserDropdownInterface): void => {
    routeHandlers[item.method ?? FormMethodEnum.POST](item.route);
};
</script>
