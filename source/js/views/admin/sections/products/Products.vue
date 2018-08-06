<template>
    <div class="products">
        <mira-modal :modal="modal" v-if="showModal" @modalResponse="modalResponse($event)"></mira-modal>
        <a href="#" class="create-btn" @click.prevent="createProduct">cargar producto</a>
        <mira-create-product v-if="showCreate" 
                @confirmCreate="confirmCreate($event)"></mira-create-product>
        <div class="main">
            <div class="menu">
                <h2 class="title">categorias</h2>
                <a class="link" href="#" 
                v-for="(category, i) in categories" 
                :key="i"
                @click.prevent="getProducts(category)">{{ category }}</a>
            </div>
            <div class="table">
                <div class="head">
                    <p class="title" v-for="(head, i) in heads" :key="i">{{ head }}</p>
                </div>
                <div class="body">
                    <div class="content" v-for="(product, i) in products" :key="i">
                        <p class="id">{{product.id}}</p>
                        <img :src="'/img/products/' + product.image" class="image">
                        <a href="#" class="delete-button" 
                            @click.prevent="confirmDeleteProduct(product.id)">eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CreateProduct from './CreateProduct.vue';
import Modal from '../../components/Modal.vue';
export default {
    data() {
        return {
            heads: ['id', 'photo', ''],
            categories: ['mosaiquismo', 'tapiceria', 'decoupage', 'seminarios'],
            showCreate: false,
            dataToSend: {category: 'mosaiquismo', page: 1, limit: 10},
            products: [],
            paginate: {},
            modal: {
                title: 'Eliminar Producto',
                description: 'Deseas eliminar el producto que seleccionaste',
                id: 0
            },
            showModal: false
        }
    },
    methods: {
        createProduct() {
            this.showCreate = true;
        },
        confirmCreate(event) {
            this.showCreate = event.show;
        },
        confirmDeleteProduct(id) {
            this.modal.id = id;
            this.showModal = true;
        },
        getProducts(category) {
            this.dataToSend.category = category
            this.sendGetCategory();
        },
        sendGetCategory() {
            var vm = this;
            axios.post('/api/products/show', this.dataToSend, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.products = res.data.products;
            })
            .catch(err => {
                console.log(err);
            })
        },
        deleteProduct(id) {
            var vm = this;
            axios.post('/api/products/destroy', {id: id}, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.products.forEach((el, index) => {
                    if(el.id == res.data.id) {
                        vm.$nextTick(function () {
                           vm.products.splice(index, 1);
                        }); 
                    }
                });                
            })
            .catch(err => {
                console.log(err);
            })
        },
        modalResponse(event) {
            this.showModal = event.show;
            if(event.confirm) {
                this.deleteProduct(event.id);
            }
        } 
    },
    components: {
        'mira-create-product': CreateProduct,
        'mira-modal': Modal
    },
    mounted() {
        this.sendGetCategory();
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    
    .products {
        width: 100%;
        @include container;
        @include flex(column nowrap, flex-start, flex-start);
        padding: 50px;
        border: 1px solid rgba($mainBlack, .2);
        border-radius: 10px;

        .create-btn {
            padding: 10px 20px;
            border: 1px solid $bgLinkMini;
            border-radius: 20px;
            font-size: 1.4em;
            text-decoration: none;
            color: $link;
            cursor: pointer;
            transition: background-color .4s ease-in-out;

            &:hover {
                background-color: $bgLinkMini;
                color: $mainWhite;
                font-weight: 600;
            }
        }

        .main {
            width: 100%;
            @include flex(row nowrap, space-between, flex-start);

            .menu {
                width: 20%;
                padding: 10px;
                @include flex(column nowrap, flex-start, center);

                .link {
                    width: 100%;
                    display: block;
                    padding: 10px 0;
                    font-size: 1.3em;
                    text-decoration: none;
                    color: #606060;
                    transition: color .3s ease-out, 
                    background-color .3s ease-out;

                    &:hover, &.active {
                        background-color:rgba(253, 182, 51, 0.95);
                        color: #fafafa;
                        font-weight: 600;
                    }
                }
            }

            .table {
                @include flex(column nowrap, flex-start, flex-start);
                width: 70%;
            
                .head {
                    width: 100%;
                    @include flex(row nowrap, space-around, flex-end);
                    font-size: 1.3em;
                    
                    .title {
                        width: 100%;
                        margin-right: 30px;
                        border-bottom: 1px solid rgba($mainBlack, .2);
                        border-right: 1px solid rgba($mainBlack, .2);
                    }
                }

                .body {
                    width: 100%;
                    @include flex(column nowrap, flex-start, center);
                    margin: 10px 0;
                    padding: 10px;
                    border-bottom: 1px solid rgba($mainBlack, .2);
                    border-top: 1px solid rgba($mainBlack, .2);
                    font-size: 1.3em;

                    .content {
                        width: 100%;
                        @include flex(row nowrap, space-around, center);

                        .image {
                            max-height: 80px;
                            max-width: 50px;
                        }

                        .delete-button {
                            @include tableBtn($errors);
                        }
                    }                    
                }
            }
        }        
    }
</style>
