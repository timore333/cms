require('./bootstrap');
require('moment');
require('bootstrap-table/dist/bootstrap-table.min.css');
require('bootstrap-table/dist/bootstrap-table.js');
require('bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js');
require('bootstrap-table/dist/extensions/print/bootstrap-table-print.min.js');
require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.css');
require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js');
require('tableexport.jquery.plugin');


import Vue from 'vue';
import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import {__, trans, setLocale, getLocale, transChoice, MaticeLocalizationConfig, locales} from "matice";
import NProgress from 'nprogress';
import {Inertia} from '@inertiajs/inertia';
import VModal from 'vue-js-modal';
import VueKonva from 'vue-konva';


Vue.mixin({
    methods: {
        $trans: trans,
        $__: __,
        $transChoice: transChoice,
        $setLocale: (locale) => {
          setLocale(locale);
          this.$forceUpdate() // Refresh the vue instance after locale change.
        },
        // The current locale
        $locale() {
            return getLocale()
        },
        // A listing of the available locales
        $locales() {
            return locales()
        }
    },
});

// progress indicator.
let timeout = null;
Inertia.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 500);
});
Inertia.on('finish', (event) => {
    NProgress.done();
    NProgress.remove();
});


Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VModal, {dialog: true});
Vue.use(VueKonva);
window.Bus = new Vue();
Vue.prototype.$route = (...args) => route(...args).url();

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
