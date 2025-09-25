export type EmitFilterType = {
    (e: 'update:modelValue', value: boolean): void;
    (e: 'open'): void;
    (e: 'close'): void;
    (e: 'toggle', value: boolean): void;
    (e: 'apply'): void;
    (e: 'clear'): void;
};
