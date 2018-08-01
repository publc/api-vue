<template>
    <div class="navbar">
        <div class="logo">
            <p>Admin</p>
        </div>
        <ul class="nav-menu">
            <li class="nav-item" v-for="(link, i) in links" :key="i">
                <router-link 
                    class="nav-link" 
                    :to="{name: link.link}">{{ link.name }}    
                </router-link>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click.prevent="logout">logout</a>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            links: [
                {name: 'home', link: 'adminHome'},
                {name: 'seminarios', link: 'adminSeminars'},
                {name: 'productos', link: 'adminProducts'},
                {name: 'usuarios', link: 'adminUsers'}
            ]
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout', this.formData, {
                'Content-Type': 'application/json',
                'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
            })
            .then(res => {
                setTimeout(() => {
                    this.$router.replace('/login');
                }, 1000);                
            })
            .catch(err => {
                setTimeout(() => {
                    this.$emit('logoutError', true);
                }, 1000);
            });
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .navbar {
        width: 90%;
        margin: 0 auto;
        @include flex(row nowrap, space-between, center);

        .logo {
            font-size: 1.5em;
        }

        .nav-menu {
            list-style: none;
            margin: 0;
            @include flex(row nowrap, space-around, center);

            .nav-item {
                margin: 0 10px;

                .nav-link {
                    display: block;
                    text-transform: uppercase;
                    text-decoration: none;
                    color: $link;
                    font-size: 1.2em;
                    transition: color .25s ease-out, transform .25s ease-in-out;

                    &:hover {
                        transform: scale(1.1);
                        color: $linkHover;
                    }
                }
            }
        }
    }
</style>
