import Vue from "vue";
import Router from "vue-router";
import home from "./views/home/router";
import admin from "./views/admin/router";

var routes = [];
routes = routes.concat(home.routes, admin.routes);

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: routes
});
