<template>
    <div class="row justify-content-md-center content-cadastro">
        <div class="card col-md-8 col align-self-center">
            <loading :active='isLoading' :is-full-page="fullPage"/>
            <div class="row row-cadastro">
                <div class="col-md-6 col-form">
                    <form @submit.prevent="registerVeiculo" method="post" class="form-cadastro">
                        <div class="col-md-12 alert-title">
                            <h4>Cadastro de Veículos</h4>
                            <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam saepe, doloremque at iure ut odit.</p>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <label class="label-input"> <h5>Veículo</h5> </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="veiculo-icon"><i class="fas fa-car icon"></i></span>
                                </div>
                                <input type="text" v-model="veiculo" class="form-control" placeholder="Veículo" aria-label="Veículo" aria-describedby="veiculo-icon" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <label class="label-input"> <h5>Marca</h5> </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="marca-icon"><i class="fas fa-atlas icon"></i></span>
                                </div>
                                <input type="text" v-model="marca" class="form-control" placeholder="Marca" aria-label="Marca" aria-describedby="marca-icon" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <label class="label-input"> <h5>Ano</h5> </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="ano-icon"><i class="fas fa-calendar-day icon"></i></span>
                                </div>
                                <input type="number" min="1990" max="2100" v-model="ano" class="form-control" placeholder="Ano" aria-label="Ano" aria-describedby="ano-icon" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <label class="label-input"> <h5>Vendido</h5> </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="status-icon"><i class="fas fa-toggle-on icon"></i></span>
                                </div>
                                <select class="form-control" v-model="vendido" placeholder="Status" aria-label="Status" aria-describedby="status-icon" required>
                                    <option value="true">Sim</option>
                                    <option value="false">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <label class="label-input"> <h5>Descrição</h5> </label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" v-model="descricao" placeholder="Descrição..." id="exampleFormControlTextarea1" rows="3" required></textarea> 
                            </div>
                        </div>
                        <div class="col-md-12 col-inputs">
                            <button class="btn btn-register pull-left" type="submit"> <strong> Cadastrar </strong> </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-img">
                    <img class="img-fluid" src="/img/vetores/aluguel.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import axios from 'axios';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                veiculo: null,
                marca: null,
                ano: null,
                vendido: false,
                descricao: null,
                isLoading: false,
                fullPage: false
            }
        },
        components: {
            Loading,
        },
        methods:{
            registerVeiculo() {
                this.isLoading = true;
                axios.post('http://localhost:8000/api/register/veiculo', {
                    veiculo: this.veiculo,
                    marca: null,
                    ano: this.ano,
                    descricao: this.descricao,
                    vendido: this.vendido
                })
                .then((response) => {
                    this.isLoading = false;
                    if(response.data.err === 0){
                        Swal.fire({
                            title: "Cadastro Realizado!",
                            text: response.data.data.message,
                            icon: "success",
                            showCancelButton: true,
                            confirmButtonColor: '#00bce7',
                            confirmButtonText: 'Lista',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Fechar'
                        })
                        .then((result) => {
                            if(result.isConfirmed){
                                this.$router.push('/veiculos')
                            } 
                        })
                    }else{
                        Swal.fire({
                            tutle: "Houve um Problema!",
                            text: response.data.data.message,
                            icon: "error"
                        })
                    }
                })
            }
        }

    }

</script>

<style lang="scss" scoped>
    .lead{
        font-size:14px;
    }
    .col-md-5{
        padding: 0;
    }
    .card{
        padding:0px !important;
        border-radius: 10px !important;
    }
    .col-form{
        padding: 80px 50px; 

    }
    .col-img{
        padding: 0;
        border-radius: 10px;
        img{
            width: 97%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 10px !important;
            border-bottom-right-radius: 10px !important;
        }
    }
    .btn-register{
        width: 100%;
    }

    @media only screen and (max-width: 800px) {
        .col-img{
           img{
               display: none;
           }
        }
    }
</style>