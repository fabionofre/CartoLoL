<template>
    <div class="container">
        <div class="row">
          <div class="col-md-10 mr-auto ml-auto">
            <div class="wizard-container">
              <div class="card card-header" data-color="primary">
                <div class="card-header text-center">
                  <h3 class="card-title">Meus Campeonatos</h3>
                  <h5 class="description">Veja detalhes de todos os campeonatos cadastrados.</h5>
                </div>
                <div class="card-body">
                  <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                    <div class="card card-plain" v-for="(camp, index) in campeonatos" :key="camp.id">
                      <div class="card-header" id="headingOne">
                        <a href="javascript:void(0)" data-toggle="collapse" 
                        v-b-toggle="'collapse'+index">
                          {{camp.titulo}}
                          <i class="tim-icons icon-minimal-down"></i><br/>
                          <span class="text-muted">{{camp.desc}}</span><br/>
                          <span class="text-muted">De {{camp.data_inicio}} até {{camp.data_fim}}</span>
                        </a>
                      </div>
                      <b-collapse :id="'collapse'+index">
                          <div class="card-body">
                            <!-- <div class="text-right">
                              <button class="btn btn-icon btn-simple btn-info" title="Editar">
                                <a href="javascript:void(0)">
                                <i class="tim-icons icon-pencil text-info"></i></a>

                              </button>
                              <button class="btn btn-icon btn-simple btn-danger" title="Excluir">
                                <i class="fa fa-trash"></i>
                              </button>
                            </div> -->
                            <ul class="nav nav-pills nav-pills-primary">
                              <li class="nav-item" v-for="equipe in camp.equipes" :key="equipe.id">
                                <a class="nav-link active" href="javascript:void(0)" style="width: 30px">
                                  <img :src="'http://localhost:8000/storage/'+equipe.brasao" alt="">
                                </a>
                              </li>
                              <!-- <li class="nav-item">
                                <button class="btn btn-lg btn-round btn-secondary btn-icon" 
                                title="Adicionar Equipe"
                                style="margin-top: -5px">
                                  <a href="javascript:void(0)" style="width: 30px">
                                    <i class="tim-icons icon-simple-add" style="color: #FFF"></i>
                                  </a>
                                </button>
                              </li> -->
                            </ul>
                            <div class="tab-content tab-space">
                              <div class="tab-pane active" id="link1">
                                <!-- Footer do card -->
                              </div>
                            </div>
                          </div>
                      </b-collapse>
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
    name: 'Organizador',
    mounted(){
      this.getCampeonatos();
    },
    data(){
      return {
        campeonatos: []
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
      }
    }
}
</script>
<style lang="scss" scoped>

</style>

