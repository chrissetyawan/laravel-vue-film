import Vue from 'vue'
import Vuex from 'vuex'

import general from './general.module'
import auth from './auth.module'
import film from './film.module'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    general,
    auth,
    film
  }
})
