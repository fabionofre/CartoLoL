<template>
    <div class="register-page">
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                    </div>
                    <a class="navbar-brand" href="javascript:void(0)">Página de Registro</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <router-link to="login" class="nav-link">
                                <i class="tim-icons icon-single-02"></i> Login
                            </router-link>
                        </li>
                        <li class="nav-item  active ">
                            <a href="../sobreNos/sobreNos.html" class="nav-link">
                            <i class="tim-icons icon-paper"></i> Sobre
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrapper wrapper-full-page ">
            <div class="full-page register-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                            <div class="info-area info-horizontal mt-5">
                                <div class="icon icon-warning">
                                <i class="tim-icons icon-chat-33"></i>
                                </div>
                                <div class="description">
                                <h3 class="info-title">Interação</h3>
                                <p class="description">
                                    Convide seus amigos para participar de uma liga e apostem entre sí.
                                </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-primary">
                                <i class="tim-icons icon-trophy"></i>
                                </div>
                                <div class="description">
                                <h3 class="info-title">Mãos a Obra</h3>
                                <p class="description">
                                    Escale times com jogadores e obtenha pontos para subir nos rankings.
                                </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-info">
                                <i class="tim-icons icon-spaceship"></i>
                                </div>
                                <div class="description">
                                <h3 class="info-title">Vamos Lá!</h3>
                                <p class="description">
                                    Compartilhe seu desempenho e mostre para todos o seu potencial.
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-7 mr-auto">
                            <div class="card card-register card-white">
                                <div class="card-header">
                                <img class="card-img" src="../../assets/img/card-primary.png" alt="Card image">
                                <h4 class="card-title">Registro</h4>
                                </div>
                                <div class="card-body">
                                <form class="form">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.nome" class="form-control" placeholder="Nome">
                                    </div>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="tim-icons icon-controller"></i>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.apelido" class="form-control" placeholder="Apelido">
                                    </div>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.email" placeholder="E-mail" class="form-control">
                                    </div>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" v-model="form.password" placeholder="Senha">
                                    </div>
                                </form>
                                </div>
                                <div class="card-footer">
                                <a href="javascript:void(0)" @click.prevent="register()" class="btn btn-primary btn-round btn-lg">Iniciar</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Register',
    data(){
        return {
            form: {
                email: null,
                password: null,
                nome: null,
                apelido: null
            }
        }
    },
    methods: {
        register(){
            axios.post("auth/register", this.form)
                .then(
                    response => {
                        this.$notify({verticalAlign: 'top', horizontalAlign: 'center', type: 'info', message: "Link de confirmação enviado para o seu e-mail!"});
                        window.location = "http://localhost:8080/#/login";
                    },
                    error => console.error(error)
                );
        }
    }
}
</script>
<style scoped>

</style>
