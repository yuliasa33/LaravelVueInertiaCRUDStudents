import '../css/app.css';
import './bootstrap';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import lara from '@primevue/themes/material';
import 'primeicons/primeicons.css'; // Import PrimeIcons styles
import ToastService from 'primevue/toastservice';
import Students from './Pages/Students.vue';
import { Toast } from 'primevue';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(PrimeVue,{
                theme: {
                    preset: lara,
                    options: {
                        prefix: 'p',
                        darkModeSelector: false,
                        cssLayer: false
                    }
                }
            })
            .component('Toast',Toast)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
