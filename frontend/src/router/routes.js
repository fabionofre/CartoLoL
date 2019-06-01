import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Admin pages
import Dashboard from "@/pages/Dashboard.vue";
import Juiz from "@/pages/Juiz.vue";
import Escalacao from "@/pages/Escalacao.vue";
import Perfil from '@/pages/Perfil';
import Campeonatos from '@/pages/Campeonatos.vue';
import Atletas from '@/pages/Atletas.vue';
import Times from '@/pages/Times.vue';
import Pontuacao from '@/pages/Pontuacao.vue';
import Rodada from '@/pages/Rodadas.vue';


// Auth Pages
import Login from "@/pages/Auth/Login";
import Register from "@/pages/Auth/Register";
import RecuperarSenha from "@/pages/Auth/Esqueci-senha/RecuperarSenha";
import NovaSenha from "@/pages/Auth/Esqueci-senha/NovaSenha";

// Liga
import Ligas from "@/pages/Ligas";

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: Dashboard
      },
      {
        path: "juiz",
        name: "juiz",
        component: Juiz
      },
      {
        path: "escalacao",
        name: "escalacao",
        component: Escalacao
      },
      {
        path: "perfil",
        name: "perfil",
        component: Perfil
      },
      {
        path: "campeonatos",
        name: "campeonatos",
        component: Campeonatos
      },
      {
        path: "rodadas",
        name: "rodadas",
        component: Rodada
      },
      {
        path: "atletas",
        name: "atletas",
        component: Atletas
      },
      {
        path: "times",
        name: "times",
        component: Times
      },
      {
        path: "pontuacao",
        name: "pontuacao",
        component:  Pontuacao
      },
      {
        path: "Ligas",
        name: "ligas",
        component: Ligas
      }
    ]
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/register",
    name: "register",
    component: Register
  },
  {
    path: "/recuperarSenha",
    name: "recuperarSenha",
    component: RecuperarSenha
  },
  {
    path: "/novaSenha",
    name: "novaSenha",
    component: NovaSenha
  },
  { path: "*", component: NotFound },
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
