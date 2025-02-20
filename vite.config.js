import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
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
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true,
                logger: {
                    warn: (message, options) => {
                        if (!options?.deprecation) return
                        console.warn(message)
                    }
                }
            }
        }
    },
    server: {
        host: '127.0.0.1', // o 'localhost'
        port: 5174,
        cors: true, // Habilita CORS
    }
});
