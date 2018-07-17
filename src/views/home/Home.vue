<template>
    <div>
        <mira-navbar></mira-navbar>
        <div v-if="$route.path === '/'">
            <mira-principal></mira-principal>
        </div>
        <router-view></router-view>
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

<style scoped>


</style>


