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
            @click="resetAtle"
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
                    <v-text-field label="Nome" required v-model="atle.nome"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Sobrenome" required v-model="atle.sobrenome"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-text-field label="Apelido" required v-model="atle.apelido"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-menu
                        ref="menu1"
                        :close-on-content-click="false"
                        v-model="menu1"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                    >
                        <v-text-field
                            slot="activator"
                            v-model="dateFormatted"
                            label="Data de Nascimento"
                            persistent-hint
                            prepend-icon="event"
                            @blur="date = parseDate(dateFormatted)"
                        ></v-text-field>
                        <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                    </v-menu>
                </v-flex>
                <v-flex xs12 sm12 md12>
                    <v-text-field label="Foto" hint="por enquanto a URL, dps coloco UPLOAD" persistent-hint v-model="atle.foto"></v-text-field>
                </v-flex>
            </v-layout>
          </v-container>
          <!-- <small>*indicates required field</small> -->
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="dialog = false">Fechar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="criarAtleta()">Salvar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<script>
export default {
    mounted(){
    
    },
    props: ['atleta'],
    name: 'ModalAtleta',
    data() {
        return {
            dialog: false,
            titulo_card: 'Editar',
            atle: this.atleta,
            menu1: false,
            dateFormatted: null,
            date: null
        }
    },
    computed: {
      computedDateFormatted () {
        return this.formatDate(this.date)
      },
    },
    watch: {
        date (val) {
            this.dateFormatted = this.formatDate(this.date)
        },
        dialog (val){
          if(val){
            this.date = this.atle.data_nascimento
          }else{
            this.date = null
          }
        }
    },
    methods: {
        criarAtleta(){
            this.dialog = false
            this.atle.data_nascimento = this.date
            this.$bus.$emit('update:atleta', this.atle)
            this.atle = {}
        },
        resetAtle(){
            this.atle = {}
            this.titulo_card = 'Criar'
        },
        formatDate (date) {
            if (!date) return null
            const [year, month, day] = date.split('-')
            return `${day}/${month}/${year}`
        },
        parseDate (date) {
            if (!date) return null

            const [month, day, year] = date.split('/')
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
        }
    }
}
</script>
