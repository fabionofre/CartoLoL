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
                    :descricao="c.descricao"
                    :de_ate="c.de_ate"
                >
                </campeonato>
            </v-expansion-panel>
        </v-layout>
    </v-slide-y-transition>
</template>
<script>
import Campeonato from './Campeonato'
import ModalCampeonato from './ModalCampeonato'
export default {
    name: 'Campeonatos',
    components: {
        'campeonato': Campeonato,
        'modal-campeonato': ModalCampeonato
    },
    data () {
        return {
            campeonatos: [{
                id: 1,
                titulo: 'CBLOL',
                descricao: 'Circuito Brasileiro de League of Legends',
                brasao: 'https://cdn.vs.com.br/vs-img/1508430358350-tabela-do-cblol-2017_cstv.jpg',
                de_ate: 'De 02/04/2018 até 26/06/2018'
            }, {
                id: 2,
                titulo: 'Circuito Desafiante',
                descricao: 'Os primeiros colocados ganham vaga no CBLOL',
                brasao: 'https://br.leagueoflegends.com/sites/default/files/styles/wide_small/public/upload/lolesports-header-cd2018.jpg?itok=s0_0Vnxu',
                de_ate: 'De 22/07/2018 até 08/09/2018'
            }],
            campeonato: {
                id: null,
                titulo: null,
                data_inicio: null,
                data_fim: null,
                descricao: null,
                brasao: null
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
            }
        }
    }
}
</script>
<style scoped>
</style>
