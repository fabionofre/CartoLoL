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
                        :src="'http://localhost:8000/storage/'+campeonato.brasao"
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
                        v-for="e in campeonato.equipes"
                        :key="e.id"
                        bottom 
                        color="blue-grey darken-1" 
                        >
                            <v-avatar slot="activator">
                                <img
                                :src="'http://localhost:8000/storage/'+e.brasao"
                                :alt="e.nome"
                                >
                            </v-avatar>
                            <v-card color="blue-grey darken-1" class="white--text">
                                <v-layout row>
                                    <v-flex xs4>
                                    <img
                                        :src="'http://localhost:8000/storage/'+e.brasao"
                                        height="125px"
                                        contain
                                    >
                                    </v-flex>
                                    <v-flex xs8>
                                    <v-card-title primary-title>
                                        <div>
                                            <div class="headline">{{e.nome}}</div>
                                            <div>2 Vitórias</div>
                                            <div>Criado em : {{e.created_at}}</div>
                                            <div>{{e.fl_profissional ? 'Profissional' : 'Amador'}}</div>
                                        </div>
                                    </v-card-title>
                                    </v-flex>
                                </v-layout>
                                <v-divider light></v-divider>
                                <v-card-actions class="pa-3">
                                    <v-avatar :key="a.id" v-for="a in e.atletas" style="margin-right: 5px">
                                        <img
                                        :src="'http://localhost:8000/storage/'+a.foto"
                                        :alt="a.nome"
                                        >
                                    </v-avatar>
                                </v-card-actions>
                            </v-card>
                        </v-tooltip>
                        <v-btn
                            dark
                            fab
                            color="blue-grey darken-2"
                            @click="dialogTimes = true"
                            >
                            <v-icon>add</v-icon>
                        </v-btn>
                    </div>
                </v-card-text>
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
            <v-dialog v-model="dialogTimes" scrollable>
                <v-card>
                    <v-card-title>  
                        <v-combobox
                        v-model="equipesSelecionadas"
                        :items="equipes"
                        label="Escolha os times participantes!"
                        multiple
                        item-text="nome"
                        item-avatar="brasao"
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
                                    :src="'http://localhost:8000/storage/'+data.item.brasao"
                                    >
                                </v-avatar>
                                {{ data.item.nome }}
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
                                        <img :src="'http://localhost:8000/storage/'+data.item.brasao" />
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="data.item.nome"></v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </template>
                            <template slot="no-data">
                                <p><b>Nenhuma equipe foi cadastrada até agora :(</b></p>
                            </template>
                        </v-combobox>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-actions>
                    <v-btn color="blue darken-1" flat @click.native="dialogTimes = false">Fechar</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="salvarTimes">Salvar!</v-btn>
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
        this.getEquipes();
    },
    components: {
        'modal-campeonato': ModalCampeonato,
    },
    props: ['campeonato'],
    data() {
        return {
            dialogDelete: false,
            dialogTimes: false,
            equipes: [],
            equipesSelecionadas: null,
            loading: false
        }
    },
    watch: {
        dialogTimes(val){
            this.equipesSelecionadas = [...this.campeonato.equipes]
        }
    },
    methods: {
        editarCampeonato(){
            this.$bus.$emit('abre-modal-campeonato', this.campeonato)
        },
        excluirCampeonato(){
            this.dialogDelete = false
            this.$bus.$emit('excluir-campeonato', this.campeonato.id)
        },
        getEquipes(){
            this.loading = true
            axios.get('equipes')
                .then(
                    (response) => {
                        console.log(response)
                        this.equipes = response.data
                        this.loading = false
                    },
                    (error) => {
                        console.log(error)
                        this.loading = false
                    }
                )
        },
        salvarTimes(){
            this.dialogTimes = false
            this.campeonato.equipes = this.equipesSelecionadas.map(e => e.id)
            console.log(this.campeonato.equipes)
            this.$bus.$emit('update:campeonato', this.campeonato)
        }
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
    /* .tooltip-time{
        color: black;
        border-color: black;
    } */
</style>

