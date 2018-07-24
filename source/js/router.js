import Vue from "vue";
import Router from "vue-router";
import Home from "./views/home/Home.vue";
import Admin from "./views/admin/Admin.vue";
import Login from "./views/admin/auth/Login.vue";

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/admin",
      name: "admin",
      component: Admin,
      beforeEnter: (to, from, next) => {
        var logged = false;
        
        if(!logged) {
          next({path: '/login'}); 
        }

        next();
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ]
});
