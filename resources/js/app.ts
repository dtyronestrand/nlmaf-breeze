import '../css/app.css';


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@fontsource/protest-revolution'
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name: string) => {
let page: DefineComponent;
if (name.startsWith('programs/')){
    const programName = name.substring('programs/'.length);
    page = await resolvePageComponent(`./Programs/${programName}.vue`, import.meta.glob<DefineComponent>('./Programs/**/*.vue'));
} else {
    page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue'));
}
        const layoutName = page.default.layoutName || 'Default';
        page.default.layout = (await import(`./Layouts/${layoutName}.vue`)).default;
     
        return page;
    },
        
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
