<template>
    <div class="login-page">
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
        <a class="navbar-brand" href="javascript:void(0)">Login</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ml-auto">
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
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <form class="form">
              <div class="card card-login card-white">
                <div class="card-header">
                  <img src="../../assets/img/card-primary.png" alt="">
                  <h1 class="card-title">Login</h1>
                </div>
                <div class="card-body">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="E-mail">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                      </div>
                    </div>
                    <input type="text" placeholder="Senha" class="form-control">
                  </div>
                  <div class="pull-right">
                      <h6>
                        <router-link to="recuperarSenha" class="link footer-link">Esqueci a Senha</router-link>
                      </h6>
                    </div>
                </div>
                <div class="card-footer">
                  <a href="Javascript:void(0);" class="btn btn-primary btn-lg btn-block mb-3">Iniciar</a>
                   <a href="Javascript:void(0);" @click="loginFacebook()"  class="btn btn-secondary btn-lg btn-block mb-3">Logar com Facebook</a>
                  <div class="pull-left">
                    <h6>
                      <router-link to="register" class="link footer-link">Criar Conta</router-link>
                    </h6>
                  </div>
                  <div class="pull-right">
                    <h6>
                      <a href="../ajuda/ajuda.html" class="link footer-link">Precisa de Ajuda?</a>
                    </h6>
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
import axios from 'axios';
export default {
    name: 'Login',
    mounted(){
    },
    data(){
      return {
        
      }
    },
    methods:{
      loginFacebook(){
        axios.get("http://localhost:8000/login/facebook")
          .then(
            response => {
              console.log(response)
              window.location = response.data.redirectUrl
            }
          );
      }
    }
}
</script>
<style scoped>

</style>
