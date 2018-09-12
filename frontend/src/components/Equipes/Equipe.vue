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
                        v-if="equipe.brasao"
                        :src="equipe.brasao"
                        alt="Avatar"
                        >
                    </v-avatar>
                </v-flex>

                <v-flex sm5 md3 hidden-xs-only>
                    <strong v-html="equipe.nome"></strong>
                </v-flex>
            </v-layout>
            <v-card>
                <v-icon @click="editarEquipe()" class="icone-editar" color="primary">edit</v-icon>
                <v-icon @click="dialogDelete = true" class="icone-deletar" color="red darken-1">delete</v-icon>
                <v-divider></v-divider>
                <v-card-text v-text="equipe.nome"></v-card-text>
            </v-card>
            <v-dialog v-model="dialogDelete" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Tem certeza que deseja deletar esta equipe?</v-card-title>
                    <v-card-text>Se você clicar em confirmar a equipep será deletado para sempre!</v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-1" flat @click="dialogDelete = false">Cancelar</v-btn>
                    <v-btn color="green darken-1" flat @click="excluirEquipe">Confirmar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-expansion-panel-content>
</template>
<script>
import ModalEquipe from './ModalEquipe'
export default {
    name: 'Equipe',
    mounted(){
    },
    components: {
        'modal-equipe': ModalEquipe,
    },
    props: ['equipe'],
    data() {
        return {
            dialogDelete: false
        }
    },
    methods: {
        editarEquipe(){
            this.$bus.$emit('abre-modal-equipe', this.equipe)
        },
        excluirEquipe(){
            this.dialogDelete = false
            this.$bus.$emit('excluir-equipe', this.equipe.id)
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

