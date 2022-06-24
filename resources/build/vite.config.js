import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import config from './config';
import dynamicImportVars from '@rollup/plugin-dynamic-import-vars';
import reactRefresh from '@vitejs/plugin-react-refresh';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        reactRefresh(),
        liveReload(config.refresh.map(path => '../' + path)),
    ],
    root: './resources',
    base: '/assets/',
    build: {
        polyfillDynamicImport: true,
        outDir: '../' + config.output,
        assetsDir: '',
        manifest: true,
        rollupOptions: {
            plugins: [dynamicImportVars()],
            output: {
                manualChunks: undefined, // Désactive la séparation du vendor
            },
            input: config.entry,
        },
    },
});
