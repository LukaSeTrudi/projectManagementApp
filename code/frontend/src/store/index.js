import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import auth from './modules/auth.js';
import general from './modules/general.js';

export default new Vuex.Store({
  modules: {
    auth,
    general
  }
})
