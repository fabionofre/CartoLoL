<template>
  <div class="wrapper">
    <side-bar>
      <template slot="links">
        <sidebar-link to="/dashboard" name="Dashboard" icon="tim-icons icon-chart-pie-36"/>
        <sidebar-link to="/juiz" v-if="user && user.tipo_usuario_id != 1" name="Juiz" icon="tim-icons icon-settings-gear-63"/>
        <sidebar-link to="/escalacao" name="Escalação" icon="tim-icons icon-notes"/>
        <sidebar-link to="/campeonatos" name="Camepeonatos" icon="tim-icons icon-trophy"/>
        <sidebar-link to="/atletas" name="Atletas" icon="tim-icons icon-user-run"/>
        <sidebar-link to="/times" name="Times" icon="tim-icons icon-vector"/>
      </template>
    </side-bar>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click.native="toggleSidebar">

      </dashboard-content>

      <content-footer></content-footer>
    </div>
  </div>
</template>
<style lang="scss">
</style>
<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "./MobileMenu";
export default {
  created(){
    if(this.$auth.isAuthenticated())
      this.user = this.$auth.getUser();
    this.$bus.$on('receber-usuario-dash', this.setUsuario);
  },
  beforeDestroy(){
    this.$bus.$off('receber-usuario-dash');
  },
  data(){
    return {
      user: {}
    }
  },
  components: {
    TopNavbar,
    ContentFooter,
    DashboardContent,
    MobileMenu
  },
  methods: {
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    setUsuario(user){
      console.log(user);
      this.user = user;
    },
  }
};
</script>
