<template>
    <nav class="navbar">
        <div>
            <img class="logo" src="../../../assets/img/brand/logo.svg" alt="Logo Mira Que Lindo">
        </div>
        <ul class="navbar-menu">
            <li class="navbar-item">
                <router-link class="navbar-link" to="/seminarios">Seminarios</router-link>
            </li>
            <li class="navbar-item">
                <router-link class="navbar-link" to="/productos">Productos</router-link>
            </li>
            <li class="navbar-item">
                <router-link class="navbar-link" to="/nosotros">Nosotros</router-link>
            </li>
            <li class="navbar-item">
                <router-link class="navbar-link" to="/contacto">Contacto</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
    }
}
</script>

<style lang="scss" scoped>
    .navbar {
        width: 100%;
        height: 60px;
        padding: 10px 50px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;

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


