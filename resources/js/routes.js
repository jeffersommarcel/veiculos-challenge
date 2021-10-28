import ListaVeiculos from './pages/veiculos/Lista.vue';
import CadastroVeiculo from './pages/veiculos/Cadastro.vue';
import EditarVeiculo from './pages/veiculos/Editar.vue';

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/veiculos',
            component: ListaVeiculos,
        },
        {
            path: '/veiculos/cadastro',
            component: CadastroVeiculo
        },
        {   
            name: 'Editar',
            path: '/veiculo/editar/:id',
            component: EditarVeiculo,
            props:true
        }
    ]
})