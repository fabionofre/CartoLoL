<template>
    <div>
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
                    <a class="navbar-brand" href="javascript:void(0)">Recuperação de Senha</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <router-link to="login" class="nav-link text-success">
                                <i class="tim-icons icon-minimal-left"></i> Voltar para Login
                            </router-link>
                        </li>
                        <li class="nav-item ">
                            <router-link to="register" class="nav-link">
                                <i class="tim-icons icon-laptop"></i> Registrar-se
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
        <!-- End Navbar -->
        <div class="wrapper wrapper-full-page ">
            <div class="full-page login-page ">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="content">
                    <div class="container">
                        <div class="col-lg-5 col-md-4 ml-auto mr-auto">
                            <form class="form">
                                <div class="card card-login card-white">
                                    <div class="card-header" style="font-size: 12px">
                                        <img src="../../../assets/img/card-success.png" alt="">
                                        <h1 class="card-title">Recuperar Senha</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group input-success">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-email-85"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="E-mail">
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-success btn-lg btn-block mb-3">Recuperar</button>
                                            <div class="pull-left">
                                                <h6>
                                                    <router-link to="register" class="link footer-link text-success">Criar
                                                        Conta</router-link>
                                                </h6>
                                            </div>
                                            <div class="pull-right">
                                                <h6>
                                                    <a href="../ajuda/ajuda.html" class="link footer-link text-success">Precisa
                                                        de Ajuda?</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style scoped>

</style>
