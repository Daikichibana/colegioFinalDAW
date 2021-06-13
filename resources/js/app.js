/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('frmestudiante', require('./components/frmEstudiante.vue').default);
Vue.component('frmbienvenida', require('./components/frmBienvenida.vue').default);
Vue.component('frmapoderado', require('./components/frmApoderado.vue').default);
Vue.component('frmarmarhorario', require('./components/frmArmarHorario.vue').default);
Vue.component('frmasignarcursoestudiante', require('./components/frmAsignarCursoEstudiante.vue').default);
Vue.component('frmasignarcursogestion', require('./components/frmAsignarCursoGestion.vue').default);
Vue.component('frmasignarcursomateriadocente', require('./components/frmAsignarCursoMateriaDocente.vue').default);
Vue.component('frmaula', require('./components/frmAula.vue').default);
Vue.component('frmbimestre', require('./components/frmBimestre.vue').default);
Vue.component('frmconsultarcalificacion', require('./components/frmConsultarCalificacion.vue').default);
Vue.component('frmcursos', require('./components/frmCursos.vue').default);
Vue.component('frmdocente', require('./components/frmDocente.vue').default);
Vue.component('frmgestion', require('./components/frmGestion.vue').default);
Vue.component('frmhorario', require('./components/frmHorario.vue').default);
Vue.component('frminscripcion', require('./components/frmInscripcion.vue').default);
Vue.component('frmmateria', require('./components/frmMateria.vue').default);
Vue.component('frmparalelo', require('./components/frmParalelo.vue').default);
Vue.component('frmturno', require('./components/frmTurno.vue').default);
Vue.component('frmusuarios', require('./components/frmUsuarios.vue').default);
Vue.component('frmcalificacion', require('./components/frmCalificaciones.vue').default);
Vue.component('frmingresarcalificacion', require('./components/frmIngresarCalificacion.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
