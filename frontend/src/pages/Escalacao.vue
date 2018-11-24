<template>
    <div class="container">
        <div v-if="loading_fullscreen" class="loader-fullscreen"></div>
        <div class="row" v-if="!loading_fullscreen">
            <div class="col col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="mapa">
                            <img src="../assets/img/mapa.png">
                            <button :disabled="loading_escalacao || escalacao.topo" class="btn btn-round btn-lg btn-icon topo" @click="escalarJogador('topo')" v-b-modal.escolher-jogador>
                                <img v-if="!escalacao.topo" src="../assets/img/topo.png">
                                <i class="tim-icons icon-check-2" v-if="escalacao.topo"></i>
                                <a><i class="tim-icons icon-simple-add"></i></a>
                            </button>
                            <button :disabled="loading_escalacao || escalacao.meio"  class="btn btn-round btn-lg btn-icon meio" @click="escalarJogador('meio')" v-b-modal.escolher-jogador>
                                <img v-if="!escalacao.meio" src="../assets/img/mid.png">
                                <i class="tim-icons icon-check-2" v-if="escalacao.meio"></i>
                                <a><i class="tim-icons icon-simple-add"></i></a>
                            </button>
                            <button :disabled="loading_escalacao || escalacao.cacador"  class="btn btn-round btn-lg btn-icon cacador" @click="escalarJogador('cacador')" v-b-modal.escolher-jogador>
                                <img v-if="!escalacao.cacador" src="../assets/img/cacador.png">
                                <i class="tim-icons icon-check-2" v-if="escalacao.cacador"></i>
                                <a><i class="tim-icons icon-simple-add"></i></a>
                            </button>
                            <button :disabled="loading_escalacao || escalacao.atirador"  class="btn btn-round btn-lg btn-icon atirador"  @click="escalarJogador('atirador')" v-b-modal.escolher-jogador>
                                <img v-if="!escalacao.atirador" src="../assets/img/atirador1.png">
                                <i class="tim-icons icon-check-2" v-if="escalacao.atirador"></i>
                                <a><i class="tim-icons icon-simple-add"></i></a>
                            </button>
                            <button :disabled="loading_escalacao || escalacao.suporte"  class="btn btn-round btn-lg btn-icon suporte" @click="escalarJogador('suporte')" v-b-modal.escolher-jogador>
                                <img v-if="!escalacao.suporte" src="../assets/img/suporte.png">
                                <i class="tim-icons icon-check-2" v-if="escalacao.suporte"></i>
                                <a><i class="tim-icons icon-simple-add"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-5" 
            v-if="escalacao.meio || escalacao.topo || escalacao.cacador || escalacao.atirador
            || escalacao.suporte">
                <div class="card">
                    <div class="card-body card-jogadores">
                        <div class="row" v-if="escalacao.topo">
                            <div class="col col-md-2">
                                <img class="foto-role-jogador mt-2" src="../assets/img/topo.png">
                            </div>
                            <div class="col col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-jogador">
                                            <img class="foto" 
                                            :src="'http://localhost:8000/storage/'+escalacao.topo.foto">
                                            <span class="nome">
                                                {{escalacao.topo.nome +" '"+ 
                                                escalacao.topo.apelido +"' "+
                                                escalacao.topo.sobrenome}}
                                            </span>
                                            <a href="javascript:void(0)" @click="desescalarAtleta('topo')"><i class="tim-icons icon-simple-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="escalacao.meio">
                            <div class="col col-md-2">
                                <img class="foto-role-jogador mt-2" src="../assets/img/mid.png">
                            </div>
                            <div class="col col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-jogador">
                                            <img class="foto"
                                            :src="'http://localhost:8000/storage/'+escalacao.meio.foto">
                                            <span class="nome">
                                                {{escalacao.meio.nome +" '"+ 
                                                escalacao.meio.apelido +"' "+
                                                escalacao.meio.sobrenome}}
                                            </span>
                                            <a href="javascript:void(0)" @click="desescalarAtleta('meio')"><i class="tim-icons icon-simple-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="escalacao.cacador">
                            <div class="col col-md-2">
                                <img class="foto-role-jogador mt-2" src="../assets/img/cacador.png">
                            </div>
                            <div class="col col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-jogador">
                                            <img class="foto" 
                                            :src="'http://localhost:8000/storage/'+escalacao.cacador.foto">
                                            <span class="nome">
                                                {{escalacao.cacador.nome +" '"+ 
                                                escalacao.cacador.apelido +"' "+
                                                escalacao.cacador.sobrenome}}
                                            </span>
                                            <a href="javascript:void(0)" @click="desescalarAtleta('cacador')"><i class="tim-icons icon-simple-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="escalacao.suporte">
                            <div class="col col-md-2">
                                <img class="foto-role-jogador mt-2" src="../assets/img/suporte.png">
                            </div>
                            <div class="col col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-jogador">
                                            <img class="foto" 
                                            :src="'http://localhost:8000/storage/'+escalacao.suporte.foto">
                                            <span class="nome">
                                                {{escalacao.suporte.nome +" '"+ 
                                                escalacao.suporte.apelido +"' "+
                                                escalacao.suporte.sobrenome}}
                                            </span>
                                            <a href="javascript:void(0)" @click="desescalarAtleta('suporte')"><i class="tim-icons icon-simple-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="escalacao.atirador">
                            <div class="col col-md-2">
                                <img class="foto-role-jogador mt-2" src="../assets/img/atirador1.png">
                            </div>
                            <div class="col col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-jogador">
                                            <img class="foto" 
                                            :src="'http://localhost:8000/storage/'+escalacao.atirador.foto">
                                            <span class="nome">
                                                {{escalacao.atirador.nome +" '"+ 
                                                escalacao.atirador.apelido +"' "+
                                                escalacao.atirador.sobrenome}}
                                            </span>
                                            <a href="javascript:void(0)" @click="desescalarAtleta('atirador')"><i class="tim-icons icon-simple-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <button class="btn btn-primary btn-block" 
                                @click="confirmarEscalacao()"
                                :disabled="!(escalacao.meio && escalacao.topo &&
                                escalacao.cacador && escalacao.atirador
                                && escalacao.suporte) || loading_escalacao"
                                >
                                    <span v-if="!loading_escalacao">Confirmar Escalação!</span>
                                    <div v-if="loading_escalacao" class="loader"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <b-modal id="escolher-jogador" ref="modal" :title="'Escale o '+modal_role+'!'" cancel-title="Cancelar" 
        @cancel="handleCancelar()">
            <div class="my-3">
                <div class="row my-1">
                    <div class="col offset-md-1 col-md-10">
                        <form @submit.prevent="getAtletas()">
                            <input class="zleague-form-control" type="search" placeholder="Busque o atlelta por nome e tecle enter!"
                             v-model="search">
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col col-md-4" v-for="atleta in atletas" :key="atleta.id" 
                    @click="escalarAtleta(atleta)">
                        <div class="card card-modal">
                            <div class="card-body">
                                <div class="info-jogador info-modal">
                                    <img class="foto" :src="'http://localhost:8000/storage/'+atleta.foto">
                                    <span class="nome">                                                    
                                        {{atleta.nome +" '"+ atleta.apelido +"' "+atleta.sobrenome}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div slot="modal-footer"></div>
        </b-modal>
    </div>
</template>
<script>
export default {
    name: 'escalacao',
    data(){
        return {
            modal_role: null,
            atletas: [],
            search: '',
            escalacao: {
                topo: null,
                meio: null,
                cacador: null,
                atirador: null,
                suporte: null
            },
            loading_escalacao: false,
            loading_fullscreen: false
        }
    },
    mounted(){
        this.minhaEscalacao();
        this.getAtletas();
    },
    methods: {
        escalarJogador(role){
            this.modal_role = role;
        },
        handleCancelar(){
        },
        getAtletas(){
            axios.get("atletas?s="+this.search)
                .then(
                    (response) => {
                        this.atletas = response.data;
                    },
                    (error) => console.error(error)
                );
        },
        escalarAtleta(atleta){
            if(this.modal_role == 'meio')
                this.escalacao.meio = atleta;
            else if(this.modal_role == 'topo')
                this.escalacao.topo = atleta;
            else if(this.modal_role == 'cacador')
                this.escalacao.cacador = atleta;
            else if(this.modal_role == 'atirador')
                this.escalacao.atirador = atleta;
            else
                this.escalacao.suporte = atleta;
            console.log(this.escalacao);
            this.$notify({type: 'success', message: atleta.apelido+' selecionado!'});
            this.$refs.modal.hide();
        },
        desescalarAtleta(role){
            if(role == 'meio')
                this.escalacao.meio = null;
            else if(role == 'topo')
                this.escalacao.topo = null;
            else if(role == 'cacador')
                this.escalacao.cacador = null;
            else if(role == 'atirador')
                this.escalacao.atirador = null;
            else
                this.escalacao.suporte = null;

            this.$notify({type: 'warning', message: 'Atleta removido da escalação!'});
        },
        confirmarEscalacao(){
            this.loading_escalacao = true;
            const escalacao = {
                invocador_id: this.$auth.getUser().id,
                meio_id: this.escalacao.meio.id,
                topo_id: this.escalacao.topo.id,
                cacador_id: this.escalacao.cacador.id,
                atirador_id: this.escalacao.atirador.id,
                suporte_id: this.escalacao.suporte.id
            }
            axios.post("escalacoes", escalacao)
                .then(
                    (response) => {
                        this.loading_escalacao = false;
                        this.$notify({type: 'success', message: 'Time escalado com sucesso!'});
                    },
                    (error) => {
                        this.loading_escalacao = false;
                        this.$notify({type: 'danger', message: 'Não foi possível escalar o seu time!'});
                    }
                );
        },
        minhaEscalacao(){
            this.loading_fullscreen = true;
            let primeiro_response;
            axios.get("escalacoes/"+this.$auth.getUser().id)
                .then(
                    (response) => {

                        if(!response.data){
                            this.loading_fullscreen = false;
                            return null;
                        }
                            
                        let primeiro_response = response;
                        axios.get("atletas/"+primeiro_response.data.topo_id)
                            .then(response => {
                                this.escalacao.topo = response.data;
                                axios.get("atletas/"+primeiro_response.data.meio_id)
                                    .then(response => {
                                        this.escalacao.meio = response.data;
                                        axios.get("atletas/"+primeiro_response.data.cacador_id)
                                            .then(response => {
                                                this.escalacao.cacador = response.data;
                                                axios.get("atletas/"+primeiro_response.data.atirador_id)
                                                    .then(response => {
                                                        this.escalacao.atirador = response.data;
                                                        axios.get("atletas/"+primeiro_response.data.suporte_id)
                                                            .then(response => {
                                                                this.escalacao.suporte = response.data;
                                                                this.loading_fullscreen = false;
                                                            });
                                                    });
                                            });
                                    });
                            });
                    },
                    (error) => {
                        console.error(error);
                    }
                )
        }
    }
}
</script>
<style lang="scss" scoped>
.mapa {
    button {
        position: absolute;
        &:hover{
            > img {
                opacity: 0;
                transition-timing-function: ease-out;
                transition-duration: .2s;
            }
            > a {
                opacity: 1;
                transition-timing-function: ease-in;
                transition-duration: .3s;
            }
        }

        img {
            width: 40px;
        }

        a {
            font-size: 20px;
            opacity: 0;
        }

        i {
            font-size: 30px !important;
            color: #24D5AA;
        }
    }
}

.topo {
    top: 70px;
    left: 80px;
}

.meio {
    top: 260px;
    left: 240px;
}

.atirador {
    bottom: 70px;
    right: 80px;
}

.suporte {
    bottom: 40px;
    right: 140px;
}

.treinador {
    top: 15px;
    left: 20px;
}

.cacador {
    left: 270px;
    bottom: 130px;
}

.card-jogadores {
    .card {
        background: #FFFFFF;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
}

.info-jogador {
    display: flex;
    flex-direction: row;
    .foto {
        width: 50px;
        height: 50px;
        border-radius: 20px;
    }

    .nome {
        flex: 1 0 0;
        align-self: center;
        text-align: center;
        padding-left: 10px;
    }

    a {
        align-self: flex-start;
        font-size: 30px;
    }

    &.info-modal{
        display: flex;
        flex-direction: column;
        color: #FFFF;

        .foto {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            align-self: center;
        }

    }

}

.foto-role-jogador{
    max-width: none;
    width: 50px;
}

.zleague-form-control {
    width: 100%;
    background: #FFFFFF;
    border: 1px solid #DCDCDC;
    box-sizing: border-box;
    border-radius: 3px;
}

.card-modal {
    cursor: pointer;
    transition-timing-function: ease-in;
    transition-duration: .3s;
    opacity: 0.9;

    &:hover {
        height: 200px;
        box-shadow: 20px 20px 40px 0px rgba(0,0,0,0.5);
        opacity: 1;
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

.loader-fullscreen {
    border: 20px solid #f3f3f3;
    border-top: 20px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 350px;
    height: 350px;
    left: 30%;
    animation: spin 2s linear infinite;
    position: relative;  
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


</style>