<template>
    <v-slide-y-transition mode="out-in">
        <v-layout column justify-center>
            <div class="text-xs-center">
                <v-progress-circular
                    v-show="loading"
                    :size="200"
                    color="primary"
                    indeterminate
                    style="top: 150px"
                ></v-progress-circular>
            </div>
            <modal-equipe
               :equipe="equipe"
               icon="edit"
            >
            </modal-equipe>
            <div v-show="!loading">
                <v-subheader v-if="equipes.length > 0">Equipes</v-subheader>
                <v-subheader v-else>Você ainda não possui nenhuma equipe cadastrada!</v-subheader>
                <v-expansion-panel popout>
                    <equipe
                        v-for="(c, i) in equipes"
                        :key="i"
                        :equipe="c"
                    >
                    </equipe>
                </v-expansion-panel>
            </div>
            <v-snackbar
                v-model="snackbar"
                :bottom="true"
                :multi-line="true"
                :right="true"
                :timeout="7000"
                >
                {{ textoResponse }}
                <v-btn
                    color="pink"
                    flat
                    @click="snackbar = false"
                >
                    Fechar
                </v-btn>
            </v-snackbar>
        </v-layout>
    </v-slide-y-transition>
</template>
<script>
import Equipe from './Equipe'
import ModalEquipe from './ModalEquipe'
export default {
    name: 'Equipes',
    components: {
        'equipe': Equipe,
        'modal-equipe': ModalEquipe
    },
    created(){
        this.$bus.$on('excluir-equipe', this.excluirEquipe);
        this.$bus.$on('update:equipe', this.salvarEquipe);
    },
    beforeDestroy() {
        this.$bus.$off('excluir-equipe');
        this.$bus.$off('update:equipe');
    },
    mounted(){
        this.getEquipes();
    },
    data () {
        return {
            equipes: [],
            equipe: {
                id: null,
                nome: null,
                brasao: null,
                criador_id: null,
                fl_profissional: null
            },
            loading: false,
            snackbar: false,
            textoResponse: null
        }
    },
    methods: {
        salvarEquipe(equipe){
            this.loading = true;
            this.equipe = equipe;
            const fd = new FormData();
            fd.append('nome', this.equipe.nome);
            fd.append('brasao', this.equipe.brasao, this.equipe.brasao.nome);
            fd.append('fl_profissional', this.equipe.fl_profissional ? 1 : 0);
            fd.append('criador_id', 1);
            fd.append('atletas', this.equipe.atletas);
            if(this.equipe.id){
                // Edita a equipe
                fd.append('_method', 'put');
                console.log("EDITAR EQUIPEEEEEEEE");
                axios.post('equipes/'+this.equipe.id, fd)
                    .then(
                        (response) => {
                            this.loading = false;
                            this.textoResponse = response.data.message;
                            this.snackbar = true;
                            this.getEquipes();
                        },
                        (error) => {
                            this.loading = false
                            console.log(error)
                        }
                    )
            }else{
                // Cria uma nova equipe
                console.log("CRIARRRR EQUIPEEEEEEEE");
                axios.post('equipes', fd)
                    .then(
                        (response) => {
                            console.log(response);
                            this.loading = false;
                            this.textoResponse = response.data.message;
                            this.snackbar = true;
                            this.getEquipes();
                        },
                        (error) => {
                            this.loading = false;
                            console.log(error);
                        }
                    )
            }
            this.equipe = {};
        },
        excluirEquipe(id){
            this.loading = true;
            axios.delete('equipes/'+id)
                .then(
                    (response) => {
                        this.loading = false;
                        this.textoResponse = response.data.message;
                        this.snackbar = true;
                        this.getEquipes();
                    },
                    (error) => {
                        this.loading = false;
                        console.log(error);
                        this.getEquipes();
                    }
                )
                .catch((response) => {
                    console.log(response);
                    this.getEquipes();
                })
        },
        getEquipes(){
            this.loading = true;
            axios.get('equipes')
                .then(
                    (response) => {
                        this.equipes = response.data;
                        this.loading = false;
                    },
                    (error) => {
                        console.log(error);
                        this.loading = false;
                    }
                )
        }
    }
}
</script>
<style scoped>
</style>
