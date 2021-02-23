import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Login from '@/pages/login/Login'
import Cadastro from '@/pages/cadastro/Cadastro'
import Alterar from '@/pages/alterar/Alterar'
import Deletar from '@/pages/deletar/Deletar'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/cadastro',
      name: 'Cadastro',
      component: Cadastro
    },
    {
      path: '/alterar/:id',
      name: 'Alterar',
      component: Alterar
    },
    {
      path: '/deletar/:id',
      name: 'Deletar',
      component: Deletar
    }  
  ]
})
