import Vue from "vue";
import Router from "vue-router";
import Home from "./views/home/Home.vue";
import Admin from "./views/admin/Admin.vue";
import HomePrincipal from "./views/home/sections/principal/Principal.vue";
import HomeSeminars from "./views/home/sections/seminars/Seminars.vue";
import HomeProducts from "./views/home/sections/products/Products.vue";
import HomeAbout from "./views/home/sections/about/About.vue";
import HomeContact from "./views/home/sections/contact/Contact.vue";

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
      children: [
        {
          path: 'seminarios',
          component: HomeSeminars
        },
        {
          path: 'productos',
          component: HomeProducts
        },
        {
          path: 'nosotros',
          component: HomeAbout
        },
        {
          path: 'contacto',
          component: HomeContact
        }
      ]
    },
    {
      path: "/admin",
      name: "admin",
      component: Admin
    }
  ]
});
