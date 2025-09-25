export type EmitSearchBarType = {
    (event: 'update:modelValue', value: string | boolean): void;
    (event: 'submit'): void;
    (event: 'clear'): void;
};
