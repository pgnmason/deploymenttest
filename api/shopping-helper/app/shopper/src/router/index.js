import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Preferences from '@/components/Preferences'
import Locator from '@/components/Locator'
import Results from '@/components/Results'


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
    },
    {
      path: '/results',
      name: 'Results',
      component: Results
    }
  ]
})
