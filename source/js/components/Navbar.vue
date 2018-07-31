<template>
    <div class="navbar">
            <a href="#" class="logo" @click.prevent="navigate('home')">nya</a>
            <ul class="nav-menu">
                <li class="nav-item" v-for="(link, i) in links" :key="i">
                    <a :href="`#${link.link}`" 
                        class="nav-link" 
                        @click.prevent="navigate(link.link)">{{ link.name }}</a>
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
        @include flex(row nowrap, flex-end, flex-start);
       
        .logo {
            position: absolute;
            top: 20px;
            left: 50px;
            color: $white;
            font-size: 1.2em;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
        }

        .nav-menu {
            flex-basis: 50%;
            height: 50%;
            @include flex(row nowrap, space-around);
            margin: 0;
            padding: 0;
            background-color: $white;
            list-style: none;
            border-bottom-left-radius: 5px;

            .nav-item {

                .nav-link {
                    @include link($text, .85em, 0 30px);
                    text-shadow: 1px 1px rgba($shadow, .5);
                }
            }
        }
    }
</style>
