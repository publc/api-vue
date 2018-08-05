<template>
    <div class="product">
        <img class="image" 
            :src="`img/products/` + product.image" 
            alt="Imagen fragancia principal"
            v-for="(product, i) in products" :key="i">
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            products: [],
        }
    },
    mounted() {
        var vm = this;
        axios.get('api/best_products', {
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            vm.products = res.data.products
        })
        .catch(err => {
            console.log(err);
        }) 
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';

    .product {
        position: relative;
        top: -250px;
        left: 10px;
        width: 90%;
        @include flex(row wrap, space-around, center);
        margin: 0 auto;
        z-index: 2000;

        .image {
            width: 30%;
            min-width: 200px;
        }
    }
</style>
