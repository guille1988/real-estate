import { defineAsyncComponent, defineComponent, h } from 'vue';

export function useIcon(icon: string) {
    const AsyncIcon = defineAsyncComponent(
        () => import(`./../Components/Icons/${icon}.vue`),
    );

    return defineComponent({
        name: `${icon}`,
        inheritAttrs: false,

        setup(_, { attrs }) {
            return () => h(AsyncIcon, attrs);
        },
    });
}
