import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/views/HomeView.vue'
import Login from '@/views/LoginView.vue'
import Register from '@/views/RegisterView.vue'
import Publications from '@/views/PublicationsView.vue'
import PublicationDetail from '@/views/PublicationDetailView.vue'
import CreatePublication from '@/views/CreatePublicationView.vue'


Vue.use(Router)

const router =  new Router({
  mode: 'history',
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/publications', name: 'publications', component: Publications },
    { path: '/publications/:id', name: 'publications-detail', component: PublicationDetail },
    { path: '/create', name: 'create', component: CreatePublication },
    { path: '/edit/:id', name: 'edit', component: () => import('@/views/EditPublicationView.vue') }
  ]
})

router.beforeEach((to,from, next) => {
  const publicPages = ['login', 'register', 'home']
  const authRequired = !publicPages.includes(to.name)
  const loggedIn = !!localStorage.getItem('token')

  if (authRequired && !loggedIn) {
    return next('/login')
  }

  next()
})

export default router