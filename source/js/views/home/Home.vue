<template>
    <div class="home-container">
        <mira-navbar></mira-navbar>
        <mira-principal></mira-principal>
        <mira-seminars></mira-seminars>
        <mira-products></mira-products>
        <mira-about></mira-about>
        <mira-contact></mira-contact>
        <mira-contact-btn class="contact-btn" rel="contact-btn--js"></mira-contact-btn>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Principal from './sections/principal/Principal.vue';
import Seminars from './sections/seminars/Seminars.vue';
import Products from './sections/products/Products.vue';
import About from './sections/about/About.vue';
import Contact from './sections/contact/Contact.vue';
import ContactBtn from './components/Contact.vue';
export default {
    components: {
        'mira-navbar': Navbar,
        'mira-principal': Principal,
        'mira-seminars': Seminars,
        'mira-products': Products,
        'mira-about': About,
        'mira-contact': Contact,
        'mira-contact-btn': ContactBtn
    },
    mounted() {
        var contactBtn = document.querySelector('[rel=contact-btn--js]');
        contactBtn.style.opacity = '0';
        setTimeout(() => {
            contactBtn.style.opacity = '1';
        }, 3500);
    }
}
</script>

<style lang="scss"scoped>

    .contact-btn {
        position: fixed;
        bottom: 2%;
        right: 2%;
        transition: opacity .5s ease-out;
    }

    @media screen and (max-width: 780px) {
        .contact-btn {
            bottom: 10%;
        }
    }

</style>


