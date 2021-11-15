import Vue from 'vue';

const lang = Vue.$cookies.get("lang") ?? 'en';
// // const common = require('./lang/' + lang + '/common.json');
// const dashboard = require('./lang/' + lang + '/dashboard.json');
// const borrowing = require('./lang/' + lang + '/borrowing.json');

// Vue.i18n.add(lang, common);
// Vue.i18n.add(lang, dashboard);
// Vue.i18n.add(lang, borrowing);
Vue.i18n.set(lang);
