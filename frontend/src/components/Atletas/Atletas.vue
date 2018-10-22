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
            <div v-show="!loading">
                <v-subheader v-if="atletas.length > 0">Meus Atletas</v-subheader>
                <v-subheader v-else>Você ainda não possui nenhum atleta cadastrado, invocador!</v-subheader>
                <v-card v-show="atletas.length > 0">
                    <v-container
                    fluid
                    grid-list-lg
                    >
                        <v-layout row wrap>
                            <v-flex xs4 v-for="a in atletas" :key="a.id">
                                <v-card color="blue-grey darken-2" class="white--text">
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <v-card-title class="ma-1" primary-title>
                                                <div class="headline atleta-titulo">
                                                    {{a.nome}}
                                                    <b style="border: 1px solid #000000;">{{a.apelido}}</b>
                                                    {{a.sobrenome}}
                                                </div>
                                            </v-card-title>
                                        </v-flex>
                                    </v-layout>
                                    <v-card-text>
                                        <v-layout row wrap>
                                            <v-flex xs12>
                                                <img
                                                style="margin-left: 2%"
                                                :src="'http://localhost:8000/storage/'+a.foto"
                                                height="150px"
                                                width="150px"
                                                contain
                                                >
                                            </v-flex>
                                            <v-flex xs12>
                                                {{a.data_nascimento}}
                                            </v-flex>
                                        </v-layout>

                                    </v-card-text>
                                    <v-divider light></v-divider>
                                    <v-card-actions class="pa-3">
                                        Desempenho
                                        <v-spacer></v-spacer>
                                        <v-icon>star</v-icon>
                                        <v-icon>star</v-icon>
                                        <v-icon>star</v-icon>
                                        <v-icon>star</v-icon>
                                        <v-icon>star_border</v-icon>
                                    </v-card-actions>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </div>
            <modal-atleta :atleta="atleta"></modal-atleta>
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
import ModalAtleta from './ModalAtleta'
export default {
    name: 'Atletas',
    components: {
        'modal-atleta': ModalAtleta
    },
    created(){
        this.$bus.$on('update:atleta', this.salvarAtleta);
    },
    mounted(){
        this.getAtletas();
    },
    data(){
        return {
            atletas: [],
            atleta: {},
            loading: false,
            snackbar: false,
            textoResponse: null
        }
    },
    methods: {
        salvarAtleta(atleta){
            this.loading = true;
            this.atleta = atleta;
            if(this.atleta.id){
                // Edita o atleta
                axios.put('atletas/'+this.atleta.id, this.atleta)
                    .then(
                        (response) => {
                            this.loading = false;
                            this.textoResponse = response.data.message;
                            this.snackbar = true;
                            this.getAtletas();
                        },
                        (error) => {
                            this.loading = false;
                            console.log(error);
                        }
                    )
            }else{
                // Cria um novo atleta
                const fd = new FormData();
                fd.append('foto', this.atleta.foto, this.atleta.foto.name);
                fd.append('nome', this.atleta.nome);
                fd.append('sobrenome', this.atleta.sobrenome);
                fd.append('apelido', this.atleta.apelido);
                fd.append('criador_id', 1);
                fd.append('data_nascimento', this.atleta.data_nascimento);
                axios.post('atletas', fd)
                    .then(
                        (response) => {
                            this.loading = false;
                            this.textoResponse = response.data.message;
                            this.snackbar = true;
                            this.getAtletas();
                        },
                        (error) => {
                            this.loading = false;
                            console.log(error);
                        }
                    )
            }
            this.atleta = {}
        },
        getAtletas(){
            this.loading = true
            axios.get('atletas')
                .then(
                    (response) => {
                        this.atletas = response.data;
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

