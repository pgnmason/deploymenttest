import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Preferences from '@/components/Preferences'
import Locator from '@/components/Locator'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/preferences',
      name: 'Preferences',
      component: Preferences
    },
    {
      path: '/locator',
      name: 'Locator',
      component: Locator
    }
  ]
})
