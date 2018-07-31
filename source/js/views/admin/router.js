import Admin from "./Admin.vue";
import Login from "./auth/Login.vue";
import Register from "./auth/Register.vue";
import AdminHome from "./Home.vue";
import AdminProducts from "./sections/products/Products.vue";
import AdminSeminars from "./sections/seminars/Seminars.vue";
import AdminUsers from "./sections/users/Users.vue";
import axios from 'axios';

export default {
    routes: [
        {
            path: "/admin",
            name: "admin",
            component: Admin,
            beforeEnter: (to, from, next) => {
                axios.get('api/check', {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                })
                .then(() => {
                    next();
                })
                .catch(() => {
                    next({path: '/login'});
                });
            },
            children: [
                {path: 'register', name: 'register', component: Register}, 
                {path: '/', name: "adminHome", component: AdminHome},
                {path: 'products', name: "adminProducts", component: AdminProducts},
                {path: 'seminars', name: 'adminSeminars', component: AdminSeminars}, 
                {path: 'users', name: 'adminUsers', component: AdminUsers}, 
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: (to, from, next) => {
                axios.get('api/check', {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                })
                .then(() => {
                    next({path: '/admin'});
                })
                .catch(() => {
                    next();
                });
            },
        }        
    ]
};