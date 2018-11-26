<template>
    <div class="container">
        <div class="row">
            <div :class="{'col-md-4': showForm, 'col-md-12': !showForm, 'opaco': showForm}" 
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
                                    <div class="card-header" id="headingOne">
                                        <div class="photo">
                                            <img :src="'http://localhost:8000/storage/'+atleta.foto"
                                            width="80px" height="80px" style="border-radius: 50%">
                                            <a v-b-toggle="'collapse'+index" data-toggle="collapse" 
                                            href="javascript:void(0)">
                                                {{atleta.nome}} 
                                                <span class="text-primary">{{atleta.apelido}}</span> 
                                                {{atleta.sobrenome}}
                                                <i class="tim-icons icon-minimal-down"></i><br/>
                                            </a>
                                        </div>
                                    </div>
                                    <b-collapse :id="'collapse'+index">
                                        <div class="card-body">
                                            <span class="text-muted">{{atleta.data_nascimento}}</span><br/>
                                            <span class="text-muted">Z {{atleta.id * 47.5}}</span>
                                            <!-- <div class="text-right">
                                                <button class="btn btn-icon btn-simple btn-info" title="Editar">
                                                    <a href="editaCyberAtleta.html">
                                                        <i class="tim-icons icon-pencil text-info"></i></a>

                                                </button>
                                                <button class="btn btn-icon btn-simple btn-danger" title="Excluir"
                                                    onclick="demo.showSwal('warning-message-and-confirmation')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-icon btn-simple btn-success" title="Compartilhar">
                                                    <i class="fas fa-share-alt"></i>
                                                </button>
                                            </div> -->
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
            <div v-show="showForm" class="col col md-8 form-atleta">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" id="foto" 
                                @change="onFotoChange"
                                placeholder="foto" :disabled="loading">
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
                            <button class="btn btn-primary btn-block" 
                            @click="salvarAtleta()" :disabled="loading">
                                <span v-if="!loading">Cadastrar Atleta</span>
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
    name: 'Atletas',
    data(){
        return {
            atletas: [],
            atleta: {
                nome: null,
                apelido: null,
                sobrenome: null,
                foto: null,
                imgPreview: null
            },
            showForm: false,
            loading: null
        }
    },
    mounted(){
        this.getAtletas();
    },
    methods: {
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
        onFotoChange(event){
            this.atleta.foto = event.target.files[0];
            this.previewFoto(this.atleta.foto)
        },
        previewFoto(foto) {
            let reader = new FileReader();
            reader.readAsDataURL(foto);
            reader.onloadend = () => {
                this.imgPreview = reader.result;
            }
        },
        removerImagem(){
            this.atleta.foto = null;
            this.imgPreview = null;
        },
        salvarAtleta(){
            this.loading = true;
            const fd = new FormData();
            fd.append('foto', this.atleta.foto, this.atleta.foto.name);
            fd.append('nome', this.atleta.nome);
            fd.append('sobrenome', this.atleta.sobrenome);
            fd.append('apelido', this.atleta.apelido);
            fd.append('criador_id', 3);
            fd.append('data_nascimento', '1996-12-29');
            axios.post('atletas', fd)
                .then(
                    (response) => {
                        this.getAtletas();
                        this.loading = false;
                        console.log(response);
                        this.$notify({type: 'success', message: 'Atleta criado com sucesso!'});
                        this.atleta = {
                            nome: null,
                            apelido: null,
                            sobrenome: null,
                            foto: null,
                            imgPreview: null
                        };
                        this.showForm = false;
                    },
                    (error) => {
                        this.getAtletas();
                        this.loading = false;
                        console.error(error);
                        this.$notify({type: 'danger', message: 'Não foi possível cadastrar o atleta!'});
                        this.atleta = {
                            nome: null,
                            apelido: null,
                            sobrenome: null,
                            foto: null,
                            imgPreview: null
                        };
                        this.showForm = false;
                    }
                )
        }
    }
}
</script>
<style scoped lang="scss">
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

