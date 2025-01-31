import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/public/theme.css', 'resources/css/filament/customer/theme.css'],
            refresh: true,
        }),
    ],
});
