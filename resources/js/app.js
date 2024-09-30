import './bootstrap';

import 'vuetify/styles';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import * as vuetifyCoreComponents from 'vuetify/components';
import * as vuetifyDerectives from 'vuetify/directives';
import { createVuetify } from 'vuetify';

const vuetify = createVuetify({
    vuetifyCoreComponents,
    vuetifyDerectives,
  });
  

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    return pages[`./pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(vuetify)
      .mount(el)
  },
})
