<template>
    <section id="products" class="products">      
       <nya-product 
            v-for="(product, i) in products" 
            :key="i" 
            :product="product"></nya-product>
    </section>
</template>

<script>
import axios from 'axios';
import Product from './components/Product.vue';
export default {
    data() {
        return {
            products: []
        }
    },
    components: {
        'nya-product': Product  
    },    
    mounted() {
        var vm = this;
        axios.get('api/products', {
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            vm.products = res.data.products;
        })
        .catch(err => {
            console.log(err);
        }); 
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';

    .products {
        width: 100%;
        position: relative;
        top: 0;
        height: 1000px;

        &::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 0;
            display: block;
            width: 100%;
            height: 25px;
            // background-color: beige;
            box-shadow: 0 -10px 20px 5px $white, 0 -30px 50px 5px $white;
        }
    }
</style>
