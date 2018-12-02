import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
Vue.use(VueRouter);

// configure router
const router = new VueRouter({
  routes, // short for routes: routes
  linkExactActiveClass: "active",
  scrollBehavior: (to) => {
    if (to.hash) {
      return {selector: to.hash}
    } else {
      return { x: 0, y: 0 }
    }
  }
});

router.beforeEach((to, from, next)=>{
  const name = to.name;
  
  const rotaDeVisitante = (
    name.indexOf('login') > -1 || name.indexOf('register') > -1
    || name.indexOf('recuperarSenha') > -1 || name.indexOf('novaSenha') > -1
  );

  if(rotaDeVisitante){
    if(Vue.auth.isAuthenticated()){
      next({path: '/dashboard'})
      return 0;
    }
    next();
  }else{
    if(!Vue.auth.isAuthenticated()){
      if(name.indexOf('dashboard') > -1){
        const loginRedirect = to.query.login;
        if(loginRedirect == 'true'){
          const token = to.query.token;
          axios.post("auth/me", {}, {headers: {'Authorization': 'Bearer '+token}})
            .then(response => {
              Vue.auth.setToken(token);
              Vue.auth.setUser(response.data);
              next();
            });
          return 0;    
        }
      }
      next({path: '/login'})
      return 0;
    }
  }

  next()
});

export default router;
