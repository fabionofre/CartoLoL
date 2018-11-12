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
            <div class="full-page login-page">
                <div class="content">
                    <div class="container">
                        <div class="col-lg-5 col-md-4 ml-auto mr-auto">
                            <form class="form">
                                <div class="card card-login card-white">
                                    <div class="card-header" style="font-size: 12px">
                                        <img src="../../../assets/img/card-warning.png" alt="">
                                        <h1 class="card-title">Nova <br>Senha</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group input-success">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-lock-circle"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nova Senha">
                                        </div>
                                        <div class="input-group input-success">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-check-2"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Confirme a Nova Senha">
                                        </div>
                                        <div class="card-footer">
                                            <a href="../dashboard.html" class="btn btn-warning btn-lg btn-block mb-3">Confirmar</a>
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
