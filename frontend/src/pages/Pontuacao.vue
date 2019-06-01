<template>
    <div class="container">
        <div class="row">
            <div v-if="pontuacoes.length > 0"  :class="{'col-md-4': showForm, 'col-md-12': !showForm}" class="lista-pontuacao">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ações</h3>
                        <h5 class="description">Ações já atribuídas para os jogadores desta rodada!</h5>
                    </div>
                    <div class="card-body">
                        <b-table striped hover :items="pontuacoes" :fields="fields"></b-table>
                    </div>
                </div>
            </div>
            <h3 v-else-if="!showForm">Não há nenhuma pontuação atribuída em nossa base dados!</h3>
            <div v-show="showForm" class="col col md-8 form-pontuacao">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12 mb-3">
                                <label>Atleta</label>
                                <cool-select
                                v-model="pontuacao.atleta"
                                :items="atletas"
                                item-text="nome"
                                >
                                    <template
                                    slot="item"
                                    slot-scope="{ item: atleta }"
                                    >
                                        <div style="display: flex; align-items: center;">
                                            <img
                                            :src="'http://192.168.3.105:8000/storage/'+atleta.foto"
                                            class="atleta-foto"
                                            >

                                            <div>
                                                <span>{{ atleta.nome }}&nbsp;</span>
                                                <b>{{ atleta.apelido }}&nbsp;</b>
                                                <span>{{ atleta.sobrenome }}</span>
                                            </div>
                                        </div>
                                    </template>
                                    <template
                                    slot="selection"
                                    slot-scope="{ item: atleta }"
                                    >
                                        <img
                                        :src="'http://192.168.3.105:8000/storage/'+atleta.foto"
                                        class="atleta-foto"
                                        >
                                        <div class="color-white">
                                            <div>
                                                <span>{{ atleta.nome }}&nbsp;</span>
                                                <b>{{ atleta.apelido }}&nbsp;</b>
                                                <span>{{ atleta.sobrenome }}</span>
                                            </div>
                                        </div>
                                    </template>
                                    <template
                                    slot="no-data"
                                    >
                                        <b>Nenhum atleta foi encontrado com esse nome :(</b>
                                    </template>
                                </cool-select>
                            </div>
                            <div class="col col-md-6 mb-2">
                                    <label for="acao">Ação</label>
                                    <cool-select
                                    v-model="pontuacao.acao"
                                    :items="acoes"
                                    item-text="descricao"
                                    :placeholder="pontuacao.acao ? 'selecionada': 'Selecione a ação'"
                                    >
                                    <template
                                    slot="selection"
                                    slot-scope="{ item: acao }"
                                    >
                                        <div class="color-white">
                                            <div>
                                                <span>{{ acao.descricao }}&nbsp;</span>
                                            </div>
                                        </div>
                                    </template>
                                    <template
                                    slot="no-data"
                                    >
                                        <b>Nenhuma ação encontrada com esse nome :(</b>
                                    </template>
                                    </cool-select>
                            </div>
                            <div class="col col-md-6" v-if="pontuacao.acao">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" class="form-control" id="quantidade" 
                                    v-model="pontuacao.quantidade"
                                    :placeholder="'Vezes que '+pontuacao.atleta.apelido+
                                    ' executou a ação '+pontuacao.acao.descricao" :disabled="loading">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" 
                            @click="salvarPontuacao()" :disabled="loading">
                                <span v-if="!loading">
                                    {{pontuacao.id ? 'Editar' :'Atribuir'}} Pontuação
                                </span>
                                <div v-if="loading" class="loader"></div>
                            </button>
                        </div>
                    </div>
                </div>
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
</template>
<script>
import { CoolSelect } from 'vue-cool-select'
export default {
    name: 'Pontuacao',
    components: { CoolSelect },
    mounted(){
        this.getAtletas();
        this.getPontuacoes();
    },
    data(){
        return {
            fields: ["id", "apelido", "acao", "quantidade"],
            pontuacoes: [],
            showForm: false,
            loading: false,
            pontuacao: {
                id: null,
                atleta: null,
                acao: null,
                quantidade: null
            },
            atletas: [],
            acoes: [
                {id: 1, "descricao":"Abate"},
                {id: 2, "descricao":"Assistência"},
                {id: 3, "descricao":"Ward"},
                {id: 4, "descricao":"Torre"},
                {id: 5, "descricao":"Inibidor"},
                {id: 6, "descricao":"Primeiro Abate"},
                {id: 7, "descricao":"Primeira Torre"},
                {id: 8, "descricao":"Morte"},
                {id: 9, "descricao":"Vitória"},
                {id: 10, "descricao":"Farm"},
                {id: 11, "descricao":"Dano"},
                {id: 12, "descricao":"Dano Recebido"},
            ]
        }
    },
    methods: {
        salvarPontuacao(){
            this.loading = true;
            let params = {
                quantidade: this.pontuacao.quantidade,
                atleta_id: this.pontuacao.atleta.id,
                acao_id: this.pontuacao.acao.id
            };
            axios.post("pontuacoes", params)
                .then(
                    response => {
                        console.log(response);
                        this.resetForm();
                        this.loading = false;
                        this.showForm = false;
                        this.$notify({type: 'success', message: 'Ação cadastrada com sucesso!'});
                        this.getPontuacoes();
                    },
                    error => {
                        console.error(error);
                        this.resetForm();
                        this.loading = false;
                        this.showForm = false;
                        this.$notify({type: 'danger', message: 'Não foi possível cadastrar a ação :('});
                        this.getPontuacoes();
                    }
                )
        },
        getAtletas(){
            axios.get("atletas")
                .then(
                    response => {
                        console.log(response);
                        this.atletas = response.data;
                    },
                    error => console.error(error)
                );
        },
        resetForm(){
            this.pontuacao = {
                id: null,
                atleta: null,
                acao: null,
                quantidade: null
            }
        },
        getPontuacoes(){
            this.pontuacoes = [];
            axios.get("pontuacoes")
                .then(
                    response => {
                        console.log(response);
                        const pontuacoes = response.data;
                        _.forEach(pontuacoes, p => {
                            const pontuacao = {
                                id: p.id,
                                apelido: p.atleta.apelido,
                                acao: _.find(this.acoes, a => a.id === p.acao_id).descricao,
                                quantidade: p.quantidade,
                            };
                            this.pontuacoes.push(pontuacao);
                        });
                    },
                    error => console.error(error)
                );
        }
    }
}
</script>
<style lang="scss" scoped>
.lista-pontuacao {
    transition-timing-function: ease-out;
    transition-duration: .6s;
}

.form-pontuacao {
    transition-timing-function: ease-in;
    transition-duration: .4s;
}

.my-fab {
    position: fixed !important;
    right: 40px;
    bottom: 20px;
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

.atleta-foto {
    max-width: 30px;
    margin-right: 10px;
    border: 1px solid #eaecf0;
}

.color-white {
    color: rgba(255, 255, 255, 0.8) !important;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

