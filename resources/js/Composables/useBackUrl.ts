import { BackUrlInterface } from '@/Types/App/Interfaces/BackUrlInterface';
import { computed, ComputedRef } from 'vue';

export function useBackUrl(properties: BackUrlInterface): ComputedRef<string> {
    return computed((): string => {
        return properties.url && properties.fragment
            ? `${properties.url}${properties.fragment}`
            : properties.url || document.referrer || '/';
    });
}
