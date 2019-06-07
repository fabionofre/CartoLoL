<template>
    <div>
        <div class="container" v-if="!detalhesLigaActive">
            <div class="row">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" @click="activeTodasLigas()"
                        href="javascript:void(0)"
                        :class="{active: !minhasLigasTab && !ligasParticipoTab}"
                        >Todas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="activeMinhasLigas()"
                        href="javascript:void(0)"
                        :class="{active: minhasLigasTab}"
                        >Minhas Ligas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="activeLigasParticipo()"
                        href="javascript:void(0)"
                        :class="{active: !minhasLigasTab && ligasParticipoTab}"
                        >Ligas que Participo</a>
                    </li>
                </ul>
                <div v-show="showForm" class="col col-md-12 form-ligas">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-12" v-if="!liga.brasao">
                                    <label for="brasao">Brasão</label>
                                    <input type="file" class="form-control" id="brasao" 
                                    @change="onBrasaoChange"
                                    placeholder="Brasão" :disabled="loading">
                                </div>
                                <div class="col col-md-12 text-center" v-if="liga.brasao">
                                    <img v-if="typeof(liga.brasao) == 'file' || !imgPreview" 
                                    :src="'http://192.168.3.102:8000/storage/'+liga.brasao"
                                    width="80px" height="80px" style="border-radius: 50%">
                                    <img v-else :src="imgPreview"
                                    width="80px" height="80px" style="border-radius: 50%">
                                    <a href="javascript:void(0)" @click="liga.brasao = null;imgPreview = null">
                                        <i class="tim-icons icon-simple-remove remove-brasao"></i>
                                    </a>
                                </div>
                                <div class="col col-md-6 mb-3">
                                    <label>Campeonato</label>
                                    <cool-select
                                    v-if="!liga.campeonato"
                                    v-model="liga.campeonato"
                                    :items="campeonatos"
                                    item-text="titulo"
                                    >
                                        <template
                                        slot="item"
                                        slot-scope="{ item: campeonato }"
                                        >
                                            <div style="display: flex; align-items: center;">
                                                <img
                                                :src="'http://192.168.3.102:8000/storage/'+campeonato.brasao"
                                                class="campeonato-brasao"
                                                >

                                                <div>
                                                    <b>{{ campeonato.desc }}&nbsp;</b>
                                                </div>
                                            </div>
                                        </template>
                                        <template
                                        slot="selection"
                                        slot-scope="{ item: campeonato }"
                                        >
                                            <img
                                            :src="'http://192.168.3.102:8000/storage/'+campeonato.brasao"
                                            class="campeonato-brasao"
                                            >
                                            <div class="color-white">
                                                <div>
                                                    <b>{{ campeonato.titulo }}&nbsp;</b>
                                                </div>
                                            </div>
                                        </template>
                                        <template
                                        slot="no-data"
                                        >
                                            <b>Nenhum campeonato foi encontrado com esse título :(</b>
                                        </template>
                                    </cool-select>
                                    <div v-if="liga.campeonato">
                                        <img
                                        :src="'http://192.168.3.102:8000/storage/'+liga.campeonato.brasao"
                                        class="possui-campeonato-brasao"
                                        >
                                        <a href="javascript:void(0)" @click="liga.campeonato = null">
                                            <i class="tim-icons icon-simple-remove remove-brasao"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="desc">Descrição</label>
                                        <input type="text" class="form-control" id="desc" 
                                        v-model="liga.desc"
                                        placeholder="Descrição da liga" :disabled="loading">
                                    </div>
                                </div>
                                <button @click="salvarLiga()" class="btn btn-primary btn-block mt-4" 
                                :disabled="loading">
                                    <span v-if="!loading">
                                        {{liga.id ? 'Editar' :'Cadastrar'}} Liga
                                    </span>
                                    <div v-if="loading" class="loader"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 lista-ligas">
                    <div class="card" v-if="ligas.length > 0">
                        <div class="card-header">
                            <h3 class="card-title">Ligas</h3>
                            <h5 class="description">Todas as ligas cadastradas!</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Brasão</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Campeonato</th>
                                        <th scope="col">Criador</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="liga in ligas" 
                                    :key="liga.id" style="color: #fff">
                                        <td>
                                            <img
                                            :src="'http://192.168.3.102:8000/storage/'+liga.brasao"
                                            class="liga-brasao"
                                            >  
                                        </td>
                                        <th>{{liga.desc}}</th>
                                        <th>{{liga.campeonato.titulo}}</th>
                                        <th>{{liga.criador.email}}</th>
                                        <td>
                                            <div class="table-acoes">
                                                <a @click="editarLiga(liga)" title="Editar" 
                                                href="javascript:void(0)"
                                                v-if="liga.criador.id == user.id"
                                                >
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                                <a @click="excluirLiga(liga)" title="Excluir" 
                                                href="javascript:void(0)"
                                                v-if="liga.criador.id == user.id"
                                                >
                                                    <div v-if="liga.excluindo" class="loader-lixeira"></div>
                                                    <i v-else class="fa fa-trash"></i>
                                                </a>
                                                <a @click="participarDaLiga(liga)" title="Participar" 
                                                href="javascript:void(0)"
                                                style="margin-right: 10px;font-size: 16px;"
                                                >
                                                    <div v-if="liga.participando" class="loader-lixeira"></div>
                                                    <i v-else class="tim-icons icon-controller"></i>
                                                </a>
                                                <a @click="mostrarDetalhesLiga(liga)" 
                                                title="Detalhes" href="javascript:void(0)">
                                                    <i class="tim-icons icon-alert-circle-exc"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h3 v-else-if="!showForm && !minhasLigasTab">
                        Não há nenhuma liga cadastrada em nossa base dados!
                    </h3>
                    <h3 v-else-if="!showForm">
                        Você não possui nenhuma liga cadastrada!
                    </h3>
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
        <div class="container" v-else>
            <div class="row">
                <a href="javascript:void(0)" @click="detalhesLigaActive = false;resetForm();">
                    <i class="tim-icons icon-minimal-left" style="font-size: 30px;"></i>
                </a>
                <div class="col col-md-7">
                    <div class="card" v-if="liga.participantes.length > 0">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Colocação</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Pontos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(invocador, key) in liga.participantes" 
                                    :key="invocador.id" style="color: #fff">
                                        <th>
                                            {{key+1}}º
                                        </th>
                                        <td>
                                            <img
                                            :src="'http://192.168.3.102:8000/storage/'+invocador.foto"
                                            class="liga-brasao"
                                            >  
                                        </td>
                                        <th>{{invocador.email}}</th>
                                        <th>
                                            <div v-if="invocador.calculando" 
                                            class="loader-lixeira"></div>
                                            <span v-else>{{invocador.escalacao.pontos}}</span>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h3 v-else>Esta liga não possui nenhum participante :(</h3>
                </div>
                <div class="col col-md-4">
                    <div class="card" style="border-radius: 20px;text-align: center">
                        <div class="card-body">
                            <img
                            style="border-radius: 100px"
                            width="200px"
                            height="200px"
                            :src="'http://192.168.3.102:8000/storage/'+liga.brasao"
                            > 
                            <h1 class="mt-3" style="text-align: center">{{liga.desc}}</h1>
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
    name: 'Ligas',
    components: { CoolSelect },
    mounted(){
        this.getUser();
        this.getCampeonatos();
        this.getLigas(1);
        this.getRegrasPontuacao();
        this.getInfoRodada();
    },
    created(){
      if(!(this.user) && this.$auth.isAuthenticated()){
        this.user = this.$auth.getUser();
      }
    },
    data(){
        return {
            ligas: [],
            showForm: false,
            loading: false,
            liga: {
                id: null,
                desc: null,
                campeonato_id: null,
                criador_id: 1,
                brasao: null,
                participantes: []
            },
            campeonatos: [],
            imgPreview: null,
            minhasLigasTab: false,
            todasLigas: [],
            minhasLigas: [],
            detalhesLigaActive: false,
            acoes: [],
            ligasParticipo: [],
            ligasParticipoTab: false
        }
    },
    methods: {
        resetForm(){
            this.liga = {
                id: null,
                desc: null,
                campeonato: null,
                criador_id: 1,
                brasao: null
            }
        },
        getLigas(activeTodasLigas){
            this.loading = true;
            this.ligas = [];
            axios.get("ligas")
                .then(
                    response => {
                        console.log(response);
                        this.todasLigas = response.data;
                        this.minhasLigas = response.data.filter(l => this.user.id == l.criador_id);
                        this.ligasParticipo = this.user.ligas_participo;
                        if(activeTodasLigas == 1)
                            this.activeTodasLigas();
                        else if(activeTodasLigas == 2)
                            this.activeLigasParticipo();
                        else
                            this.activeMinhasLigas();
                        this.loading = false;
                    },
                    error => {
                        console.error(error)
                        this.loading = false;
                    }
                );
        },
        salvarLiga(){
            this.loading = true;
            const fd = new FormData();
            fd.append('brasao', this.liga.brasao, this.liga.brasao.name);
            fd.append('desc', this.liga.desc);
            fd.append('campeonato_id', this.liga.campeonato.id);
            fd.append('criador_id', this.user.id);
            if(this.liga.id){
                // Edita a liga
                fd.append('_method', 'put');
                axios.post('ligas/'+this.liga.id, fd)
                    .then(
                        (response) => {
                            if(!this.minhasLigasTab)
                                this.getLigas(1);
                            else if(!this.ligasParticipoTab)
                                this.getLigas(2);
                            else
                                this.getLigas();
                            this.loading = false;
                            this.$notify({type: 'success', 
                            message: 'Liga editada com sucesso!'});
                            this.showForm = false;
                            this.resetForm();
                        },
                        (error) => {
                            this.getLigas();
                            this.resetForm();
                            this.loading = false;
                            this.showForm = false;
                            this.$notify({type: 'danger', 
                            message: 'Não foi possível editar a liga :('});
                        }
                    )
            }else{
                axios.post("ligas", fd)
                    .then(
                        response => {
                            console.log(response);
                            this.resetForm();
                            this.loading = false;
                            this.showForm = false;
                            this.$notify({type: 'success', message: 'Liga cadastrada com sucesso!'});
                            if(!this.minhasLigasTab)
                                this.getLigas(1);
                            else
                                this.getLigas();
                        },
                        error => {
                            console.error(error);
                            this.resetForm();
                            this.loading = false;
                            this.showForm = false;
                            this.$notify({type: 'danger', message: 'Não foi possível cadastrar a liga :('});
                            if(!this.minhasLigasTab)
                                this.getLigas(1);
                            else
                                this.getLigas();
                        }
                    )
            }
        },
        getCampeonatos(){
            axios.get("campeonatos")
                .then(
                    response => {
                        this.campeonatos = response.data;
                    },
                    error => console.error(error)
                );
        },
        onBrasaoChange(){
            this.liga.brasao = event.target.files[0];
            this.previewBrasao(this.liga.brasao);
        },
        previewBrasao(foto) {
            let reader = new FileReader();
            reader.readAsDataURL(foto);
            reader.onloadend = () => {
                this.imgPreview = reader.result;
            }
        },
        editarLiga(liga){
            this.showForm = true;
            this.liga = Object.assign({}, liga);
        },
        excluirLiga(liga){
            liga.excluindo = true;
            this.loading = true;
            axios.delete('ligas/'+liga.id)
                .then(
                    (response) => {
                        delete liga.excluindo;
                        this.loading = false;
                        this.$notify({type: 'success', message: 'Liga deletada com sucesso!'});
                        if(!this.minhasLigasTab)
                            this.getLigas(1);
                        else
                            this.getLigas();
                    },
                    (error) => {
                        delete liga.excluindo;
                        this.loading = false;
                        this.$notify({type: 'danger', 
                        message: 'Não foi possível deletar a liga :('});
                        if(!this.minhasLigasTab)
                            this.getLigas(1);
                        else
                            this.getLigas();
                    }
                )
                .catch((response) => {
                    delete liga.excluindo;
                    this.$notify({type: 'danger', 
                    message: 'Houve algum problema no servidor, contate o administrador e'+
                    'verifique sua conexão com a internet!'});
                    if(!this.minhasLigasTab)
                        this.getLigas(1);
                    else
                        this.getLigas();
                })
        },
        activeMinhasLigas(){
            this.ligas = this.minhasLigas;
            this.minhasLigasTab = true;
            this.ligasParticipoTab = false;
        },
        activeTodasLigas(){
            this.ligas = this.todasLigas;
            this.minhasLigasTab = false;
            this.ligasParticipoTab = false;
        },
        activeLigasParticipo(){
            this.ligas = this.ligasParticipo;
            this.minhasLigasTab = false;
            this.ligasParticipoTab = true;
        },
        mostrarDetalhesLiga(liga){
            this.liga = liga;
            this.detalhesLigaActive = true;
            this.liga.participantes.map(p => p.escalacao = {
                topo: null, meio: null, cacador: null,
                atirador: null, suporte: null
            });
            this.liga.participantes.map(p => this.minhaEscalacao(p));
        },
        participarDaLiga(liga){
            liga.participando = true;
            this.loading = true;
            let params = {
                liga_id: liga.id,
                invocador_id: this.user.id
            };
            axios.post("participantes-liga", params)
                .then(
                    response => {
                        delete liga.participando;
                        this.$notify({type: 'success', message: 'Você agora participa da liga '+liga.desc});
                        if(!this.minhasLigasTab)
                            this.getLigas(1);
                        else
                            this.getLigas();
                    },
                    error => {
                        console.error(error);
                    }
                ).catch(error => {
                    delete liga.participando;
                    this.$notify({type: 'danger', message: 'Você já participa desta liga! '+liga.desc});
                });
        },
        getRegrasPontuacao(){
            axios.get("regras-pontuacao?campeonato_id=1")
                .then(
                    response => {
                        this.acoes = response.data;
                    },
                    error => console.error(error)
                );
        },
        getInfoRodada(){
            axios.get("campeonatos/1")
            .then(
            response => {
                this.rodada_atual = response.data.rodada_atual;
            },
            error => console.error(error)
            );
        },
        getUser(){
            axios.get("usuarios/"+this.user.id)
            .then((response) => {
                this.user = response.data;
            },
            error => console.error(error)
            )
        },
        minhaEscalacao(invocador){
            invocador.calculando = true;
            axios.get("escalacoes/"+invocador.id)
                .then(
                    (response) => {
                        console.log(response);
                        if(!response.data){
                            this.loading_fullscreen = false;
                            return null;
                        };
                            
                        invocador.escalacao.topo = response.data.topo;
                        invocador.escalacao.meio = response.data.meio;
                        invocador.escalacao.cacador = response.data.cacador;
                        invocador.escalacao.atirador = response.data.atirador;
                        invocador.escalacao.suporte = response.data.suporte;
                        axios.get('pontuacoes')
                            .then(
                            response => {
                                const pontuacoes = response.data;
                                let atletasAcoes = [];
                                _.forEach(pontuacoes, p => {
                                    let atleta = p.atleta;
                                    atletasAcoes.push(atleta);
                                });
                                atletasAcoes = _.uniqBy(atletasAcoes, 'id');
                                atletasAcoes.map(a => a.pontos = 0);
                                _.forEach(pontuacoes, p => {
                                let atleta_id = p.atleta.id;
                                    _.forEach(atletasAcoes, a => {
                                        if(atleta_id == a.id){
                                        // Dá os pontos aqui!
                                        let acao = _.find(this.acoes, acao => {
                                            return acao.acao_id == p.acao_id
                                        });
                                        if(acao)
                                            a.pontos += (acao.pontuacao * p.quantidade);               
                                        }
                                    });
                                });
                                invocador.escalacao.pontos = 0;
                                let topo = _.find(atletasAcoes, a => invocador.escalacao.topo.id == a.id);
                                if(topo){
                                    invocador.escalacao.pontos += topo.pontos;
                                }
                                let meio = _.find(atletasAcoes, a => invocador.escalacao.meio.id == a.id);
                                if(meio){
                                    invocador.escalacao.pontos += meio.pontos;
                                }
                                let cacador = _.find(atletasAcoes, a => invocador.escalacao.cacador.id == a.id);
                                if(cacador){
                                    invocador.escalacao.pontos += cacador.pontos;
                                }
                                let suporte = _.find(atletasAcoes, a => invocador.escalacao.suporte.id == a.id);
                                if(suporte){
                                    invocador.escalacao.pontos += suporte.pontos;
                                }
                                let atirador = _.find(atletasAcoes, a => invocador.escalacao.atirador.id == a.id);
                                if(atirador){
                                    invocador.escalacao.pontos += atirador.pontos;
                                }
                                delete invocador.calculando;
                                this.liga.participantes =  _.orderBy(this.liga.participantes, p => {
                                    return p.escalacao.pontos;
                                } ,['desc']);  
                                this.$forceUpdate();
                            }),
                            (error) => {
                                console.error(error);
                            }
                    })
        },
    }
}
</script>
<style lang="scss" scoped>
.lista-ligas {
    transition-timing-function: ease-out;
    transition-duration: .6s;
}

.form-ligas {
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

.campeonato-brasao {
    max-width: 30px;
    margin-right: 10px;
    border: 1px solid #eaecf0;
}

.liga-brasao {
    max-width: 30px;
    margin-right: 10px;
    border-radius: 50px;
}

.color-white {
    color: rgba(255, 255, 255, 0.8) !important;
}

.table-acoes {
    display: flex;
    flex-direction: row;

    .fa-trash {
        font-size: 14px;
        margin: 0 10px;
        color: #EB240C;
    }

    .icon-pencil {
        font-size: 15px;
        color: #24D5AA;
    }

    .icon-alert-circle-exc {
        font-size: 20px;
        color: #4169E1;
    }

}

.remove-brasao {
    font-size: 25px;
}

.possui-campeonato-brasao {
    max-width: 60px;
    margin-right: 10px;
}

.loader-lixeira {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
    position: relative; 
    margin: 0 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

