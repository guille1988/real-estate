import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import { run } from 'vite-plugin-run';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        run([
            {
                name: 'wayfinder',
                run: [
                    'php',
                    'artisan',
                    'wayfinder:generate',
                    '--path=resources/js/Routes',
                ],
                pattern: ['routes/**/*.php', 'app/**/Http/**/*.php'],
            },
        ]),
    ],
});
