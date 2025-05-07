import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './stores' // 👈 importa el store

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')