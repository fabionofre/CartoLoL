<template>
    <div class="container">
        <div class="row">
            <div v-if="atletas.length > 0" 
            :class="{'col-md-4 opaco': showForm, 'col-md-12': !showForm}" 
            class="col mr-auto ml-auto lista-atletas">
                <div class="wizard-container">
                    <div class="card card-header" data-color="primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Cyber-Atletas</h3>
                            <h5 class="description">Veja detalhes de todos os Cyber-Atletas cadastrados.</h5>
                        </div>
                        <div class="card-body mt-4">
                            <div id="accordion" class="card-collapse">
                                <div class="card card-plain" v-for="(atleta, index) in atletas" :key="atleta.id">
                                    <div class="card-header atleta-card-header" id="headingOne">
                                        <div class="info-atleta">
                                            <img :src="'http://www.zleague.com.br:8000/storage/'+atleta.foto"
                                            width="80px" height="80px" style="border-radius: 50%">
                                            {{atleta.nome}} 
                                            <span class="text-primary">{{atleta.apelido}}</span> 
                                            {{atleta.sobrenome}}
                                        </div>
                                        <div class="acoes">
                                            <button class="btn btn-icon btn-simple btn-info" 
                                            title="Editar">
                                                <a href="javascript:void(0)" 
                                                @click="editarAtleta(atleta)">
                                                    <i class="tim-icons icon-pencil text-info"></i>
                                                </a>
                                            </button>
                                            <button @click="excluirAtleta(atleta)" class="btn btn-icon btn-simple btn-danger" 
                                            title="Excluir">
                                                <div v-if="atleta.excluindo" class="loader-lixeira"></div>
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
                                            <span class="text-muted">{{atleta.data_nascimento}}</span><br/>
                                            <span class="text-muted">Z {{atleta.id * 47.5}}</span>
                                            <!-- <ul class="nav nav-pills nav-pills-primary">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#link1">Informações
                                                    </a>
                                                </li>
                                            </ul> -->
                                            <!-- <div class="tab-content tab-space">
                                                <div class="tab-pane active" id="link1">
                                                    Geralmente atua como Suporte
                                                </div>
                                            </div> -->
                                        </div>
                                    </b-collapse>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="!showForm">
                <h3>Você ainda não cadastrou nenhum atleta!</h3>
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
            <div v-show="showForm" class="col col md-8 form-atleta">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12" v-if="!atleta.foto">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" id="foto" 
                                @change="onFotoChange"
                                placeholder="foto" :disabled="loading">
                            </div>
                            <div class="col col-md-12" v-if="atleta.foto">
                                <img v-if="typeof(atleta.foto) == 'file' || !imgPreview" 
                                :src="'http://www.zleague.com.br:8000/storage/'+atleta.foto"
                                width="80px" height="80px" style="border-radius: 50%">
                                <img v-else :src="imgPreview"
                                width="80px" height="80px" style="border-radius: 50%">
                                <a href="javascript:void(0)" @click="atleta.foto = null;imgPreview = null">
                                    <i class="tim-icons icon-simple-remove remove-foto"></i>
                                </a>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" 
                                    v-model="atleta.nome"
                                    placeholder="Nome do atleta" :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="apelido">Apelido</label>
                                    <input type="text" class="form-control" id="apelido" 
                                    v-model="atleta.apelido"
                                    placeholder="Apelido do atleta" :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="sobrenome">Sobrenome</label>
                                    <input type="text" class="form-control" id="sobrenome" 
                                    v-model="atleta.sobrenome"
                                    placeholder="Sobrenome do atleta" :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <label>Equipe</label>
                                <cool-select
                                v-if="!atleta.equipe"
                                v-model="atleta.equipe"
                                :items="equipes"
                                item-text="nome"
                                >
                                    <template
                                    slot="item"
                                    slot-scope="{ item: equipe }"
                                    >
                                        <div style="display: flex; align-items: center;">
                                            <img
                                            :src="'http://www.zleague.com.br:8000/storage/'+equipe.brasao"
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
                                    :src="'http://www.zleague.com.br:8000/storage/'+equipe.brasao"
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
                                <div v-if="atleta.equipe">
                                    <img
                                    :src="'http://www.zleague.com.br:8000/storage/'+atleta.equipe.brasao"
                                    class="possui-equipe-brasao"
                                    >
                                    <a href="javascript:void(0)" @click="atleta.equipe = null">
                                        <i class="tim-icons icon-simple-remove remove-foto"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group has-label col-md-6 mb-3" style="margin-left: -15px; display: inline-block; vertical-align: top">
                                <label>Função</label>
                                <select class="form-control" required v-model="atleta.funcao_id">
                                    <option disabled selected value="0">Selecione a Ação</option>
                                    <option v-for="opt in funcoes" :key="opt.id" :value="opt.id">{{opt.descricao}}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary btn-block" 
                            @click="salvarAtleta()" :disabled="loading">
                                <span v-if="!loading">
                                    {{atleta.id ? 'Editar' :'Cadastrar'}} Atleta
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
import { CoolSelect } from 'vue-cool-select'
export default {
    components: { CoolSelect },
    name: 'Atletas',
    data(){
        return {
            atletas: [],
            atleta: {
                nome: null,
                apelido: null,
                sobrenome: null,
                foto: null,
                equipe: null,
                funcao_id: null
            },
            showForm: false,
            loading: null,
            imgPreview: null,
            equipes: [],
            funcoes: [
                {
                    id: 1,
                    descricao: "Meio"
                },
                {
                    id: 2,
                    descricao: "Topo"
                },
                {
                    id: 3,
                    descricao: "Caçador"
                },
                {
                    id: 4,
                    descricao: "Atirador"
                },
                {
                    id: 5,
                    descricao: "Suporte"
                }
            ]
        }
    },
    mounted(){
        this.getAtletas();
        this.getEquipes();
    },
    methods: {
        getAtletas(){
            axios.get("atletas")
                .then(
                    response => {
                        this.atletas = response.data;
                    },
                    error => console.error(error)
                );
        },
        onFotoChange(event){
            this.atleta.foto = event.target.files[0];
            console.log(typeof(this.atleta.foto));
            this.previewFoto(this.atleta.foto);
        },
        previewFoto(foto) {
            let reader = new FileReader();
            reader.readAsDataURL(foto);
            reader.onloadend = () => {
                this.imgPreview = reader.result;
            }
        },
        salvarAtleta(){
            this.loading = true;
            const fd = new FormData();
            fd.append('foto', this.atleta.foto, this.atleta.foto.name);
            fd.append('nome', this.atleta.nome);
            fd.append('sobrenome', this.atleta.sobrenome);
            fd.append('apelido', this.atleta.apelido);
            fd.append('equipe_id', this.atleta.equipe.id);
            fd.append('criador_id', 1);
            fd.append('data_nascimento', '1996-12-29');
            fd.append('funcao_id', this.atleta.funcao_id);
            if(this.atleta.id){
                fd.append('_method', 'put');
                axios.post('atletas/'+this.atleta.id, fd)
                    .then(
                        (response) => {
                            this.getAtletas();
                            this.loading = false;
                            this.$notify({type: 'success', message: 'Atleta editado com sucesso!'});
                            this.esconderForm();
                        },
                        (error) => {
                            this.loading = false;
                            this.$notify({type: 'danger', 
                            message: 'Não foi possível editar o atleta!'});
                            console.log(error);
                            this.esconderForm();
                        }
                    )
            }else{
                axios.post('atletas', fd)
                    .then(
                        (response) => {
                            this.getAtletas();
                            this.loading = false;
                            console.log(response);
                            this.$notify({type: 'success', message: 'Atleta criado com sucesso!'});
                            this.esconderForm();
                        },
                        (error) => {
                            this.getAtletas();
                            this.loading = false;
                            console.error(error);
                            this.$notify({type: 'danger', 
                            message: 'Não foi possível cadastrar o atleta!'});
                            this.esconderForm();
                        }
                    )
            }
        },
        editarAtleta(atleta){
            this.showForm = true;
            this.atleta = Object.assign({}, atleta);
        },
        esconderForm(){
            this.atleta = {
                nome: null,
                apelido: null,
                sobrenome: null,
                foto: null,
            };
            this.imgPreview = null;
            this.showForm = false;
        },
        excluirAtleta(atleta){
            atleta.excluindo = true;
            this.loading = true;
            axios.delete('atletas/'+atleta.id)
                .then(
                    (response) => {
                        delete atleta.excluindo;
                        this.loading = false;
                        this.$notify({type: 'success', message: 'Atleta deletado com sucesso!'});
                        this.getAtletas();
                    },
                    (error) => {
                        delete atleta.excluindo;
                        this.loading = false;
                        this.$notify({type: 'danger', 
                        message: 'Não foi possível deletar o atleta :('});
                        this.getAtletas();
                    }
                )
                .catch((response) => {
                    delete atleta.excluindo;
                    this.$notify({type: 'danger', 
                    message: 'Houve algum problema no servidor, contate o administrador e'+
                    'verifique sua conexão com a internet!'});
                    this.getAtletas();
                })
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
    }
}
</script>
<style scoped lang="scss">
select.form-control {
    color: #8965e0;
}

.lista-atletas {
    transition-timing-function: ease-out;
    transition-duration: .6s;
}

.form-atleta {
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

.atleta-card-header {
    display: flex;
    flex-direction: row;

    .info-atleta {
        flex: 2 0 0;
        img {
            margin-right: .5rem;
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

.remove-foto {
    font-size: 25px;
}

label {
    color: #ffd600 !important; 
}

.color-white {
    color: rgba(255, 255, 255, 0.8) !important;
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

