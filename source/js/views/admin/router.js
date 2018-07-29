import Admin from "./Admin.vue";
import Login from "./auth/Login.vue";
import Register from "./auth/Register.vue";

export default {
    routes: [
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
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }
    ]
};