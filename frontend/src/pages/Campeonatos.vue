<template>
    <div class="container">
        <div class="row">
          <div :class="{'col-md-4 opaco': showForm, 'col-md-12': !showForm}" 
          class="col mr-auto ml-auto lista-campeonatos">
            <div class="wizard-container">
              <div class="card card-header" data-color="primary">
                <div class="card-header text-center">
                  <h3 class="card-title">Meus Campeonatos</h3>
                  <h5 class="description">Veja detalhes de todos os campeonatos cadastrados.</h5>
                </div>
                <div class="card-body">
                  <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                    <div class="card card-plain" v-for="(camp, index) in campeonatos" :key="camp.id">
                      <div class="card-header campeonato-card-header" id="headingOne">
                          <div class="info-campeonato">
                              <img :src="'http://localhost:8000/storage/'+camp.brasao"
                              width="80px" height="80px" style="border-radius: 50%">
                              <span>{{camp.desc}}</span>
                          </div>
                          <div class="acoes">
                              <button class="btn btn-icon btn-simple btn-info" 
                              title="Editar">
                                  <a href="javascript:void(0)" 
                                  @click="editarCampeonato(camp)"
                                  >
                                      <i class="tim-icons icon-pencil text-info"></i>
                                  </a>
                              </button>
                              <button @click="deletarCampeonato(camp)" class="btn btn-icon btn-simple btn-danger" 
                              title="Excluir">
                                  <div v-if="camp.excluindo" class="loader-lixeira"></div>
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
                          <div class="card-body">
                            <ul class="nav nav-pills nav-pills-primary">
                              <li class="nav-item" v-for="equipe in camp.equipes" :key="equipe.id">
                                <a class="nav-link active" href="javascript:void(0)" style="width: 30px">
                                  <img :src="'http://localhost:8000/storage/'+equipe.brasao" alt="">
                                </a>
                              </li>
                            </ul>
                          </div>
                      </b-collapse>
                    </div>
                  </div>
                  <button v-if="!showForm" 
                    class="btn btn-lg btn-round btn-primary btn-icon float-right my-fab" 
                    title="Adicionar Campeonato"
                    @click="showForm = true"
                    >
                        <a href="javascript:void(0)">
                            <i class="tim-icons icon-simple-add" style="color: #FFF"></i>
                        </a>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div v-show="showForm" class="col col md-8 form-campeonato">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12" v-if="!camp.brasao">
                            <label for="brasao">Brasão</label>
                            <input type="file" class="form-control" id="brasao" 
                            @change="onBrasaoChange"
                            placeholder="Brasão" :disabled="loading">
                        </div>
                        <div class="col col-md-12" v-if="camp.brasao">
                            <img v-if="typeof(camp.brasao) == 'file' || !imgPreview" 
                            :src="'http://localhost:8000/storage/'+camp.brasao"
                            width="80px" height="80px" style="border-radius: 50%">
                            <img v-else :src="imgPreview"
                            width="80px" height="80px" style="border-radius: 50%">
                            <a href="javascript:void(0)" @click="camp.brasao = null;imgPreview = null">
                                <i class="tim-icons icon-simple-remove remove-brasao"></i>
                            </a>
                        </div>
                        <div class="col col-md-6 mt-2">
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input type="text" class="form-control" id="titulo" 
                                v-model="camp.titulo"
                                placeholder="Titulo do campeonato" :disabled="loading">
                            </div>
                        </div>
                        <div class="col col-md-6 my-2">
                            <div class="form-group">
                                <label for="desc">Descrição</label>
                                <input type="text" class="form-control" id="desc" 
                                v-model="camp.desc"
                                placeholder="Descrição do campeonato" :disabled="loading">
                            </div>
                        </div>
                        <div class="col col-md-6">
                          <b-form-group label-class="label-radio" label="O campeonato é profissional?">
                            <b-form-radio-group v-model="camp.fl_profissional"
                                              :options="options"
                                              name="radioProfissional">
                            </b-form-radio-group>
                          </b-form-group>
                        </div>
                        <div class="col col-md-6">
                          <b-form-group label-class="label-radio" label="O campeonato é público?">
                            <b-form-radio-group v-model="camp.fl_publico"
                                              :options="options"
                                              name="radioPublico">
                            </b-form-radio-group>
                          </b-form-group>
                        </div>
                        <button class="btn btn-primary btn-block" 
                        @click="salvarCampeonato()" :disabled="loading">
                            <span v-if="!loading">
                                {{camp.id ? 'Editar' :'Cadastrar'}} Campeonato
                            </span>
                            <div v-if="loading" class="loader"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Organizador',
    mounted(){
      this.getCampeonatos();
    },
    data(){
      return {
        campeonatos: [],
        camp: {
            id: null,
            titulo: null,
            // data_inicio: null,
            // data_fim: null,
            desc: null,
            brasao: null,
            // criador_id: null,
            fl_publico: 1,
            fl_profissional: 1,
            equipes: null
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
      getCampeonatos(){
        axios.get("campeonatos")
          .then(
            response => {
              this.campeonatos = response.data;
              console.log(this.campeonatos);
            },
            error => console.error(error)
          );
      },
      salvarCampeonato(){
        this.loading = true;
        const fd = new FormData();
        fd.append('titulo', this.camp.titulo);
        fd.append('desc', this.camp.desc);
        fd.append('brasao', this.camp.brasao, this.camp.brasao.nome);
        fd.append('fl_profissional', this.camp.fl_profissional ? 1 : 0);
        fd.append('fl_publico', this.camp.fl_publico ? 1 : 0);
        fd.append('data_inicio', '2018-12-01');
        fd.append('data_fim', '2019-01-01');
        fd.append('criador_id', 3);
        if(this.camp.id){
            // Edita o campeonato
            // fd.append('equipes', this.campeonato.equipes);
            fd.append('_method', 'put');
            axios.post('campeonatos/'+this.camp.id, fd)
                .then(
                    (response) => {
                      this.getCampeonatos();
                      this.loading = false;
                      this.$notify({type: 'success', message: 'Campeonato editado com sucesso!'});
                      this.esconderForm();
                    },
                    (error) => {
                      this.getCampeonatos();
                      this.esconderForm();
                      this.loading = false;
                      this.$notify({type: 'danger', 
                      message: 'Não foi possível editar o campeonato :('});
                    }
                )
        }else{
            // Cria um novo campeonato
            axios.post('campeonatos', fd)
                .then(
                    (response) => {
                      this.getCampeonatos();
                      this.loading = false;
                      this.$notify({type: 'success', message: 'Campeonato cadastrado com sucesso!'});
                      this.esconderForm();
                    },
                    (error) => {
                      this.getCampeonatos();
                      this.loading = false;
                      this.$notify({type: 'danger', 
                      message: 'Não foi possível cadastrar o campeonato :('});
                      this.esconderForm();
                    }
                )
        }
      },
      editarCampeonato(camp){
        this.showForm = true;
        this.camp = Object.assign({}, camp);
      },
      deletarCampeonato(camp){
        camp.excluindo = true;
        this.loading = true;
        axios.delete('campeonatos/'+camp.id)
            .then(
                (response) => {
                  delete camp.excluindo;
                  this.loading = false;
                  this.$notify({type: 'success', message: 'Campeonato deletado com sucesso!'});
                  this.getCampeonatos();
                },
                (error) => {
                  delete camp.excluindo;
                  this.loading = false;
                  this.$notify({type: 'danger', 
                  message: 'Não foi possível deletar o campeonato :('});
                  this.getCampeonatos();
                }
            )
            .catch((response) => {
              delete camp.excluindo;
              this.$notify({type: 'danger', 
              message: 'Houve algum problema no servidor, contate o administrador e'+
              'verifique sua conexão com a internet!'});
              this.getCampeonatos();
            })
      },
      onBrasaoChange(){
        this.camp.brasao = event.target.files[0];
        this.previewBrasao(this.camp.brasao);
      },
      previewBrasao(foto) {
        let reader = new FileReader();
        reader.readAsDataURL(foto);
        reader.onloadend = () => {
            this.imgPreview = reader.result;
        }
      },
      esconderForm(){
        this.camp = {
          id: null,
          titulo: null,
          // data_inicio: null,
          // data_fim: null,
          desc: null,
          brasao: null,
          // criador_id: null,
          fl_publico: 1,
          fl_profissional: 1,
          equipes: null
        };
        this.imgPreview = null;
        this.showForm = false;
      }
  }
}
</script>
<style lang="scss" scoped>
.lista-campeonatos {
    transition-timing-function: ease-out;
    transition-duration: .6s;
}

.form-campeonato {
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

.campeonato-card-header {
    display: flex;
    flex-direction: row;

    .info-campeonato {
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

