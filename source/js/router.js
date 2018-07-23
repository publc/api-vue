import Vue from "vue";
import Router from "vue-router";
import Home from "./views/home/Home.vue";
import Admin from "./views/admin/Admin.vue";

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
      component: Admin
    }
  ]
});
