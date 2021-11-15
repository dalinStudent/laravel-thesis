require('./bootstrap');
import Vue from 'vue';
import store from './store';
import vuetify from './vuetify';
import router from '../js/route/index';
import vuexI18n from 'vuex-i18n';
import VueSwal from 'vue-swal';
import Http from './http/index';
import ConfirmModal from './components/Modal/Confirm';
import TemplateA from './components/Template/TemplateA';
import DataTable from './components/Table/DataTable'

Vue.use(vuexI18n.plugin, store, {});
Vue.use(VueSwal)
Vue.use(Http)
Vue.component('ConfirmModal', ConfirmModal);
Vue.component('TemplateA', TemplateA);
Vue.component('DataTable', DataTable)

require('./i18n');

Vue.config.productionTip = false

const app = new Vue({
    el: '#app',
    store,
    router,
    vuetify,
});
export default app;