import Vue from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);
// require( 'jszip' );
// require( 'pdfmake' );
// require( 'datatables.net-bs5' )();
// require( 'datatables.net-buttons-bs5' )();
// require( 'datatables.net-buttons/js/buttons.colVis.js' )();
// require( 'datatables.net-buttons/js/buttons.html5.js' )();
// require( 'datatables.net-buttons/js/buttons.print.js' )();
// require( 'datatables.net-responsive-bs5' )();
// require( 'datatables.net-searchbuilder-bs5' )();
// require( 'datatables.net-searchpanes-bs5' )();
Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
