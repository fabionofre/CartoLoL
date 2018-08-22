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
        >
            <v-icon>add</v-icon>
        </v-btn>
      <v-card>
        <v-card-title>
          <span class="headline">{{ titulo_card }} Campeonato</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Titulo" required v-model="camp.titulo"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Brasão" hint="por enquanto a URL, dps coloco UPLOAD" persistent-hint v-model="camp.brasao"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Data do Início" required v-model="camp.data_inicio"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Data do Fim" v-model="camp.data_fim"></v-text-field>
                </v-flex>
                <v-flex xs12>
                    <v-textarea
                        label="Descrição"
                        v-model="camp.descricao"
                        >
                    </v-textarea>
                </v-flex>
            </v-layout>
          </v-container>
          <!-- <small>*indicates required field</small> -->
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="dialog = false">Fechar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="criarCampeonato()">Salvar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<script>
export default {
    updated(){
        if(this.campeonato.id)
            this.titulo_card = 'Editar'
    },
    props: ['campeonato'],
    name: 'ModalCampeonato',
    data() {
        return {
            dialog: false,
            titulo_card: 'Criar',
            camp: this.campeonato
        }
    },
    methods: {
        criarCampeonato(){
            this.dialog = false
            this.$emit('update:campeonato')
        }
    }
}
</script>
