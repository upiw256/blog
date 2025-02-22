import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        https: true,
        // atau jika Anda ingin menggunakan sertifikat custom
        // https: {
        //   key: fs.readFileSync('/path/to/your/server.key'),
        //   cert: fs.readFileSync('/path/to/your/server.crt'),
        // },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
