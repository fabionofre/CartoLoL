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
                        :src="'http://localhost:8000/storage/'+equipe.brasao"
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
                <v-card-text>
                    <div v-show="loading" class="text-xs-center">
                        <v-progress-circular
                            v-show="true"
                            :size="100"
                            color="primary"
                            indeterminate
                        ></v-progress-circular>
                    </div>
                    <div v-show="!loading">
                        <v-tooltip 
                        v-for="a in equipe.atletas"
                        :key="a.id"
                        bottom 
                        color="blue-grey darken-1" 
                        >
                            <v-avatar slot="activator">
                                <img
                                :src="'http://localhost:8000/storage/'+a.foto"
                                :alt="a.nome"
                                >
                            </v-avatar>
                            <span>{{a.apelido}}</span>
                        </v-tooltip>
                        <v-btn
                            dark
                            fab
                            color="blue-grey darken-2"
                            @click="dialogAtletas = true"
                            >
                            <v-icon>add</v-icon>
                        </v-btn>
                    </div>
                </v-card-text>
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
            <v-dialog v-model="dialogAtletas" scrollable>
                <v-card>
                    <v-card-title>  
                        <v-combobox
                        v-model="atletasSelecionados"
                        :items="atletas"
                        label="Escolha os atletas do time!"
                        multiple
                        item-text="nome"
                        item-avatar="foto"
                        chips
                        >
                            <template
                            slot="selection"
                            slot-scope="data"
                            >
                                <v-chip
                                :selected="data.selected"
                                :disabled="data.disabled"
                                :key="JSON.stringify(data.item.id)"
                                class="v-chip--select-multi"
                                @input="data.parent.selectItem(data.item.nome)"
                                >
                                <v-avatar>
                                    <img
                                    :src="'http://localhost:8000/storage/'+data.item.foto"
                                    >
                                </v-avatar>
                                {{ data.item.apelido }}
                                <v-icon
                                small
                                @click="data.parent.selectItem(data.item)"
                                >close</v-icon>
                                </v-chip>
                            </template>
                            <template slot="item" slot-scope="data">
                                <v-list-tile>
                                    <v-checkbox v-model="data.tile.props.value"></v-checkbox>
                                    <v-list-tile-avatar>
                                        <img :src="'http://localhost:8000/storage/'+data.item.foto" />
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>{{data.item.nome}} <b>"{{data.item.apelido}}"</b> {{data.item.sobrenome}}</v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </template>
                            <template slot="no-data">
                                <p><b>Nenhum atleta foi cadastrado até agora :/</b></p>
                            </template>
                        </v-combobox>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-actions>
                    <v-btn color="blue darken-1" flat @click.native="dialogAtletas = false">Fechar</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="salvarAtletas">Salvar!</v-btn>
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
        this.getAtletas()
    },
    components: {
        'modal-equipe': ModalEquipe,
    },
    props: ['equipe'],
    data() {
        return {
            dialogDelete: false,
            dialogAtletas: false,
            atletas: [],
            atletasSelecionados: null,
            loading: false,
        }
    },
    watch: {
        dialogAtletas(val){
            this.atletasSelecionados = [...this.equipe.atletas]
        }
    },
    methods: {
        editarEquipe(){
            this.$bus.$emit('abre-modal-equipe', this.equipe)
        },
        excluirEquipe(){
            this.dialogDelete = false
            this.$bus.$emit('excluir-equipe', this.equipe.id)
        },
        salvarAtletas(){
            this.dialogAtletas = false
            this.equipe.atletas = this.atletasSelecionados.map(e => e.id)
            console.log(this.equipe.atletas)
            this.$bus.$emit('update:equipe', this.equipe)
        },
        getAtletas(){
            this.loading = true
            axios.get('atletas')
                .then(
                    (response) => {
                        console.log(response)
                        this.atletas = response.data
                        this.loading = false
                    },
                    (error) => {
                        console.log(error)
                        this.loading = false
                    }
                )
        },
    }
}
</script>
<style scoped>
    .icone-editar{
        top: -40%;
        position: absolute;
        left: 90%;
    }
    .icone-deletar{
        top: -40%;
        position: absolute;
        left: 95%;
    }
</style>

