<template>
    <div>
        <mira-navbar v-if="!mini"></mira-navbar>
        <div class="mini-nav" v-else>
            <div class="logo">Admin</div>
            <mira-mini-navbar></mira-mini-navbar>
        </div>
        <router-view/>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import MiniNavbar from './components/MiniNavbar.vue';
export default {
    data() {
        return {
            mini: false
        }
    },
    components: {
        'mira-navbar': Navbar,
        'mira-mini-navbar': MiniNavbar
    },
    mounted() {
        if (window.innerWidth < 1040) {
            this.mini = true;
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';
    .mini-nav {
        width: 100%;
        height: 60px;
        font-size: 1.4em;
        @include flex;
    }
</style>


