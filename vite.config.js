import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vueDevTools from 'vite-plugin-vue-devtools';
export default defineConfig({
    resolve:{
        alias: [
            {
                find: '@Components',
                replacement: '/resources/js/Components',
            },
            {
                find: '@lib',
                replacement: '/resources/js/lb',
            }
        ]
    },
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
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
        vueDevTools({
            appendTo: 'resources/js/app.ts',
        }),
    ],
});
