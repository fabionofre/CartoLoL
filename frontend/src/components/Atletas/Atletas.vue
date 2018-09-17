<template>
    <v-slide-y-transition mode="out-in">
        <v-layout column justify-center>
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
                                    <v-layout row>
                                        <v-flex xs5>
                                        <img
                                            style="margin-left: 2%"
                                            :src="a.foto"
                                            height="150px"
                                            contain
                                        >
                                        </v-flex>
                                        <v-flex xs7>
                                        <v-card-title primary-title>
                                            <div>
                                            <div class="headline">{{a.nome}} "{{a.apelido}}" {{a.sobrenome}}</div>
                                            <div>Mid-laner</div>
                                            <div>{{a.data_nascimento}}</div>
                                            </div>
                                        </v-card-title>
                                        </v-flex>
                                    </v-layout>
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
    mounted(){
        this.$bus.$on('update:atleta', this.salvarAtleta)
        this.getAtletas()
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
            this.loading = true
            this.atleta = atleta
            if(this.atleta.id){
                // Edita o campeonato
                console.log(this.atleta)
                axios.put('atletas/'+this.atletas.id, this.atleta)
                    .then(
                        (response) => {
                            console.log(response)
                            this.loading = false
                            this.textoResponse = response.data.message
                            this.snackbar = true
                            this.getAtletas()
                        },
                        (error) => {
                            this.loading = false
                            console.log(error)
                        }
                    )
            }else{
                // Cria um novo atleta
                this.atletas.push(this.atleta)
                let atle = this.atleta
                atle.criador_id = 1
                axios.post('atletas', atle)
                    .then(
                        (response) => {
                            console.log(response)
                            this.loading = false
                            this.textoResponse = response.data.message
                            this.snackbar = true
                            this.getAtletas()
                        },
                        (error) => {
                            this.loading = false
                            console.log(error)
                        }
                    )
            }
            this.atleta = {}
        },
        getAtletas(){
            axios.get('atletas')
                .then(
                    (response) => {
                        console.log(response)
                        this.atletas = response.data
                        this.loading = false
                    },
                    (err) => {
                        console.log(error)
                        this.loading = false
                    }
                )
        }
    }
}
</script>
<style scoped>

</style>

