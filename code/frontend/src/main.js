import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'

import RequestService from "@/services/request.service";
import VueRouter from 'vue-router'
import store from './store'
import router from './router'
import draggable from 'vuedraggable'

RequestService.init("http://localhost:80");

Vue.config.productionTip = false
Vue.component('draggable', draggable);
new Vue({
  vuetify,
  VueRouter,
  store,
  router,
  render: h => h(App)
}).$mount('#app')
