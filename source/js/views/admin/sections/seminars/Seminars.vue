<template>
    <div>
        <div class="container" v-if="$route.name === 'adminSeminars'">
            <mira-principal-btn :button="createButton"></mira-principal-btn>
            <p>Sayyyyyyyy heloooooooo Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque quas doloribus cupiditate? Eaque doloremque at nam ducimus excepturi nostrum numquam reiciendis, tenetur distinctio ratione quo fugit quos quam tempore aliquam!</p>
        </div>
        <div class="container" v-else>
            <mira-principal-btn :button="backButton"></mira-principal-btn>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import PrincipalBtn from '../../components/PrincipalBtn.vue';
export default {
    data() {
        return {
            createButton: {link: 'adminCreateSeminar', title: 'crear seminario'},
            backButton: {link: 'adminSeminars', title: 'volver'}
        }
    },
    components: {
        'mira-principal-btn': PrincipalBtn
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    .container {
        @include container;
        @include flex(column nowrap, start, start);
    }
</style>
