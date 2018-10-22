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
        this.$bus.$on('update:campeonato', this.salvarCampeonato)
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
                fl_profissional: null,
                equipes: null
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
            const fd = new FormData()
            fd.append('titulo', this.campeonato.titulo)
            fd.append('desc', this.campeonato.desc)
            fd.append('brasao', this.campeonato.brasao, this.campeonato.brasao.nome)
            fd.append('fl_profissional', this.campeonato.fl_profissional ? 1 : 0)
            fd.append('fl_publico', this.campeonato.fl_publico ? 1 : 0)
            fd.append('data_inicio', this.campeonato.data_inicio)
            fd.append('data_fim', this.campeonato.data_fim)
            fd.append('criador_id', 1)
            if(this.campeonato.id){
                // Edita o campeonato
                fd.append('equipes', this.campeonato.equipes)
                fd.append('_method', 'put')
                console.log(this.campeonato)
                axios.post('campeonatos/'+this.campeonato.id, fd)
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
            }else{
                // Cria um novo campeonato
                let camp = this.campeonato
                camp.criador_id = 1
                fd.append('_method', 'post')
                axios.post('campeonatos', fd)
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
            axios.delete('campeonatos/'+id)
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
            axios.get('campeonatos')
                .then(
                    (response) => {
                        console.log(response)
                        this.campeonatos = response.data
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
