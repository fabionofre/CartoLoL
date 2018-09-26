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
          <span class="headline">{{ titulo_card }} Atleta</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
                <v-flex xs12 sm12 md12>
                    <div class="dropbox" v-if="!imgPreview">
                        <input type="file" id="foto" @change="onFotoChange">
                        <p>
                            Arraste a foto do atleta para cá<br> ou clique para navegar
                        </p>
                    </div>
                    <div v-else>
                        <v-avatar>
                            <img
                            :src="imgPreview"
                            >
                        </v-avatar>
                        <v-icon
                        small
                        @click.stop="removerImagem"
                        >close</v-icon>
                    </div>
                </v-flex>
                <v-flex xs12 sm12 md6 v-if="imgPreview">
                    <v-text-field label="Nome" required v-model="atle.nome"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6 v-if="imgPreview">
                    <v-text-field label="Sobrenome" required v-model="atle.sobrenome"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6 v-if="imgPreview">
                    <v-text-field label="Apelido" required v-model="atle.apelido"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md6 v-if="imgPreview">
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
            </v-layout>
          </v-container>
          <!-- <small>*indicates required field</small> -->
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="dialog = false">Fechar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="criarAtleta">Salvar</v-btn>
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
            date: null,
            imgPreview: null
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
            this.imgPreview = null
            this.atle.foto = null
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
        },
        onFotoChange(event){
            console.log(event)
            this.atle.foto = event.target.files[0]
            this.previewFoto(this.atle.foto)
        },
        previewFoto(foto) {
            let reader = new FileReader()
            reader.readAsDataURL(foto)
            reader.onloadend = () => {
                this.imgPreview = reader.result
            }
        },
        removerImagem(){
            this.atle.foto = null
            this.imgPreview = null
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
