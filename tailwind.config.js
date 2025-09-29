import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Urbanist', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
    safelist: [
        {
            pattern:
                /(bg|text|ring)-(green|indigo|yellow|purple)-(100|200|300|400|500|600|700|800|900)(\/(10|20|30|40|50|60|70|80|90))?/,
        },
    ],
};
