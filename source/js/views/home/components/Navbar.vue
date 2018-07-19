<template>
    <nav class="navbar">
        <div>
            <img class="logo" src="@img/brand/logo.svg" alt="Logo Mira Que Lindo">
        </div>
        <ul class="navbar-menu">
             <li class="navbar-item" v-for="(item, i) in navbarItems" :key="i">
                <router-link class="navbar-link" :to="item.to">{{ item.title }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            navbarItems: [
                {to: '/', title: 'Home'},
                {to: '/seminarios', title: 'Seminarios'},
                {to: '/productos', title: 'Productos'},
                {to: '/nosotros', title: 'Nosotros'},
                {to: '/contacto', title: 'Contacto'}
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
    .navbar {
        width: 100%;
        height: 80px;
        padding: 0 80px;
        position: absolute;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        z-index: 2000;

        .logo {
            height: 60px;
        }

        .navbar-menu {
            list-style: none;
            margin: 0;
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-around;
            align-items: center;

            .navbar-item {
                margin: 0 10px;

                .navbar-link {
                    display: block;
                    text-transform: uppercase;
                    text-decoration: none;
                    color: #606060;
                    font-size: 1em;
                    transition: color .25s ease-out, transform .25s ease-in-out;

                    &:hover {
                        transform: scale(1.1);
                        color: #202020;
                    }
                }
            }
        }
    }
</style>


