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
                <v-icon @click="dialogDelete = true" class="icone-deletar" color="red darken-1">delete</v-icon>
                <v-divider></v-divider>
                <v-card-text v-text="campeonato.desc"></v-card-text>
            </v-card>
            <v-dialog v-model="dialogDelete" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Tem certeza que deseja deletar este campeonato?</v-card-title>
                    <v-card-text>Se você clicar em confirmar o campeonato será deletado para sempre!</v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-1" flat @click="dialogDelete = false">Cancelar</v-btn>
                    <v-btn color="green darken-1" flat @click="excluirCampeonato">Confirmar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-expansion-panel-content>
</template>
<script>
import ModalCampeonato from './ModalCampeonato'
export default {
    name: 'Campeonato',
    mounted(){
    },
    components: {
        'modal-campeonato': ModalCampeonato,
    },
    props: ['campeonato'],
    data() {
        return {
            dialogDelete: false
        }
    },
    methods: {
        editarCampeonato(){
            this.$bus.$emit('abre-modal-campeonato', this.campeonato)
        },
        excluirCampeonato(){
            this.dialogDelete = false
            this.$bus.$emit('excluir-campeonato', this.campeonato.id)
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

