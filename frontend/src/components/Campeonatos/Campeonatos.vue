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
            <modal-campeonato
               :campeonato="campeonato"
               v-on:update:campeonato="salvarCampeonato"
               icon="edit"
            >
            </modal-campeonato>
            <div v-show="!loading">
                <v-subheader v-if="campeonatos.length > 0">Meus Campeonatos</v-subheader>
                <v-subheader v-else>Você ainda não possui nenhum campeonato cadastrado, invocador!</v-subheader>
                <v-expansion-panel popout>
                    <campeonato
                        v-for="(c, i) in campeonatos"
                        :key="i"
                        :campeonato="c"
                    >
                    </campeonato>
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
import axios from 'axios'
import Campeonato from './Campeonato'
import ModalCampeonato from './ModalCampeonato'
export default {
    name: 'Campeonatos',
    components: {
        'campeonato': Campeonato,
        'modal-campeonato': ModalCampeonato
    },
    mounted(){
        this.$bus.$on('excluir-campeonato', this.excluirCampeonato)
        this.getCampeonatos()
    },
    data () {
        return {
            campeonatos: [],
            campeonato: {
                id: null,
                titulo: null,
                data_inicio: null,
                data_fim: null,
                desc: null,
                brasao: null,
                criador_id: null,
                fl_publico: null,
                fl_profissional: null
            },
            loading: false,
            snackbar: false,
            textoResponse: null
        }
    },
    methods: {
        salvarCampeonato(campeonato){
            this.loading = true
            this.campeonato = campeonato
            if(this.campeonato.id){
                // Edita o campeonato
                console.log(this.campeonato)
                axios.put('http://127.0.0.1:8000/api/campeonatos/'+this.campeonato.id, this.campeonato)
                    .then(
                        (response) => {
                            console.log(response)
                            this.loading = false
                            this.textoResponse = response.data.message
                            this.snackbar = true
                        },
                        (error) => {
                            this.loading = false
                            console.log(error)
                        }
                    )
            }else{
                // Cria um novo campeonato
                this.campeonatos.push(this.campeonato)
                let camp = this.campeonato
                camp.criador_id = 1
                axios.post('http://127.0.0.1:8000/api/campeonatos', camp)
                    .then(
                        (response) => {
                            console.log(response)
                            this.loading = false
                            this.textoResponse = response.data.message
                            this.snackbar = true
                            this.getCampeonatos()
                        },
                        (error) => {
                            this.loading = false
                            console.log(error)
                        }
                    )
            }
            this.campeonato = {}
        },
        excluirCampeonato(id){
            this.loading = true
            axios.delete('http://127.0.0.1:8000/api/campeonatos/'+id)
                .then(
                    (response) => {
                        console.log(response)
                        this.loading = false
                        this.textoResponse = response.data.message
                        this.snackbar = true
                        this.getCampeonatos()
                    },
                    (error) => {
                        this.loading = false
                        console.log(erro)
                    }
                )
        },
        getCampeonatos(){
            this.loading = true
            axios.get('http://127.0.0.1:8000/api/campeonatos')
                .then(
                    (response) => {
                        console.log(response)
                        this.campeonatos = response.data.data
                        this.loading = false
                    },
                    (error) => {
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
