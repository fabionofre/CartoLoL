<template>
  <v-app>
    <v-navigation-drawer
      persistent
      v-model="drawer"
      enable-resize-watcher
      fixed
      app
    >
      <v-toolbar flat class="transparent">
        <v-list class="pa-0">
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <img src="http://localhost:8000/storage/aline.jpg">
            </v-list-tile-avatar>

            <v-list-tile-content>
              <v-list-tile-title>Aline Gabriele</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-toolbar>
      <v-list class="pt-0" dense>
        <v-divider></v-divider>

        <v-list-tile
          value="true"
          v-for="(item, i) in items"
          :key="i"
          @click="routerPush(item.to)"
        >
          <v-list-tile-action>
            <img :src="'http://localhost:8000/icons-cartolol/'+item.icon+'.png'">
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title v-text="item.title"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    </v-toolbar>
    <v-content>
      <router-view/>
    </v-content>
    <v-footer :fixed="fixed" app>
      <span>&copy; CartoLoL 2018</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data () {
    return {
      drawer: true,
      fixed: false,
      items: [
      // {
      //   icon: 'home',
      //   title: 'Início',
      //   to: '/'
      // }, 
      // {
      //  icon: 'assignment',
      //  title: 'Escalar' 
      // }, 
      // {
      //   icon: 'assessment',
      //   title: 'Estatísticas'  
      // }, 
      // {
      //   icon: 'language',
      //   title: 'Ranking'
      // }, 
      {
        icon: 'trophy',
        title: 'Campeonatos',
        to: 'campeonatos'
      },{
        icon: 'network',
        title: 'Equipes',
        to: 'equipes'
      },{
        icon: 'mouse',
        title: 'Atletas',
        to: 'atletas'
      }
      ],
      title: 'Vuetify.js'
    }
  },
  name: 'App',
  methods: {
    routerPush(to){
      this.$router.push({path: to})
    }
  }
}
</script>
