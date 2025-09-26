import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/applaravel.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            'jquery': 'jquery/dist/jquery.min.js',
            'turn.js': 'turn.js/turn.min.js',
            '@': '/resources/js',
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    }
});
