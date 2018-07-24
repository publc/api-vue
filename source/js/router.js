import Vue from "vue";
import Router from "vue-router";
import homeRouter from "./views/home/router";
import adminRouter from "./views/admin/router";

Vue.use(Router);

var routes = [];
routes = routes.concat(homeRouter.routes);
routes = routes.concat(adminRouter.routes);

export default new Router({
  mode: 'history',
  routes: routes
});
