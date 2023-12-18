import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/bootstrap.min.css',
                'resources/css/animate.css',
                'resources/css/lightbox.min.css',
                'resources/css/odometer.css',
                'resources/css/owl.min.css',
                'resources/css/main.css',
                'resources/css/custom.css',
                'resources/css/toastr.min.css',
                'resources/js/jquery-3.6.0.min.js',
                'resources/js/bootstrap.min.js',
                'resources/js/viewport.jquery.js',
                'resources/js/odometer.min.js',
                'resources/js/lightbox.min.js',
                'resources/js/owl.min.js',
                'resources/js/toastr.min.js',
                'resources/js/notify.js',
                'resources/js/main.js',
                'resources/js/custom.js'
            ],
            refresh: true,
        }),
    ],
});
