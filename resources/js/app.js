import "./bootstrap";
import 'animate.css';
import '../css/app.css';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { Head, Link } from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { QuillEditor } from "@vueup/vue-quill";
createInertiaApp({
    title: title => `${title} - Banua Kursus`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .component("QuillEditor" , QuillEditor)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
        showSpinner: true,
    },
});
