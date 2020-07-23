import Vue from 'vue';
import Router from 'vue-router';
import Example from './components/ExampleComponent.vue';
import Formulario from './components/FormularioComponent.vue';
import Login from './components/LoginComponent.vue';
Vue.use(Router);

let routes=[{
        path:"/",
        name:'home',
        component: Login
    },{
        path:"/reporte",
        name:'reporte',
        component:Formulario
    },{
        path:"/login1",
        name:"login",
        component:Login
    }];

export default new Router({
    routes,
    mode:'history'
})
