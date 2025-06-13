import { type Component, defineAsyncComponent } from 'vue';

export function useIcon(icon: string): Component {
    return defineAsyncComponent(
        (): Promise<Component> =>
            import(`./../Components/Icons/${icon}.vue`) as Promise<Component>,
    );
}
