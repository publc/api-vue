<template>
    <div>
        <nya-header></nya-header>
        <nya-home></nya-home>
        <nya-products></nya-products>
        <nya-about></nya-about>
        <nya-contact></nya-contact>
    </div>
</template>

<script>
import Header from '@cmp/Header.vue';
import Home from './home/Home.vue';
import Products from './products/Products.vue';
import About from './about/About.vue';
import Contact from './contact/Contact.vue';
export default {
    components: {
        'nya-header': Header,
        'nya-home': Home,
        'nya-products': Products,
        'nya-about': About,
        'nya-contact': Contact,
    }
}
</script>


<style lang="scss" scoped>

</style>





