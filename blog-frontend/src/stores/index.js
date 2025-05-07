import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLoggedIn: !!localStorage.getItem('token')
  },
  mutations: {
    setLogin(state, status) {
      state.isLoggedIn = status
    }
  },
  actions: {
    login({ commit }) {
      commit('setLogin', true)
    },
    logout({ commit }) {
      localStorage.removeItem('token')
      commit('setLogin', false)
    }
  },
  getters: {
    isLoggedIn: state => state.isLoggedIn
  }
})