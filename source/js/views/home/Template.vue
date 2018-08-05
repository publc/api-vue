<template>
    <div>
        <div class="start" v-if="loading">
            <div :class="loadClass ? 'top open' : 'top'"></div>
            <div :class="loadClass ? 'bottom open' : 'bottom'"></div>
        </div>
        <transition name="appear" :appear="true">
            <div >
                <nya-header></nya-header>
                <nya-home></nya-home>
                <nya-principal-products></nya-principal-products>
                <nya-products></nya-products>
                <nya-about></nya-about>
                <nya-contact></nya-contact>
            </div>
        </transition>
    </div>
</template>

<script>
import Header from '@cmp/Header.vue';
import Home from './home/Home.vue';
import PrincipalProducts from '@cmp/PrincipalProducts.vue';
import Products from './products/Products.vue';
import About from './about/About.vue';
import Contact from './contact/Contact.vue';
export default {
    data() {
        return {
            loading: true,
            loadClass: false
        }
    },
    components: {
        'nya-header': Header,
        'nya-home': Home,
        'nya-principal-products': PrincipalProducts,
        'nya-products': Products,
        'nya-about': About,
        'nya-contact': Contact,
    },
    mounted() {
        setTimeout(() => {
            this.loadClass = true;
        }, 1000);

        setTimeout(() => {
            this.loading = false;
        }, 2100);
        
    }
}
</script>


<style lang="scss" scoped>
@import '~@styles/styles.scss';
    .start {
        position: fixed;
        width: 100%;
        height: 100vh;
        @include flex(column nowrap, space-between);
        z-index: 5000;

        .top, .bottom {
            display: block;
            width: 100%;
            height: 49.7%;
            transition: height 1s ease-out;

            &.open {
                height: 0;
            }
        }

        .top {
            background-color: rgba(20,20,20, .99);
            border-bottom: 1px solid rgba(20,20,20, .5);
            box-shadow: 0 4px 15px rgba(#212121, .95);
        }

        .bottom {
            background-color: rgba(20,20,20, .99);
            border-top: 1px solid rgba(20,20,20, .5);
            box-shadow: 0 -4px 15px rgba(#212121, .95);
        }
    }

    .appear-enter-active, .appear-leave-active {
        transition: opacity 1s .5s;
    }
    .appear-enter, .appear-leave-to {
        opacity: 0;
    }
</style>





