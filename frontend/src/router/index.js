import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Campeonatos from '@/components/Campeonatos/Campeonatos'
import Equipes from '@/components/Equipes/Equipes'
import Atletas from '@/components/Atletas/Atletas'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/campeonatos',
      component: Campeonatos
    },
    {
      path: '/equipes',
      component: Equipes
    },
    {
      path: '/atletas',
      component: Atletas
    }
  ]
})
