import Vue from 'vue';
import App from './App.vue';
import router from './router';
import './registerServiceWorker';
import i18n from './plugins/i18n';
import './plugins/axios';
import store from './store/store';
import './utils/icons';
import VueYoutube from 'vue-youtube'

Vue.config.productionTip = false;
Vue.use(VueYoutube)

new Vue({
  router,
  i18n,
  store,
  render: h => h(App),
}).$mount('#app');
