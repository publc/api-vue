<template>
    <div class="navbar">
        <div class="hamburguer">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-menu">
            <li class="nav-item" v-for="(link, i) in links" :key="i">
                <a :href="`#${link.link}`" 
                    class="nav-link" 
                    @click.prevent="navigation">{{ link.name }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: [
                {name: 'home', link:'home'},
                {name: 'productos', link:'products'},
                {name: 'nosotros', link:'about'},
                {name: 'contacto', link:'contact'}
            ]
        }
    },
    methods: {
        navigate(link) {
            var element = document.querySelector(`#${link}`);
            element.scrollIntoView({
                base: 'start',
                behavior: 'smooth'
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@import url('~@styles/styles.scss');
    .navbar {
        position: fixed;
        top: 0;
        right: -250px;
        width: 280px;
        height: 100vh;
        @include flex(column nowrap, start, center);

        .hamburguer {
            position: fixed;
            top: 30px;
            right: 0;
            width: 40px;
            height: 40px;
            @include flex(column nowrap, space-around, center);

            span {

            }
        }  

        .nav-menu {
            @include flex(row nowrap, start);
            margin: 0;
            list-style: none;

            .nav-item {
                margin: 0 10px;

                .nav-link {
                    @include link($text, 1em, 0 20px);
                    text-shadow: 1px 2px 1px $shadow;
                }
            }
        }
    }
</style>

