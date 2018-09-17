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
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Nome" required v-model="equi.nome"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Brasão" hint="por enquanto a URL, dps coloco UPLOAD" persistent-hint v-model="equi.brasao"></v-text-field>
                </v-flex>
                <v-switch
                    label="Profissional"
                    v-model="equi.fl_profissional"
                ></v-switch>
            </v-layout>
          </v-container>
          <!-- <small>*indicates required field</small> -->
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="dialog = false">Fechar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="criarEquipe()">Salvar</v-btn>
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
        }
    },
    methods: {
        criarEquipe(){
            this.dialog = false
            if(this.equi.fl_profissional === undefined)
                this.equi.fl_profissional = false
            this.$bus.$emit('update:equipe', this.equi)
            this.equi = {}
        },
        abreModal(equipe){
            this.dialog = true
            this.equi = equipe
        },
        resetEqui(){
            this.equi = {}
            this.titulo_card = 'Criar'
        }
    }
}
</script>
