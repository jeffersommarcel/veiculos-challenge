<template>
    <div class="row justify-content-md-center content-lista">
        <div class="card col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <h4>Lista de Veículos</h4>
                    <p class="lead">Lista com todos os veiculos cadastrados no sistema.</p>
                </div>
            </div>
            <div class="overflow-auto">
                <div class="table-responsive">
                    <b-table
                        :busy="isBusy"
                        class="table table-bordered table-hover"
                        id="my-table"
                        :items="items"
                        :per-page="perPage"
                        :fields="fields"
                        :current-page="currentPage"
                        responsive
                        >
                        <template #cell(vendido)="data">
                            <span v-html="labelStatus(data.value)"></span>
                        </template>
                        <template #cell(actions)="row">
                            <b-button size="sm" @click="editar(row.item.id)" class="btn btn-info mr-1">
                                Editar
                            </b-button>
                            <b-button size="sm" @click="deletar(row.item.id)" class="btn btn-danger mr-1">
                                Deletar
                            </b-button>
                        </template>
                        <template #table-busy>
                            <div class="text-center">
                                <strong class="text-loading">Carregando...</strong>
                            </div>
                        </template>
                    </b-table>

                </div>
                <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                    pills >
                </b-pagination>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
    .lead{
        font-size:10px;
        color:rgb(167, 167, 167);
    }
    .table{
        thead{
            background: #ebebeb;
        }
    }
    .card{
        padding: 30px 50px !important;
    }

    .label {
        padding: 1px 10px;
        border-radius: 50px;
        border-style: solid;
        border-width: 1px;
        font-size: 12px;
    }

    .label-success {
        background-color: rgba(227, 253, 235, 1);
        border-color: rgba(38, 179, 3, 1);
        color: rgba(60, 118, 61, 1);
    }

    .label-warning {
        background-color: rgba(252, 248, 227, 1);
        border-color: rgba(177, 161, 129, 1);
        color: rgba(138, 109, 59, 1);
    }
    .text-loading{
        color:#00bce7;
    }

</style>

<script>
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
            perPage: 10,
            currentPage: 1,
            isBusy: true,
            fields: [
                {
                    key: 'id',
                    sortable: true,
                    label: 'ID',
                },
                {
                    key: 'veiculo',
                    label: 'Veículo',
                },
                {
                    key: 'marca',
                    label: 'Marca',
                },
                {
                    key: 'ano',
                    label: 'Ano',
                },
                {
                    key: 'descricao',
                    sortable: true,
                    label: 'Descrição',
                },
                {
                    key: 'vendido',
                    sortable: true,
                    label: 'Status',
                },
                {
                    key: 'criado',
                    sortable: true,
                    label: 'Criado',
                },
                {
                    key: 'actions',
                    label: 'Ações'
                }
            ],
            items: []
            }
        },
        computed: {
            rows() {
            return this.items.length
            }
            
        },
        mounted(){
            this.get();
        },
        methods: {
            labelStatus(status) {
                return status === 1 ? '<label class="label label-success">Vendido</label>' : '<label class="label label-warning">Disponível</label>';
            },
            editar(item){
                this.$router.push({name: 'Editar', params:{id: item}})
            },
            deletar(item){
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não será capaz de reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim, deletar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.isBusy = true;
                        axios.delete('http://localhost:8000/api/delete/veiculo/' + item)
                            .then((response) => {
                            if(response.data.err === 0){
                                Swal.fire({
                                    title: "Item Deletado!",
                                    text: response.data.data.message,
                                    icon: "success"
                                })
                            }else{
                                Swal.fire({
                                    tutle: "Houve um Problema!",
                                    text: response.data.data.message,
                                    icon: "error"
                                })
                            }
                            this.get();
                        })
                    }  
                })
            },
            delete(id){

            },
            get(){
                axios.get('http://localhost:8000/api/get/veiculos')
                .then((response) => {
                    this.items = response.data.data.veiculos;
                    this.isBusy = false;
                })
                .catch((error) => {
                    console.log(error);
                }) 
            }
        }
    }
</script>