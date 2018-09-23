import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  routes: [
    { path: '/', redirect: '/films' },
    {
      name: 'home',
      path: '/home',
      component: () => import('@/views/Home')
    },
    {
      name: 'login',
      path: '/login',
      component: () => import('@/views/Login')
    },
    {
      name: 'register',
      path: '/register',
      component: () => import('@/views/Register')
    },
    {
      name: 'profile',
      path: '/profile',
      component: () => import('@/views/Profile')
    },
    {
      name: 'films',
      path: '/films',
      component: () => import('@/views/Film')
    },
    {
      name: 'film-detail',
      path: '/films/:slug',
      component: () => import('@/views/FilmDetail'),
      props: true
    },
    {
      name: 'film-create',
      path: '/films/create',
      component: () => import('@/views/FilmCreate')
    }
  ]
})
