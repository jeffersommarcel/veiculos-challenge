<template>
    <div class="row justify-content-md-center content-editar">
        <div class="card col-md-10">
            <loading :active='isLoading' :is-full-page="fullPage"/>
            <div class="row">
                <div class="col-md-10">
                    <h4>Editar Veículo - {{id}}</h4>
                    <p class="lead">Edita as informações do veículo no sistema.</p>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-back pull-right" @click="voltar()"> <strong> Voltar a Lista </strong> </a>
                </div>
            </div>
            <form @submit.prevent="updateVeiculo" method="post" class="form-update">
                <div class="row">
                    <div class="col-md-6 col-inputs">
                        <label class="label-input"> <h5>Veículo</h5> </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="veiculo-icon"><i class="fas fa-car icon"></i></span>
                            </div>
                            <input type="text" v-model="veiculo.veiculo" class="form-control" placeholder="Veículo" aria-label="Veículo" aria-describedby="veiculo-icon" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-inputs">
                        <label class="label-input"> <h5>Marca</h5> </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="marca-icon"><i class="fas fa-atlas icon"></i></span>
                            </div>
                            <input type="text" v-model="veiculo.marca" class="form-control" placeholder="Marca" aria-label="Marca" aria-describedby="marca-icon" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-inputs">
                        <label class="label-input"> <h5>Ano</h5> </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="ano-icon"><i class="fas fa-calendar-day icon"></i></span>
                            </div>
                            <input type="number" v-model="veiculo.ano" min="1990" max="2100" class="form-control" placeholder="Ano" aria-label="Ano" aria-describedby="ano-icon" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-inputs">
                        <label class="label-input"> <h5>Vendido</h5> </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="status-icon"><i class="fas fa-toggle-on icon"></i></span>
                            </div>
                            <select class="form-control" v-model="status" placeholder="Status" aria-label="Status" aria-describedby="status-icon" required>
                                <option value="true">Sim</option>
                                <option value="false">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-inputs">
                        <label class="label-input"> <h5>Descrição</h5> </label>
                        <div class="input-group mb-3">
                            <textarea class="form-control" v-model="veiculo.descricao" placeholder="Descrição..." id="exampleFormControlTextarea1" rows="3" required></textarea> 
                        </div>
                    </div>
                    <div class="col-md-6 col-inputs">
                        <button class="btn btn-register pull-left" type="submit"> <strong> Editar </strong> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    $main-shadow: rgba(17, 17, 16, 0.1) 0px 0px 16px;
    $background: #ffffff;
    $color-1:#e9eefd;
    $color-2:#00bce7;
    $color-3:#dc3545;
    $color-4: white;

    .card{
        border:none;
        box-shadow: $main-shadow;
        background: $background;
        margin-top: 15px;
    }
    .icon{
        color:$color-2;
    }
    .form-control:focus {
        border-color: $color-2;
        box-shadow: none;
    }
    .input-group-text{
        background: $color-1;
    }
    .btn {
        width: 200px;
        border-radius:0px;
        transition: 0.4s;
    }
    .btn-register{
        background: $color-2;
        color:$color-1;
        &:hover{
            background: $color-4;
            color:$color-2;
            border: 1px solid $color-2;
            transition: 0.4s;
        }
    }
    .btn-back{
        background: $color-3;
        color:$color-4;

        &:hover{
            background: $color-4;
            color:$color-3;
            border: 1px solid $color-3;
            transition: 0.4s;
        }
    }

    

</style>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import Swal from 'sweetalert2';

    export default {
        props: {
            id: null
        },
        data() {
            return {
                veiculo: [],
                isLoading: true,
                fullPage: false
            }
        },
        components: {
            Loading,
        },
        mounted() {
            this.get();
        },
        computed:{
            status(){
                return this.veiculo.vendido === 1 ? 'true' : 'false';
            }
        },
        methods: {
            updateVeiculo() {
                this.isLoading = true;
                axios.put('http://localhost:8000/api/update/veiculos/' + this.id, {
                    veiculo: this.veiculo
                })
                .then((response) => {
                    this.isLoading = false;
                    if(response.data.err === 0){
                        Swal.fire({
                            title: "Atualização Realizada!",
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
            },
            voltar() {
                this.$router.push('/veiculos')
            },
            get(){
                axios.get('http://localhost:8000/api/get/veiculo/' + this.id)
                .then((response) => {
                    this.veiculo = response.data.data.veiculo;
                    setTimeout(() => this.isLoading = false, 1500)
                })
                .catch((error) => {
                    console.log(error);
                })
            }
        }
    }
</script>