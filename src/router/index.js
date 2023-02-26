import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginVue from '../components/LoginVue.vue'
import RegistrarUsuario from '../components/RegistrarUsuario.vue'
// import HomeView from '../views/HomeView.vue'

import ListarClientes from '../components/ListarClientes.vue'
import AgregarCliente from '../components/AgregarCliente.vue'
import EditarCliente from '../components/EditarCliente.vue'
import VisualizarDatos from '../components/VisualizarDatos.vue'

import ListarPolizas from '../components/ListarPolizas.vue'
import AgregarPoliza from '../components/AgregarPoliza.vue'
import EditarPoliza from '../components/EditarPoliza.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginVue
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
    component: ListarClientes,
    meta: { requireAuth: true }
  },
  {
    path: '/agregar-cliente',
    name: 'agregarcliente',
    component: AgregarCliente,
    meta: { requireAuth: true }
  },
  {
    path: '/editar-cliente',
    name: 'editarcliente',
    component: EditarCliente,
    meta: { requireAuth: true }
  },
  {
    path: '/visualizar-datos',
    name: 'visualizardatos',
    component: VisualizarDatos,
    meta: { requireAuth: true }
  },
  {
    path: '/listar-polizas',
    name: 'listarpolizas',
    component: ListarPolizas,
    meta: { requireAuth: true }
  },
  {
    path: '/agregar-poliza',
    name: 'agregarpoliza',
    component: AgregarPoliza,
    meta: { requireAuth: true }
  },
  {
    path: '/editar-poliza',
    name: 'editarpoliza',
    component: EditarPoliza,
    meta: { requireAuth: true }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

// router.beforeEach((to, from, next) => {
//   if(to.matched.some(route => route.meta.requireAuth)){
//     if()
//   }
// })

export default router
