<template>
        <v-expansion-panel-content
            hide-actions
        >
            <v-layout
                slot="header"
                align-center
                row
                spacer
            >
                <v-flex xs4 sm2 md1>
                    <v-avatar
                        slot="activator"
                        size="36px"
                    >
                        <img
                        v-if="campeonato.brasao"
                        :src="campeonato.brasao"
                        alt="Avatar"
                        >
                    </v-avatar>
                </v-flex>

                <v-flex sm5 md3 hidden-xs-only>
                    <strong v-html="campeonato.titulo"></strong>
                </v-flex>

                <v-flex no-wrap xs5 sm3>
                    <strong v-html="campeonato.de_ate"></strong>
                </v-flex>

                <v-flex
                    v-if="campeonato.desc"
                    class="grey--text"
                    ellipsis
                    hidden-sm-and-down
                >
                    &mdash;
                    {{ campeonato.desc }}
                </v-flex>
            </v-layout>

            <v-card>
                <v-icon @click="editarCampeonato()" class="icone-editar" color="primary">edit</v-icon>
                <v-icon @click.native="excluirCampeonato()" class="icone-deletar" color="red darken-1">delete</v-icon>
                <v-divider></v-divider>
                <v-card-text v-text="campeonato.desc"></v-card-text>
            </v-card>
        </v-expansion-panel-content>
</template>
<script>
import ModalCampeonato from './ModalCampeonato'
export default {
    name: 'Campeonato',
    mounted(){
        console.log(this.campeonato)
    },
    components: {
        'modal-campeonato': ModalCampeonato,
    },
    props: ['campeonato'],
    data() {
        return {

        }
    },
    methods: {
        editarCampeonato(){
            this.$bus.$emit('abre-modal-campeonato', this.campeonato)
        },
        excluirCampeonato(){

        }
    }
}
</script>
<style scoped>
    .icone-editar{
        top: -70%;
        position: absolute;
        left: 90%;
    }
    .icone-deletar{
        top: -70%;
        position: absolute;
        left: 95%;
    }
</style>

