<template>
    <div class="product">
        <p class="name">{{ product.name }}</p>
        <p class="sku">{{ product.sku }}</p>
        <p class="description" v-if="false">{{ product.description }}</p>
        <img class="image" :src="'/img/products/' + product.image" alt="Imagen">
        
    </div>
</template>

<script>
export default {
    props: ['product']
}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';

    .product {
        display: block;
        min-width: 150px;
        max-width: 250px;
        margin: 25px 0;
        border: 1px solid rgba($border, 0.4);
        border-radius: 5px;
        box-shadow: 1px 2px rgba($border, 0.2);
        overflow: hidden;      

        .image {
            width: 100%;
            display: block;
        }

        .name, .sku {
            position: relative;
            margin: 0;
        }

        .name {
            top: 25px;
            font-size: .9em;
        }

        .sku {
            top: 30px;
            font-size: .8em;
        }

    }
</style>
