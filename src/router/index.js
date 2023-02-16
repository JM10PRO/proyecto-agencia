import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginVue from '../components/LoginVue.vue'
import RegistrarUsuario from '../components/RegistrarUsuario.vue'
import HomeView from '../views/HomeView.vue'

import ListarClientes from '../components/ListarClientes.vue'
import AgregarCliente from '../components/AgregarCliente.vue'
import EditarCliente from '../components/EditarCliente.vue'

import ListarPolizas from '../components/ListarPolizas.vue'
import AgregarPoliza from '../components/AgregarPoliza.vue'
import EditarPoliza from '../components/EditarPoliza.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: LoginVue
  },
  {
    path: '/registrarse',
    name: 'registrarse',
    component: RegistrarUsuario
  },
  {
    path: '/listar-clientes',
    name: 'listarclientes',
    component: ListarClientes
  },
  {
    path: '/agregar-cliente',
    name: 'agregarcliente',
    component: AgregarCliente
  },
  {
    path: '/editar-cliente',
    name: 'editarcliente',
    component: EditarCliente
  },
  {
    path: '/listar-polizas',
    name: 'listarpolizas',
    component: ListarPolizas
  },
  {
    path: '/agregar-poliza',
    name: 'agregarpoliza',
    component: AgregarPoliza
  },
  {
    path: '/editar-poliza',
    name: 'editarpoliza',
    component: EditarPoliza
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
