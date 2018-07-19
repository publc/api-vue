<template>
    <div class="home-container">
        <mira-navbar class="navbar"></mira-navbar>
        <transition name='slide-fade'>
            <mira-principal v-if="$route.path === '/'"></mira-principal>
        </transition>
        <transition name='slide-fade'>
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Principal from './sections/principal/Principal.vue';
export default {
    components: {
        'mira-navbar': Navbar,
        'mira-principal': Principal
    }
}
</script>

<style lang="scss"scoped>

    .home-container {
        overflow: hidden;
        height: calc(100vh - 80px);
    }

    .slide-fade-enter-active {
        transition: transform .8s ease, opacity .8s ease;
    }
    .slide-fade-leave-active {
        transition: transform .8s .25s cubic-bezier(.17,.67,.72,.11), opacity .8s .25s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter {
        transform: translateY(600px);
        opacity: 0;
    }
    .slide-fade-leave-to {
        transform: translateY(-600px);
        opacity: 0;
    }


</style>


