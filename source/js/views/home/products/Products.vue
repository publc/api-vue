<template>
    <section id="products" class="products">      
       <div class="gallery">
           <nya-product
            v-for="(product, i) in products" 
            :key="i" 
            :product="product"></nya-product>
       </div>
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
        position: relative;
        top: -200px;
        left: 0;
        width: 100%;
        padding: 5% 0;
        background-color: $border;

        &::after {
            content: '';
            position: absolute;
            top: -30px;
            left: 0;
            display: block;
            width: 100%;
            height: 25px;
            box-shadow: 0 10px 20px 5px $white, 0 30px 50px 5px $white;
        }

        .gallery {
            width: 90%;
            margin: 0 auto;
            padding: 20px 40px;
            border: 1px solid rgba($border, .4);
            box-shadow: 0 0 3px rgba($border, .4);
            @include flex(row wrap, space-around, space-around);
            background-color: $white;
        }
    }
    
</style>
