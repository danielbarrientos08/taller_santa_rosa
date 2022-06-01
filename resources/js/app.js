
require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue/dist/vue'

window.Vue = Vue
/**Toastr  */
window.toastr = require('toastr');//para usar de manera global

/* ElementUI .io*/
import ElementUI from 'element-ui';
//  import 'element-ui/lib/theme-chalk/index.css';
window.Vue.use(ElementUI); //para usar de manera global

/* sweet alert */
import Swal from 'sweetalert2'
window.Swal = Swal; //para poder usar globalmente
// import 'sweetalert2/src/sweetalert2.scss'
import '@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css';

/* moment- Biblioteca para formatear fechas y horas */
import moment from 'moment';
moment.locale('es');
window.moment = moment;

/**Event Bus --sirve para pasar datos entre componentes */
export const EventBus = new Vue();
window.EventBus = EventBus;

/**ApexCharts */
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

// Vue.use(VueEllipseProgress, "vep");
// componentes del admin template
/**Componente login */
Vue.component('login-admin', require('./pages/admin/Login.vue').default);
Vue.component('login-web', require('./pages/web/Login.vue').default);
Vue.component('admin-estudiante-index', require('./pages/admin/estudiante/Index.vue').default);
Vue.component('admin-matricula-index', require('./pages/admin/matricula/Index.vue').default);
Vue.component('web-matricula-index', require('./pages/web/matricula/Index.vue').default);



const app = new Vue({
    el: '#app',
});
