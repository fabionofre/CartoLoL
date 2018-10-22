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
                <v-flex xs12 sm12 md12>
                    <div class="dropbox" v-if="!brasaoPreview && !camp.brasao">
                        <input type="file" id="foto" @change="onBrasaoChange">
                        <p>
                            Arraste o brasao para cá<br> ou clique para navegar
                        </p>
                    </div>
                    <div v-else>
                        <v-layout row>
                            <v-flex xs3 sm3 md3>
                                <v-avatar v-if="camp.brasao && brasaoPreview">
                                    <img
                                    :src="brasaoPreview"
                                    >
                                </v-avatar>
                                <v-avatar v-else>
                                    <img
                                    :src="'http://localhost:8000/storage/'+camp.brasao"
                                    >
                                </v-avatar>
                                <v-icon
                                small
                                @click.stop="removerBrasao"
                                >close</v-icon>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-flex>
                <v-flex xs12 sm12 md12 v-if="brasaoPreview || camp.brasao">
                    <v-text-field label="Titulo" required v-model="camp.titulo"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6 v-if="brasaoPreview || camp.brasao">
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
                <v-flex xs12 sm12 md6 v-if="brasaoPreview || camp.brasao">
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
                <v-flex xs12 v-if="brasaoPreview || camp.brasao">
                    <v-textarea
                        label="Descrição"
                        v-model="camp.desc"
                        >
                    </v-textarea>
                </v-flex>
                <v-switch
                    label="Público"
                    v-model="camp.fl_publico"
                    v-if="brasaoPreview || camp.brasao"
                ></v-switch>
                <v-switch
                    label="Profissional"
                    v-model="camp.fl_profissional"
                    v-if="brasaoPreview || camp.brasao"
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
            brasaoPreview: null
        }
    },
    computed: {
      computedDateFormatted () {
        return this.formatDate(this.date);
      },
      computedDate2Formatted () {
        return this.formatDate(this.date2);
      }
    },

    watch: {
      date (val) {
          this.dateFormatted = this.formatDate(this.date);
      },
      date2 (val) {
          this.date2Formatted = this.formatDate(this.date2);
      },
      dialog (val){
          if(val){
            this.date = this.camp.data_inicio;
            this.date2 = this.camp.data_fim;
          }else{
            this.date = null;
            this.date2 = null;
          }
      }
    },
    methods: {
        criarCampeonato(){
            this.dialog = false;
            if(this.camp.fl_publico === undefined)
                this.camp.fl_publico = false;
            if(this.camp.fl_profissional === undefined)
                this.camp.fl_profissional = false;
            this.camp.data_inicio = this.date;
            this.camp.data_fim = this.date2;
            this.$bus.$emit('update:campeonato', this.camp);
            this.camp = {};
            this.brasaoPreview = null;
        },
        abreModal(campeonato){
            this.dialog = true;
            this.camp = campeonato;
        },
        resetCamp(){
            this.camp = {};
            this.titulo_card = 'Criar';
        },
        formatDate (date) {
            if (!date) return null;
            const [year, month, day] = date.split('-');
            return `${day}/${month}/${year}`;
        },
        parseDate (date) {
            if (!date) return null;

            const [month, day, year] = date.split('/');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        },
        onBrasaoChange(event){
            this.camp.brasao = event.target.files[0];
            this.previewBrasao(this.camp.brasao);
        },
        previewBrasao(brasao) {
            let reader = new FileReader();
            reader.readAsDataURL(brasao);
            reader.onloadend = () => {
                this.brasaoPreview = reader.result;
            }
        },
        removerBrasao(){
            this.camp.brasao = null;
            this.brasaoPreview = null;
        }
    }
}
</script>
<style lang="scss" scoped>
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