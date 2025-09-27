// vite.config.js
import { defineConfig } from "file:///C:/Users/toniq/OneDrive/Documentos/Trabajo%20Vane/GEP/guga-landing-page/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/Users/toniq/OneDrive/Documentos/Trabajo%20Vane/GEP/guga-landing-page/node_modules/laravel-vite-plugin/dist/index.js";
import vue from "file:///C:/Users/toniq/OneDrive/Documentos/Trabajo%20Vane/GEP/guga-landing-page/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import tailwindcss from "file:///C:/Users/toniq/OneDrive/Documentos/Trabajo%20Vane/GEP/guga-landing-page/node_modules/@tailwindcss/vite/dist/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js"
      ],
      refresh: true
    }),
    vue()
  ],
  resolve: {
    alias: {
      "jquery": "jquery/dist/jquery.min.js",
      "turn.js": "turn.js/turn.min.js",
      "@": "/resources/js",
      "vue": "vue/dist/vue.esm-bundler.js"
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFx0b25pcVxcXFxPbmVEcml2ZVxcXFxEb2N1bWVudG9zXFxcXFRyYWJham8gVmFuZVxcXFxHRVBcXFxcZ3VnYS1sYW5kaW5nLXBhZ2VcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkM6XFxcXFVzZXJzXFxcXHRvbmlxXFxcXE9uZURyaXZlXFxcXERvY3VtZW50b3NcXFxcVHJhYmFqbyBWYW5lXFxcXEdFUFxcXFxndWdhLWxhbmRpbmctcGFnZVxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vQzovVXNlcnMvdG9uaXEvT25lRHJpdmUvRG9jdW1lbnRvcy9UcmFiYWpvJTIwVmFuZS9HRVAvZ3VnYS1sYW5kaW5nLXBhZ2Uvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHZ1ZSBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUnO1xuaW1wb3J0IHRhaWx3aW5kY3NzIGZyb20gJ0B0YWlsd2luZGNzcy92aXRlJztcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFtcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2pzL2FwcC5qcycsXG5cbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgdnVlKCksXG4gICAgXSxcbiAgICByZXNvbHZlOiB7XG4gICAgICAgIGFsaWFzOiB7XG4gICAgICAgICAgICAnanF1ZXJ5JzogJ2pxdWVyeS9kaXN0L2pxdWVyeS5taW4uanMnLFxuICAgICAgICAgICAgJ3R1cm4uanMnOiAndHVybi5qcy90dXJuLm1pbi5qcycsXG4gICAgICAgICAgICAnQCc6ICcvcmVzb3VyY2VzL2pzJyxcbiAgICAgICAgICAgICd2dWUnOiAndnVlL2Rpc3QvdnVlLmVzbS1idW5kbGVyLmpzJ1xuICAgICAgICB9XG4gICAgfVxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQW1aLFNBQVMsb0JBQW9CO0FBQ2hiLE9BQU8sYUFBYTtBQUNwQixPQUFPLFNBQVM7QUFDaEIsT0FBTyxpQkFBaUI7QUFFeEIsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTztBQUFBLFFBQ0g7QUFBQSxRQUNBO0FBQUEsTUFFSjtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLElBQ0QsSUFBSTtBQUFBLEVBQ1I7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNILFVBQVU7QUFBQSxNQUNWLFdBQVc7QUFBQSxNQUNYLEtBQUs7QUFBQSxNQUNMLE9BQU87QUFBQSxJQUNYO0FBQUEsRUFDSjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
