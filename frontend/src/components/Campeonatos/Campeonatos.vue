<template>
    <v-slide-y-transition mode="out-in">
        <v-layout column justify-center>
            <modal-campeonato
               :campeonato="campeonato"
               v-on:update:campeonato="salvarCampeonato"
            >
            </modal-campeonato>
            <v-subheader>Meus Campeonatos</v-subheader>
            <v-expansion-panel popout>
                <campeonato
                    v-for="(c, i) in campeonatos"
                    :key="i"
                    :brasao="c.brasao"
                    :titulo="c.titulo"
                    :desc="c.desc"
                    :de_ate="c.de_ate"
                >
                </campeonato>
            </v-expansion-panel>
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
        axios.get('http://127.0.0.1:8000/api/campeonatos')
            .then(
                (response) => {
                    console.log(response)
                    this.campeonatos = response.data.data
                },
                (error) => console.log(error)
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
            }
        }
    },
    methods: {
        salvarCampeonato(){
            console.log(this.campeonato)
            if(this.campeonato.id){
                // Edita o campeonato
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
