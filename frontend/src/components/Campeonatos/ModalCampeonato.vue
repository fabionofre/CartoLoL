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
            @click="resetCamp"
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
                            label="Data de Inicio"
                            persistent-hint
                            prepend-icon="event"
                            @blur="date = parseDate(dateFormatted)"
                        ></v-text-field>
                        <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                    </v-menu>
                </v-flex>
                <v-flex xs12 sm12 md6>
                    <v-menu
                        ref="menu2"
                        :close-on-content-click="false"
                        v-model="menu2"
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
                            v-model="date2Formatted"
                            label="Data Final"
                            persistent-hint
                            prepend-icon="event"
                            @blur="date2 = parseDate(date2Formatted)"
                        ></v-text-field>
                        <v-date-picker v-model="date2" no-title @input="menu2 = false"></v-date-picker>
                    </v-menu>
                </v-flex>
                <v-flex xs12>
                    <v-textarea
                        label="Descrição"
                        v-model="camp.desc"
                        >
                    </v-textarea>
                </v-flex>
                <v-switch
                    label="Público"
                    v-model="camp.fl_publico"
                ></v-switch>
                <v-switch
                    label="Profissional"
                    v-model="camp.fl_profissional"
                ></v-switch>
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
    mounted(){
        this.$bus.$on('abre-modal-campeonato', this.abreModal)
    },
    props: ['campeonato'],
    name: 'ModalCampeonato',
    data() {
        return {
            dialog: false,
            titulo_card: 'Editar',
            camp: this.campeonato,
            menu1: false,
            menu2: false,
            dateFormatted: null,
            date2Formatted: null,
            date: null,
            date2: null,
        }
    },
    computed: {
      computedDateFormatted () {
        return this.formatDate(this.date)
      },
      computedDate2Formatted () {
        return this.formatDate(this.date2)
      }
    },

    watch: {
      date (val) {
          this.dateFormatted = this.formatDate(this.date)
      },
      date2 (val) {
          this.date2Formatted = this.formatDate(this.date2)
      },
      dialog (val){
          if(val){
            this.date = this.camp.data_inicio
            this.date2 = this.camp.data_fim
          }else{
            this.date = null
            this.date2 = null
          }
      }
    },
    methods: {
        criarCampeonato(){
            this.dialog = false
            if(this.camp.fl_publico === undefined)
                this.camp.fl_publico = false
            if(this.camp.fl_profissional === undefined)
                this.camp.fl_profissional = false
            this.camp.data_inicio = this.date
            this.camp.data_fim = this.date2
            this.$emit('update:campeonato', this.camp)
            this.camp = {}
        },
        abreModal(campeonato){
            this.dialog = true
            this.camp = campeonato
        },
        resetCamp(){
            this.camp = {}
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
