<template>
    <section class="seminars" rel="seminars-section--js">
        <mira-menu class="left-box" rel="seminar-left-box--js"></mira-menu>
        <mira-seminar class="right-box" rel="seminar-right-box--js"></mira-seminar>
    </section>
</template>

<script>
import Seminar from './components/Seminar.vue';
import Menu from './components/Menu.vue';
export default {
    data() {
        return {

        }
    },
    components: {
        'mira-seminar': Seminar,
        'mira-menu': Menu
    },
    mounted() {
        var rightBox = document.querySelector('[rel=seminar-right-box--js]');
        var leftBox = document.querySelector('[rel=seminar-left-box--js]');

        leftBox.style.height = rightBox.clientHeight + 'px';
    }
}
</script>



<style lang="scss" scoped>
    .seminars {
        position: relative;
        top: 50px;
        padding-top: 50px; 
        display: flex;
        flex-flow: row nowrap;
        justify-content: start;
        align-items: start;

        .left-box {
            width: 15%;
        }

        .right-box {
            width: 82.5%;
            height: 100%;
        }
    }
</style>
