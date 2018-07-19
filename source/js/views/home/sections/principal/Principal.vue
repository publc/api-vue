<template>
    <section class="principal">
       <mira-left-box class="left-box"></mira-left-box>
       <mira-right-box class="right-box"></mira-right-box>
    </section>
</template>

<script>
import LeftBox from './components/LeftBox.vue';
import RightBox from './components/RightBox.vue';
export default {
    components: {
        'mira-left-box': LeftBox,
        'mira-right-box': RightBox,
    }
}
</script>


<style lang="scss" scoped>
    .principal {
        width: 100%;
        height: 95vh;
        position: absolute;
        top: 0;
        display: flex;
        flex-flow: row nowrap;

        .left-box {
            width: 60%;
            display: flex;
            flex-flow: row nowrap;
        }

        .right-box {
            width: 40%;
        }
    }
</style>



