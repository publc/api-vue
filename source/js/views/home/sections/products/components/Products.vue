<template>
    <div class="main">
        <a href="#"
            class="back-btn" 
            @click.prevent="$emit('backToCategories', {show: true})">volver
        </a>
        <div class="gallery-product">
            <div class="image-container" v-for="(product, i) in products" :key="i">
                <img class="product-image" :src="`/img/products/${product.image}`" alt="producto">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['products', 'paginate']
}
</script>

<style lang="scss" scoped>
    @import '~@styles/app.scss';
    .main {
        @include flex(column nowrap, flex-start, flex-start);
        width: 100%;

        .back-btn {
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

        .gallery-product {
            @include flex(row nowrap, space-around, space-around);
            margin-top: 20px;

            .image-container {
                width: 250px;
                height: 125px;
                border: 1px solid rgba($mainBlack, .2);
                border-radius: 5px;
                @include flex(row nowrap, center, center);
                overflow: hidden;

                .product-image {
                    display: block;
                    width: 100%;
                    transition: transform .2s ease-out;

                    &:hover {
                        transform: scale(1.1) rotate(1deg);
                    }
                }
            }
        }
    }
</style>
