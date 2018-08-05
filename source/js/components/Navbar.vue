<template>
    <div class="navbar">
            <transition name="appear" :appear="true">
                <a href="#" class="logo" @click.prevent="navigate('home')">nya</a>
            </transition>
            <transition name="slide-down" :appear="true">
                <ul class="nav-menu">
                    <li class="nav-item" v-for="(link, i) in links" :key="i">
                        <a :href="`#${link.link}`" 
                            class="nav-link" 
                            @click.prevent="navigate(link.link)">{{ link.name }}</a>
                    </li>
                </ul>
            </transition>
        </div>
</template>

<script>
export default {
    data() {
        return {
            links: [
                {name: 'home', link:'home'},
                {name: 'fragancias', link:'products'},
                {name: 'nosotros', link:'about'},
                {name: 'contacto', link:'contact'}
            ]
        }
    },
    methods: {
        navigate(to) {
            var element = document.querySelector(`#${to}`);
            console.log(element);
            element.scrollIntoView({
                base: 'start',
                behavior: 'smooth'
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';
    .navbar {
        width: 100%;
        height: 80px;
        @include flex(row nowrap, center, flex-start);
       
        .logo {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            color: $white;
            font-size: 2em;
            font-weight: 800;
            text-transform: uppercase;
            text-decoration: none;
            text-shadow: 1px 2px 7px rgba($white, .6);
        }

        .nav-menu {
            flex-basis: 70%;
            height: 55%;
            @include flex(row nowrap, space-around);
            margin: 0;
            padding: 0 20px;
            background-color: rgba($white, .7);
            list-style: none;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;

            .nav-item {

                .nav-link {
                    @include link($text, .85em, 0 30px);
                    font-weight: 700;
                    letter-spacing: 2px;
                    text-shadow: 1px 1px rgba($shadow, .5);
                }
            }
        }
    }

    .appear-enter-active, .appear-leave-active {
        transition: opacity .7s 1.5s;
    }
    .appear-enter, .appear-leave-to {
        opacity: 0;
    }

    .slide-down-enter-active, .slide-down-leave-active {
        transition: transform .8s 2s;
    }
    .slide-down-enter, .slide-down-leave-to {
        transform: translateY(-80px);
    }
</style>
