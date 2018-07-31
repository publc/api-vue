<template>
    <div class="header">
        <nya-navbar></nya-navbar>
    </div>
</template>

<script>
import Navbar from './Navbar.vue';
export default {
    components: {
        'nya-navbar': Navbar
    }
}
</script>

<style lang="scss" scoped>
    .header {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px;
        z-index: 2000;
    }
</style>
