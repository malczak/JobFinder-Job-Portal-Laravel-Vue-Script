import {defineConfig} from 'vite';
import fs from 'fs';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0",
        hmr: {
            host: "finejobs.test"
        },
        https: {
            key: fs.readFileSync(`/var/www/ssl/ssl_cert.key`),
            cert: fs.readFileSync(`/var/www/ssl/ssl_cert.crt`),
        },
        port: 8888
    }
});
