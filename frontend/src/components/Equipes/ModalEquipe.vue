<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-btn
            color="primary"
            dark
            large
            absolute
            top
            right
            fab
            slot="activator"
            @click="resetEqui"
        >
            <v-icon>add</v-icon>
        </v-btn>
      <v-card>
        <v-card-title>
          <span class="headline">{{ titulo_card }} Equipe</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
                <v-flex xs12 sm12 md12>
                    <div class="dropbox" v-if="!brasaoPreview && !equi.brasao">
                        <input type="file" id="foto" @change="onBrasaoChange">
                        <p>
                            Arraste a foto do atleta para cá<br> ou clique para navegar
                        </p>
                    </div>
                    <div v-else>
                        <v-layout row>
                            <v-flex xs3 sm3 md3>
                                <v-avatar v-if="equi.brasao && brasaoPreview">
                                    <img
                                    :src="brasaoPreview"
                                    >
                                </v-avatar>
                                <v-avatar v-else>
                                    <img
                                    :src="'http://localhost:8000/storage/'+equi.brasao"
                                    >
                                </v-avatar>
                                <v-icon
                                small
                                @click.stop="removerBrasao"
                                >close</v-icon>
                            </v-flex>
                            <v-flex xs6 sm6 md6 style="margin-top: -10px">
                                <v-switch
                                v-if="brasaoPreview || equi.brasao"
                                label="Profissional"
                                v-model="equi.fl_profissional"
                                ></v-switch>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-flex>
                <v-flex xs12 sm12 md12 v-if="brasaoPreview || equi.brasao">
                    <v-text-field label="Nome" required v-model="equi.nome"></v-text-field>
                </v-flex>
            </v-layout>
          </v-container>
          <!-- <small>*indicates required field</small> -->
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="dialog = false">Fechar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="criarEquipe">Salvar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<script>
export default {
    mounted(){
        this.$bus.$on('abre-modal-equipe', this.abreModal)
    },
    props: ['equipe'],
    name: 'ModalEquipe',
    data() {
        return {
            dialog: false,
            titulo_card: 'Editar',
            equi: this.equipe,
            brasaoPreview: null
        }
    },
    methods: {
        criarEquipe(){
            this.dialog = false
            if(this.equi.fl_profissional === undefined)
                this.equi.fl_profissional = false
            this.$bus.$emit('update:equipe', this.equi)
            this.equi = {}
            this.brasaoPreview = null
        },
        abreModal(equipe){
            this.dialog = true
            this.equi = equipe
        },
        resetEqui(){
            this.equi = {}
            this.titulo_card = 'Criar'
        },
        onBrasaoChange(event){
            console.log(event)
            this.equi.brasao = event.target.files[0]
            this.previewBrasao(this.equi.brasao)
        },
        previewBrasao(brasao) {
            let reader = new FileReader()
            reader.readAsDataURL(brasao)
            reader.onloadend = () => {
                this.brasaoPreview = reader.result
                console.log(this.brasaoPreview)
            }
        },
        removerBrasao(){
            this.equi.brasao = null
            this.brasaoPreview = null
        }
    }
}
</script>
<style lang="scss">
    .dropbox {
        outline: 2px dashed grey; /* the dash box */
        outline-offset: -10px;
        background: lightcyan;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px; /* minimum height */
        position: relative;
        cursor: pointer;
    }

    #foto {
        opacity: 0; /* invisible but it's there! */
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }

    .dropbox:hover {
        background: lightblue; /* when mouse over to the drop zone, change color */
    }

    .dropbox p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 0;
    }
</style>
