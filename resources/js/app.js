require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import Vuex from 'vuex';
import { cart } from './store/cart'
import { setupI18n } from './i18n';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import moment from 'moment';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(Vuex)
    .use(InertiaPlugin)
    .use(Vuex)
    .use(cart)
    .use(setupI18n({
        locale: 'nl',
        fallbackLocale: 'nl',
    }))
    .mixin({
        created: function () {
            this.moment = moment;
        }
    })
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
