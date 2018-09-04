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
                <v-subheader>Meus Campeonatos</v-subheader>
                <v-expansion-panel popout>
                    <campeonato
                        v-for="(c, i) in campeonatos"
                        :key="i"
                        :campeonato="c"
                    >
                    </campeonato>
                </v-expansion-panel>
            </div>
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
        this.loading = true
        axios.get('http://192.168.2.100:8000/api/campeonatos')
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
    },
    data () {
        return {
            campeonatos: null,
            campeonato: {
                id: null,
                titulo: null,
                data_inicio: null,
                data_fim: null,
                desc: null,
                brasao: null,
                criador_id: null,
                fl_publico: 1,
                fl_profissional: 1
            },
            loading: false
        }
    },
    methods: {
        salvarCampeonato(campeonato){
            this.campeonato = campeonato
            if(this.campeonato.id){
                // Edita o campeonato
                console.log(this.campeonato)
            }else{
                // Cria um novo campeonato
                this.campeonatos.push(this.campeonato)
                let camp = this.campeonato
                camp.criador_id = 1
                axios.post('http://127.0.0.1:8000/api/campeonatos', camp)
                    .then(
                        (response) => {
                            console.log(response)
                        },
                        (error) => console.log(error)
                    )
            }
        }
    }
}
</script>
<style scoped>
</style>
