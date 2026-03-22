import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import Components from 'unplugin-vue-components/vite';
import { PrimeVueResolver } from 'unplugin-vue-components/resolvers';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        Components({
            resolvers: [PrimeVueResolver()],
            dts: true,
        }),
        tailwindcss(),
    ],
    css: {
        postcss: './postcss.config.js',
    },
});