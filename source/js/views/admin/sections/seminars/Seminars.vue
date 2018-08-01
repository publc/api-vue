<template>
    <div>
        <div class="container" v-if="$route.name === 'adminSeminars'">
            <mira-principal-btn :button="createButton"></mira-principal-btn>
            <mira-show-seminars></mira-show-seminars>
        </div>
        <div class="container" v-else>
            <mira-principal-btn :button="backButton"></mira-principal-btn>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import PrincipalBtn from '../../components/PrincipalBtn.vue';
import ShowSeminars from './ShowSeminars.vue';
export default {
    data() {
        return {
            createButton: {link: 'adminCreateSeminar', title: 'crear seminario'},
            backButton: {link: 'adminSeminars', title: 'volver'}
        }
    },
    components: {
        'mira-principal-btn': PrincipalBtn,
        'mira-show-seminars': ShowSeminars
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    .container {
        padding-top: 20px;
        @include container;
        @include flex(column nowrap, start, start);
    }
</style>
