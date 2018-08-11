<template>
    <section class="products" rel="products-section--js">
        <div class="content">
            <div class="gallery">
                <mira-product-categories 
                v-if="showCategories"
                :categories="categories" 
                @showCategories="productsToShow($event)"></mira-product-categories>
                <mira-product-products 
                v-else
                :products="products"
                :paginate="paginate"
                @backToCategories="backToCategories($event)"
                @changePage="changePage($event)"></mira-product-products>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import Categories from './components/Categories.vue';
import Products from './components/Products.vue';
export default {
    data() {
        return {
            categories: ['mosaiquismo', 'tapiceria', 'decoupage', 'seminarios'],
            dataToSend: {
                category: 'mosaiquismo',
                page: 1,
                limit: 8
            },
            products: [],
            paginate: {},
            showCategories: true
        }
    },
    components: {
        'mira-product-categories': Categories,
        'mira-product-products': Products
    },
    methods: {
        productsToShow(event) {
            this.showCategories = event.show;
            this.dataToSend.category = event.category;
            this.getCategoryProducts();
        },
        backToCategories(event) {
            this.showCategories = event.show;
        },
        changePage(event) {
            this.dataToSend.page = event.page;
            this.getCategoryProducts();
        },
        getCategoryProducts() {
            var vm = this;
            axios.post('api/products/view', this.dataToSend, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'                    
                }
            })
            .then(res => {
                vm.products = res.data.products;
                vm.paginate = res.data.paginate;
            })
            .catch(err => {
                console.log(err);
            })
        }
    },
    mounted() {
        if(window.innerWidth < 780) {
            this.dataToSend.limit = 4
        }

        var vm = this;
        axios.post('api/products/view', this.dataToSend, {
            headers: {
                'Content-Type': 'application/json',
                'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'                    
            }
        })
        .then(res => {
            vm.products = res.data.products;
            vm.paginate = res.data.paginate;
        })
        .catch(err => {
            console.log(err);
        })
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .products {
        position: relative;
        top: 100px;
        @include container;
        @include flex(column nowrap, flex-start, center);
        padding: 20px;
        border: 1px solid rgba($mainBlack, .3);
        border-radius: 5px;
        box-shadow: 0 0 10px 2px rgba($mainBlack, .3);

        .content {
            width: 100%;
            height: 100%;
            @include flex(row nowrap, center, center);
            border: 1px solid rgba($mainBlack, .3);
            border-radius: 5px;
            padding: 20px;

            .gallery {
                width: 100%;
                
                .gallery-categories {
                    font-size: 1.5em;
                }

                .gallery-products {
                    font-size: 1.5em;
                }
            }
        }
    }
</style>
