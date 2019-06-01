<template>
    <div class="container">
        <div class="row">
            <div v-show="showForm" class="col col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="num_rodada">Número da Rodada</label>
                                    <input type="number" min="1" class="form-control" id="num_rodada" 
                                    v-model="rodada.num_rodada"
                                    placeholder="Número da rodada..." :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" 
                                    v-model="rodada.descricao"
                                    placeholder="Descrição da rodada..." :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-12 mt-3">
                                <button class="btn btn-primary btn-block" 
                                @click="salvarRodada()" :disabled="loading">
                                    <span v-if="!loading">
                                        {{rodada.id ? 'Editar' :'Cadastrar'}} Rodada
                                    </span>
                                    <div v-if="loading" class="loader"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="rodadas.length > 0" class="row">
          <div :class="{'opaco': showForm, 'col-md-12': !showForm}" 
          class="col mr-auto ml-auto lista-rodadas">
            <div class="wizard-container">
              <div class="card card-header" data-color="primary">
                <div class="card-header text-center">
                  <h3 class="card-title">Minhas Rodadas</h3>
                  <h5 class="description">Veja detalhes de todas as rodadas cadastradas.</h5>
                </div>
                <div class="card-body">
                  <div id="accordion" role="tablist" aria-multiselectable="true"  class="card-collapse">
                    <div class="card card-plain" v-for="(r, index) in rodadas" :key="r.id">
                      <div class="card-header rodada-card-header" id="headingOne">
                            <div class="info-rodada">
                                <span>Rodada de Número: {{r.num_rodada}} - {{r.descricao}}</span>
                            </div>
                            <div class="acoes">
                                <button class="btn btn-icon btn-simple btn-info" 
                                title="Editar">
                                    <a href="javascript:void(0)" 
                                    @click="editarRodada(r)"
                                    >
                                        <i class="tim-icons icon-pencil text-info"></i>
                                    </a>
                                </button>
                                <button @click="deletarRodada(r)" class="btn btn-icon btn-simple btn-danger" 
                                title="Excluir">
                                    <div v-if="r.excluindo" class="loader-lixeira"></div>
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
                            <div class="card-body card-atletas d-flex">
                                <div class="confronto d-flex align-items-center" v-for="confronto in r.partidas" :key="confronto.id">
                                    <div class="container-brasao">
                                        <img
                                        :src="'http://192.168.3.105:8000/storage/'+confronto.timea.brasao"
                                        class="possui-equipe-brasao"
                                        >
                                    </div>
                                    <span class="mx-3">VS</span>
                                    <div class="container-brasao">
                                        <img
                                        :src="'http://192.168.3.105:8000/storage/'+confronto.timeb.brasao"
                                        class="possui-equipe-brasao"
                                        >
                                    </div>
                                    <a href="javascript:void(0)" class="remove-confronto" @click="deletarPartida(confronto)">
                                        <i class="tim-icons icon-simple-remove"></i>
                                    </a>
                                </div>
                                <button @click="abrirModalPartidas(r)" class="btn btn-round btn-primary btn-lg btn-icon ml-5" 
                                title="Adicionar Confronto">
                                    <a href="javascript:void(0)">
                                        <i class="tim-icons icon-simple-add" style="color: #FFF"></i>
                                    </a>
                                </button>
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
            <h3>Você ainda não cadastrou nenhuma rodada!</h3>
        </div>
        <button v-if="!showForm" 
        class="btn btn-lg btn-round btn-primary btn-icon float-right my-fab" 
        title="Adicionar Rodada"
        @click="showForm = true"
        >
            <a href="javascript:void(0)">
                <i class="tim-icons icon-simple-add" style="color: #FFF"></i>
            </a>
        </button>
        <b-modal id="escolher-partidas" v-model="modalPartidas" title="Crie as partidas desta rodada!" cancel-title="Cancelar" 
            @cancel="handleCancelar()">
            <div class="row mt-3">
                <div class="col col-md-5 col-lg-5 mb-3">
                    <label>Equipe A</label>
                    <cool-select
                    v-if="!partida.equipea"
                    v-model="partida.equipea"
                    :items="equipes"
                    item-text="nome"
                    >
                        <template
                        slot="item"
                        slot-scope="{ item: equipe }"
                        >
                            <div style="display: flex; align-items: center;">
                                <img
                                :src="'http://192.168.3.105:8000/storage/'+equipe.brasao"
                                class="equipe-brasao"
                                >

                                <div>
                                    <b>{{ equipe.nome }}</b>
                                </div>
                            </div>
                        </template>
                        <template
                        slot="selection"
                        slot-scope="{ item: equipe }"
                        >
                        <img
                        :src="'http://192.168.3.105:8000/storage/'+equipe.brasao"
                        class="equipe-brasao"
                        >
                        <div class="color-white">
                            <b>{{ equipe.nome }}</b>
                        </div>
                        </template>
                        <template
                        slot="no-data"
                        >
                            <b>Nenhuma equipe foi encontrada com esse nome :(</b>
                        </template>
                    </cool-select>
                    <div v-if="partida.equipea">
                        <img
                        :src="'http://192.168.3.105:8000/storage/'+partida.equipea.brasao"
                        class="possui-equipe-brasao"
                        >
                        <a href="javascript:void(0)" @click="partida.equipea = null">
                            <i class="tim-icons icon-simple-remove remove-foto"></i>
                        </a>
                    </div>
                </div>
                <div class="col col-md-2 col-lg-2 pt-4 pl-4">
                    VS
                </div>
                <div class="col col-md-5 col-lg-5 mb-3">
                    <label>Equipe B</label>
                    <cool-select
                    v-if="!partida.equipeb"
                    v-model="partida.equipeb"
                    :items="equipes"
                    item-text="nome"
                    >
                        <template
                        slot="item"
                        slot-scope="{ item: equipe }"
                        >
                            <div style="display: flex; align-items: center;">
                                <img
                                :src="'http://192.168.3.105:8000/storage/'+equipe.brasao"
                                class="equipe-brasao"
                                >

                                <div>
                                    <b>{{ equipe.nome }}</b>
                                </div>
                            </div>
                        </template>
                        <template
                        slot="selection"
                        slot-scope="{ item: equipe }"
                        >
                        <img
                        :src="'http://192.168.3.105:8000/storage/'+equipe.brasao"
                        class="equipe-brasao"
                        >
                        <div class="color-white">
                            <b>{{ equipe.nome }}</b>
                        </div>
                        </template>
                        <template
                        slot="no-data"
                        >
                            <b>Nenhuma equipe foi encontrada com esse nome :(</b>
                        </template>
                    </cool-select>
                    <div v-if="partida.equipeb">
                        <img
                        :src="'http://192.168.3.105:8000/storage/'+partida.equipeb.brasao"
                        class="possui-equipe-brasao"
                        >
                        <a href="javascript:void(0)" @click="partida.equipeb = null">
                            <i class="tim-icons icon-simple-remove remove-foto"></i>
                        </a>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" 
                @click="salvarPartida()" :disabled="loading">
                    <span v-if="!loading">
                        Cadastrar Partida
                    </span>
                    <div v-if="loading" class="loader"></div>
                </button>
            </div>
            <div slot="modal-footer"></div>
        </b-modal>
    </div>
</template>
<script>
import { CoolSelect } from 'vue-cool-select'
export default {
    components: { CoolSelect },
    mounted(){
        this.getRodadas();
        this.getEquipes();
    },
    data(){
        return {
            rodada: {
                id: null,
                num_rodada: null,
                descricao: null,
            },
            loading: false,
            showForm: false,
            rodadas: [],
            modalPartidas: false,
            partida: {},
            equipes: []
        }
    },
    methods: {
        getRodadas(){
            axios.get("rodadas")
            .then(
                response => {
                    this.rodadas = response.data;
                    console.log(this.rodadas);
                },
                error => console.error(error)
            );
        },
        editarRodada(rodada){
            this.showForm = true;
            this.rodada = Object.assign({}, rodada);
        },
        deletarRodada(rodada){
            rodada.excluindo = true;
            this.loading = true;
            axios.delete('rodadas/'+rodada.id)
                .then(
                    (response) => {
                        delete rodada.excluindo;
                        this.loading = false;
                        this.$notify({type: 'success', message: 'Rodada deletada com sucesso!'});
                        this.getRodadas();
                    },
                    (error) => {
                        delete rodada.excluindo;
                        this.loading = false;
                        this.$notify({type: 'danger', 
                        message: 'Não foi possível deletar a rodada :('});
                        this.getRodadas();
                    }
                )
                .catch((response) => {
                    delete rodada.excluindo;
                    this.$notify({type: 'danger', 
                    message: 'Houve algum problema no servidor, contate o administrador e'+
                    'verifique sua conexão com a internet!'});
                    this.getRodadas();
                });
        },
        salvarRodada(){
            this.loading = true;
            const fd = new FormData();
            fd.append('num_rodada', this.rodada.num_rodada);
            fd.append('descricao', this.rodada.descricao);
            if(this.rodada.id){
                // Edita a rodada
                fd.append('_method', 'put');
                axios.post('rodadas/'+this.rodada.id, fd)
                    .then(
                        (response) => {
                            this.getRodadas();
                            this.loading = false;
                            this.$notify({type: 'success', message: 'Rodada editada com sucesso!'});
                            this.esconderForm();
                        },
                        (error) => {
                            this.getRodadas();
                            this.esconderForm();
                            this.loading = false;
                            this.$notify({type: 'danger', 
                            message: 'Não foi possível editar a rodada :('});
                        }
                    )
            }else{
                // Cria uma nova rodada
                axios.post('rodadas', fd)
                    .then(
                        (response) => {
                            this.getRodadas();
                            this.loading = false;
                            this.$notify({type: 'success', message: 'Rodada cadastrada com sucesso!'});
                            this.esconderForm();
                        },
                        (error) => {
                            this.getRodadas();
                            this.loading = false;
                            this.$notify({type: 'danger', 
                            message: 'Não foi possível cadastrar a rodada :('});
                            this.esconderForm();
                        }
                    )
            }
        },
        esconderForm(){
            this.rodada = {
                id: null,
                num_rodada: null,
                descricao: null,
            };
            this.showForm = false;
        },
        abrirModalPartidas(rodada){
            this.modalPartidas = true;
            this.partida = {};
            this.partida.rodada_id = rodada.id;
            this.getPartidas();
        },
        getPartidas(){

        },
        getEquipes(){
            axios.get("equipes?s=")
                .then(
                    response => {
                        this.equipes = response.data;
                    },
                    error => console.error(error)
                );
        },
        salvarPartida(){
            this.loading = true;
            const fd = new FormData();
            fd.append('rodada_id', this.partida.rodada_id);
            fd.append('timea_id', this.partida.equipea.id);
            fd.append('timeb_id', this.partida.equipeb.id);
            axios.post('partidas', fd)
                .then(
                    (response) => {
                        this.getRodadas();
                        this.loading = false;
                        this.$notify({type: 'success', message: 'Partida cadastrada com sucesso!'});
                        this.modalPartidas = false;
                    },
                    (error) => {
                        this.getRodadas();
                        this.loading = false;
                        this.$notify({type: 'danger', 
                        message: 'Não foi possível cadastrar a partida :('});
                        this.modalPartidas = false;
                    }
            )
        },
        deletarPartida(partida){
            this.loading = true;
            axios.delete('partidas/'+partida.id)
                .then(
                    (response) => {
                        this.loading = false;
                        this.$notify({type: 'success', message: 'Partida deletada com sucesso!'});
                        this.getRodadas();
                    },
                    (error) => {
                        this.loading = false;
                        this.$notify({type: 'danger', 
                        message: 'Não foi possível deletar a partida :('});
                        this.getRodadas();
                    }
                )
                .catch((response) => {
                    this.$notify({type: 'danger', 
                    message: 'Houve algum problema no servidor, contate o administrador e'+
                    'verifique sua conexão com a internet!'});
                    this.getRodadas();
                });
        }
    }
}
</script>
<style lang="scss" scoped>

.rodada-card-header {
    display: flex;
    flex-direction: row;
    align-items: center;

    .info-rodada {
        flex: 1 0 0;
        img {
            margin-right: .5rem;
        }

        span {
        }
        
    }

    .flecha-collapse {
        flex: 1 0 0;
    }

}

.my-fab {
    position: fixed !important;
    right: 40px;
    bottom: 20px;
}

.equipe-brasao {
    max-width: 30px;
    margin-right: 10px;
    border: 1px solid #eaecf0;
}

.possui-equipe-brasao {
    max-width: 60px;
    margin-right: 10px;
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

.confronto {
    background:gray;
    padding: 15px;
    border-radius: 20px;
    margin-right: 30px;
}

.remove-confronto {
    margin-bottom: auto;
    margin-top: -15px;
    margin-right: -10px;
    font-size: 25px;
    margin-left: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>