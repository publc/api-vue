<template>
    <div :class="openNavbar ? 'navbar open' : 'navbar'">
        <ul class="nav-menu">
            <a href="#" 
                class="bars" 
                @click.prevent="openNavbar = !openNavbar">
                <span></span>
                <span></span>
                <span></span>
            </a>
            <div class="logo">
                <img src="@img/brand/logo.svg" alt="Logo Mira Que Lindo">
            </div>
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
            ],
            openNavbar: false
        }
    },
    methods: {
        logout() {
            axios.post('api/logout', this.formData, {
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
        position: fixed;
        top: 0;
        right: -200px;
        width: 200px;
        height: 100vh;
        border-left: 1px solid rgba($link, .3);
        box-shadow: -1px 0 2px rgba($link, .3);
        background-color: $adminBg;
        @include flex(row nowrap, start, start);
        transition: transform .5s ease-out;

        &.open {
            transform: translateX(-220px);
        }

        .bars {
            position: absolute;
            top: 30px;
            right: 199px;
            width: 30px;
            height: 30px;
            @include flex(column nowrap, space-around, start);
            padding: 5px;
            border-left: 1px solid rgba($link, .3);
            border-top: 1px solid rgba($link, .3);
            border-bottom: 1px solid rgba($link, .3);
            border-top-left-radius: 5px; 
            border-bottom-left-radius: 5px; 
            box-shadow: -1px 0 2px rgba($link, .3);
            background-color: $adminBg;
            cursor: pointer;

            span {
                display: block;
                width: 100%;
                height: 3px;
                background-color: $link;
            }
        }

        .logo {
            height: 50px;
            margin-bottom: 20px;

            img {
                height: 100%;
            }
        }

        .nav-menu {
            list-style: none;
            width: 100%;
            margin: 0;
            padding: 40px 0;
            @include flex(column nowrap, start, center);

            .nav-item {
                width: 100%;
                margin: 5px 0;

                .nav-link {
                    display: block;
                    width: 100%;
                    padding: 10px 0;
                    text-transform: uppercase;
                    text-decoration: none;
                    color: $link;
                    font-size: 1.2em;
                    transition: color .25s ease-out, transform .25s ease-in-out, background-color .25s ease-out;

                    &:hover {
                        transform: scaleX(1.1);
                        color: $mainWhite;
                        background-color: $bgLinkMini;
                    }
                }
            }
        }
    }
</style>
