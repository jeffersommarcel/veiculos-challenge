<template>
    <div class="d-flex content-main" id="wrapper">
        <div class="sidebar" id="sidebar-wrapper">
            <div class="sidebar-heading"> <img src="/img/logos/logo-main-azul.svg" alt=""> </div>
            <div class="list-group list-group-flush">
                <router-link to="/veiculos"><a href="#" class="list-group-item list-group-item-action"> <i class="fas fa-table icon"></i> <strong>Lista</strong> </a></router-link>
                <router-link to="/veiculos/cadastro"><a href="#" class="list-group-item list-group-item-action"> <i class="fas fa-marker icon"></i> <strong>Cadastro</strong> </a></router-link>
            </div>
        </div>
        <div class="content-page" id="page-content-wrapper">
                    <a class="btn-toggle-sidebar col-md-12 toggle-off" id="btn-toggle-sidebar" @click="toggleMenu()">
            <img class="img-btn-toggle" src="/img/logos/logo-coelho-azul.svg" width="45" >
        </a>
            <div class="col-md-12">
                <div class="container-fluid">
                    <transition 
                        appear
                        mode="out-in"
                        enter-active-class="animate__animated animate__fadeInLeft"
                        leave-active-class="animate__animated animate__fadeOutRight">
                        <router-view></router-view> 
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'bootstrap/dist/js/bootstrap.min.js';
    import 'jquery/dist/jquery.min.js';
    import 'popper.js/dist/umd/popper.min.js'
    import $ from 'jquery';
    import 'animate.css';

    export default {
        mounted() {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        },
        created() {
            this.$router.push('/veiculos');
        },
        methods: {
            toggleMenu(){
                $("#btn-toggle-sidebar").toggleClass("toggle-on");
                $("#wrapper").toggleClass("toggled");
            }
        }
    }
</script>

<style lang="scss">
    // Variaveis globais
    $background: #ffffff;
    $background-white: #fcfdff;
    $main-shadow: rgba(17, 17, 16, 0.1) 0px 0px 16px;
    $color-1:#e9eefd;
    $color-2:#00bce7;
    $color-h1: #1b1e3d;

    // Configurações globais
    body {
        overflow-x: hidden;
        background: $background-white;
    }
    
    h1{
        color:$color-h1;
    }

    input, textarea{
        border-radius:0px !important;
    }

    span{
        border-radius: 0px !important;
    }

    .sidebar {
        border-radius:5px;
        background: $background;
        min-height: 100vh;
        margin-left: -15rem;
        transition: margin .25s ease-out;
        box-shadow: $main-shadow;
        padding-top:35px;
    }

    // Configurações Sidebar e Content
    .sidebar .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
    }

    .sidebar .list-group {
        width: 15rem;
        padding: 10px;
    }

    .btn-toggle-sidebar{
        width: 100%;
        height: 50px;
        text-align: center;
        margin-bottom:15px;
        img{
            cursor: pointer;
        }
    }

    .toggle-off{
        display: none;
    }

    .toggle-on{
        display: block;
    }

    .list-group-item{
        color:$color-2;
        background: $color-1;
        margin:2px;
        border-radius:3px;
        .icon{
            margin-right: 10px;
        }
    }

    .content-page {
        min-width: 100vw;
        height: 97vh;
        max-height: 97vh;
        overflow: auto;
    }

    .content-main.toggled .sidebar {
        margin-left: 0;
    }

    .menu-toggle{
        margin-left: 5px;
        height: 40px;
        border-radius:20px;
    }
    
    .btn-toggle{
        background: none;
        border:none;
        padding: 10px;
        display: none;
    }

    .container-fluid{
        padding: 30px 20px;
    }

    .navbar{
        background: $background-white;
        margin-left:15px;
        padding-right:20px;
        padding-right:35px;
    }

    .nav-item{
        cursor: pointer;

        img{
            width: 50px;
            height: 50px;
            border-radius:50px;
        }
    }

    @media (min-width: 768px) {
        .sidebar {
            margin-left: 0;
        }

        .content-page {
            min-width: 0;
            width: 100%;
        }

        .content-main.toggled .sidebar {
            margin-left: -15rem;
        }

        
    }

    @media only screen and (max-width: 600px) {
        .btn-toggle-sidebar{
            display: block !important;
        }
    }

    // Components globais
    .card{
        border:none;
        box-shadow: $main-shadow;
        background: $background;
        // padding: 80px 50px; 
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
    .btn-register{
        background: $color-2;
        color:$color-1;
        width: 200px;
        border-radius:0px;
        transition: 0.4s;

        &:hover{
            background: $color-1;
            color:$color-2;
            border: 1px solid $color-2;
            transition: 0.4s;
        }
    }
</style>