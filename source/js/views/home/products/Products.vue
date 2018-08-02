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
            products: [],
            paginate: {},
            page: 1,
        }
    },
    computed: {
        limit() {
            return window.innerWidth < 780 ? 4 : 8;
        }
    },
    components: {
        'nya-product': Product  
    },    
    mounted() {
        var vm = this;
        axios.post('api/products', { page: this.page, limit: this.limit}, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            console.log(res.data.products);
            console.log(res.data.paginate);
            vm.products = res.data.products;
            vm.paginate = res.data.paginate;
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
        padding: 10% 0;
        background-color: $mainBg;

        &::before, &::after {
            content: '';
            position: absolute;
            left: 0;
            display: block;
            width: 100%;
            height: 25px;
        }

         &::before {
            top: -30px;
            box-shadow: 0 10px 20px 5px $white, 0 30px 50px 5px $white;
        }

        &::after {
            bottom: -30px;
            box-shadow: 0 -10px 20px 5px $white, 0 -30px 50px 5px $white;
        }

        .gallery {
            width: 90%;
            margin: 0 auto;
            padding: 40px 40px;
            border: 1px solid rgba($border, .4);
            border-radius: 5px;
            box-shadow: 0 0 3px rgba($border, .4);
            @include flex(row wrap, space-around, space-around);
            background-color: $white;
        }
    }
    
</style>
