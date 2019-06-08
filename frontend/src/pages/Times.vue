<template>
    <div class="container">
        <div class="row">
            <div v-show="showForm" class="col col md-12 form-equipe">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-6" v-if="!equipe.brasao">
                                <label for="brasao">Brasão</label>
                                <input type="file" class="form-control" id="brasao" 
                                @change="onBrasaoChange"
                                placeholder="Brasão" :disabled="loading">
                            </div>
                            <div class="col col-md-6" v-if="equipe.brasao">
                                <img v-if="typeof(equipe.brasao) == 'file' || !imgPreview" 
                                :src="'http://www.zleague.com.br:8000/storage/'+equipe.brasao"
                                width="80px" height="80px" style="border-radius: 50%">
                                <img v-else :src="imgPreview"
                                width="80px" height="80px" style="border-radius: 50%">
                                <a href="javascript:void(0)" @click="equipe.brasao = null;imgPreview = null">
                                    <i class="tim-icons icon-simple-remove remove-brasao"></i>
                                </a>
                            </div>
                            <div class="col col-md-6">
                                <b-form-group label-class="label-radio" 
                                label="A equipe é profissional?">
                                    <b-form-radio-group v-model="equipe.fl_profissional"
                                                    :options="options"
                                                    name="radioProfissional">
                                    </b-form-radio-group>
                                </b-form-group>
                            </div>
                            <div class="col col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="equipe">Equipe</label>
                                    <input type="text" class="form-control" id="equipe" 
                                    v-model="equipe.nome"
                                    placeholder="Nome da equipe" :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <button class="btn btn-primary btn-block" 
                                @click="salvarEquipe()" :disabled="loading">
                                    <span v-if="!loading">
                                        {{equipe.id ? 'Editar' :'Cadastrar'}} Equipe
                                    </span>
                                    <div v-if="loading" class="loader"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="equipes.length > 0" class="row">
          <div :class="{'opaco': showForm, 'col-md-12': !showForm}" 
          class="col mr-auto ml-auto lista-equipes">
            <div class="wizard-container">
              <div class="card card-header" data-color="primary">
                <div class="card-header text-center">
                  <h3 class="card-title">Minhas Equipes</h3>
                  <h5 class="description">Veja detalhes de todas as equipes cadastradas.</h5>
                </div>
                <div class="card-body">
                  <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                    <div class="card card-plain" v-for="(equipe, index) in equipes" :key="equipe.id">
                      <div class="card-header equipe-card-header" id="headingOne">
                          <div class="info-equipe">
                              <img :src="'http://www.zleague.com.br:8000/storage/'+equipe.brasao"
                              width="80px" height="80px" style="border-radius: 50%">
                              <span>{{equipe.nome}}</span>
                          </div>
                          <div class="acoes">
                              <button class="btn btn-icon btn-simple btn-info" 
                              title="Editar">
                                  <a href="javascript:void(0)" 
                                  @click="editarEquipe(equipe)"
                                  >
                                      <i class="tim-icons icon-pencil text-info"></i>
                                  </a>
                              </button>
                              <button @click="deletarEquipe(equipe)" class="btn btn-icon btn-simple btn-danger" 
                              title="Excluir">
                                  <div v-if="equipe.excluindo" class="loader-lixeira"></div>
                                  <i v-else class="fa fa-trash"></i>
                              </button>
                          </div>
                          <a  class="flecha-collapse" v-b-toggle="'collapse'+index" 
                              data-toggle="collapse" 
                              href="javascript:void(0)">
                              <i class="tim-icons icon-minimal-down"></i><br/>
                          </a>
                      </div>
                      <b-collapse :id="'collapse'+index">
                        <div class="card-body card-atletas">
                            <ul class="nav nav-pills nav-pills-primary">
                                <li class="nav-item" v-for="atleta in equipe.atletas" :key="atleta.id">
                                <a class="nav-link active" :title="atleta.apelido" href="javascript:void(0)">
                                    <img :src="'http://www.zleague.com.br:8000/storage/'+atleta.foto" alt="">
                                </a>
                                </li>
                            </ul>
                        </div>
                      </b-collapse>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="!showForm">
            <h3>Você ainda não cadastrou nenhuma equipe!</h3>
        </div>
        <button v-if="!showForm" 
        class="btn btn-lg btn-round btn-primary btn-icon float-right my-fab" 
        title="Adicionar Equipe"
        @click="showForm = true"
        >
            <a href="javascript:void(0)">
                <i class="tim-icons icon-simple-add" style="color: #FFF"></i>
            </a>
        </button>
    </div>
</template>
<script>
export default {
    name: 'Equipes',
    mounted(){
      this.getEquipes();
    },
    data(){
      return {
        equipes: [],
        equipe: {
            id: null,
            nome: null,
            brasao: null,
            fl_profissional: 1,
            atletas: []
        },
        options: [
          {text: 'Sim', value: 1},
          {text: 'Não', value: 0}
        ],
        showForm: false,
        loading: null,
        imgPreview: null
      }
    },
    methods: {
      getEquipes(){
        axios.get("equipes")
          .then(
            response => {
              this.equipes = response.data;
              console.log(this.equipes);
            },
            error => console.error(error)
          );
      },
      salvarEquipe(){
        this.loading = true;
        const fd = new FormData();
        fd.append('nome', this.equipe.nome);
        fd.append('brasao', this.equipe.brasao, this.equipe.brasao.nome);
        fd.append('fl_profissional', this.equipe.fl_profissional ? 1 : 0);
        fd.append('criador_id', 1);
        if(this.equipe.id){
            // Edita a equipe
            // fd.append('atletas', this.equipe.atletas);
            fd.append('_method', 'put');
            axios.post('equipes/'+this.equipe.id, fd)
                .then(
                    (response) => {
                      this.getEquipes();
                      this.loading = false;
                      this.$notify({type: 'success', message: 'Equipe editada com sucesso!'});
                      this.esconderForm();
                    },
                    (error) => {
                      this.getEquipes();
                      this.esconderForm();
                      this.loading = false;
                      this.$notify({type: 'danger', 
                      message: 'Não foi possível editar a equipe :('});
                    }
                )
        }else{
            // Cria uma nova equipe
            axios.post('equipes', fd)
                .then(
                    (response) => {
                      this.getEquipes();
                      this.loading = false;
                      this.$notify({type: 'success', message: 'Equipe cadastrada com sucesso!'});
                      this.esconderForm();
                    },
                    (error) => {
                      this.getEquipes();
                      this.loading = false;
                      this.$notify({type: 'danger', 
                      message: 'Não foi possível cadastrar a equipe :('});
                      this.esconderForm();
                    }
                )
        }
      },
      editarEquipe(equipe){
        this.showForm = true;
        this.equipe = Object.assign({}, equipe);
      },
      deletarEquipe(equipe){
        equipe.excluindo = true;
        this.loading = true;
        axios.delete('equipes/'+equipe.id)
            .then(
                (response) => {
                  delete equipe.excluindo;
                  this.loading = false;
                  this.$notify({type: 'success', message: 'Equipe deletada com sucesso!'});
                  this.getEquipes();
                },
                (error) => {
                  delete equipe.excluindo;
                  this.loading = false;
                  this.$notify({type: 'danger', 
                  message: 'Não foi possível deletar a equipe :('});
                  this.getEquipes();
                }
            )
            .catch((response) => {
              delete equipe.excluindo;
              this.$notify({type: 'danger', 
              message: 'Houve algum problema no servidor, contate o administrador e'+
              'verifique sua conexão com a internet!'});
              this.getEquipes();
            });
      },
      onBrasaoChange(){
        this.equipe.brasao = event.target.files[0];
        this.previewBrasao(this.equipe.brasao);
      },
      previewBrasao(foto) {
        let reader = new FileReader();
        reader.readAsDataURL(foto);
        reader.onloadend = () => {
            this.imgPreview = reader.result;
        }
      },
      esconderForm(){
        this.equipe = {
            id: null,
            nome: null,
            brasao: null,
            fl_profissional: 1,
            atletas: []
        };
        this.imgPreview = null;
        this.showForm = false;
      }
  }
}
</script>
<style lang="scss" scoped>
.lista-equipes {
    transition-timing-function: ease-out;
    transition-duration: .6s;
}

.form-equipe {
    transition-timing-function: ease-in;
    transition-duration: .4s;
}

.my-fab {
    position: fixed !important;
    right: 40px;
    bottom: 20px;
}

.opaco {
    opacity: 0.5;
    pointer-events: none;
}

.equipe-card-header {
    display: flex;
    flex-direction: row;

    .info-equipe {
        flex: 3 0 0;
        img {
            margin-right: .5rem;
        }

        span {
        }
    }

    .acoes {
        flex: 1 0 0 ;
        align-self: flex-start;
    }

    .flecha-collapse {
        flex: 1 0 0;
    }
    
}

label {
  color: #ffd600 !important;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    left: 47%;
    position: relative;
}

.loader-lixeira {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    left: 5px;
    position: relative; 
}

.remove-brasao {
    font-size: 25px;
}

.nav-pills .nav-item .nav-link {
    padding: 0;
}

.card-atletas {
    .nav-link {
        width: 30px;
        img {
            border-radius: 80px;
        }
    }
    button {
        align-self: center;
    }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>


