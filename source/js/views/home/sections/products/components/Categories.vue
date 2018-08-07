<template>
    <div class="categories-menu">
        <a href="#" class="category-link" 
            v-for="(category, i) in categories" :key="i"
            @click.prevent="$emit('showCategories', {category: category, show: false})">
            <p class="title">{{ category }}</p>
            <img :src="`/img/products/categories/${category}.jpg`" :alt="`categoria ${category}`">
        </a>
    </div>
</template>

<script>
export default {
    props: ['categories']
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .categories-menu {
        @include flex(row wrap, space-around, center);

        .category-link {
            position: relative;
            min-width: 300px;
            max-width: 320px;
            height: 130px;
            margin: 20px;
            @include flex(column nowrap, center, center);
            border: 1px solid rgba($mainBlack, .3);
            border-radius: 5px;
            overflow: hidden;

            .title {
                position: absolute;
                bottom: -20px;
                right: 0;
                display: block;
                color: $mainBlack;
                background-color: rgba($mainWhite, .8);
                padding: 5px 20px;
                border-radius: 5px;
                font-size: 1.3em;
                text-decoration: none;
            }

            img {
                display: block;
                width: 100%;
                transition: transform .3s ease-out;

                &:hover {
                    transform: scale(1.1) rotate(1deg);
                }
            }
        }
    }

    @media screen and (max-width: 500px) {
        .categories-menu {

            .category-link {
                min-width: 200px;
                max-width: 200px;
                height: 110px;
            }
        }
    }
</style>
