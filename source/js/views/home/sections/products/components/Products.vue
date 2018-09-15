<template>
    <div class="main-product" rel="product--js">
        <a href="#"
            class="back-btn" 
            @click.prevent="$emit('backToCategories', {show: true})">volver
        </a>
        <a href="#" :class="innactiveCaretLeft ? 'caret-left inactive' : 'caret-left'"
            @click.prevent="prev">
            <span :class="innactiveCaretLeft ? 'caret-circle inactive' : 'caret-circle'"></span>
        </a>
        <transition name="show" mode="out-in" :appear="true">
            <div class="gallery-product" v-if="showGallery">
                <div class="image-container" v-for="(product, i) in products" :key="i">
                    <img class="product-image" :src="`/img/products/${product.image}`" alt="producto">
                </div>
            </div>
        </transition>
        <a :class="innactiveCaretRight ? 'caret-right inactive' : 'caret-right'"
            @click.prevent="next">
            <span :class="innactiveCaretRight ? 'caret-circle inactive' : 'caret-circle'"></span>
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return{
            showGallery: true,
            innactiveCaretLeft: false,
            innactiveCaretRight: false
        }
    },
    props: ['products', 'paginate'],
    mounted() {
        if(window.innerWidth > 1040) {
            var gallery = document.querySelector('[rel=product--js]');
            gallery.style.minHeight = '355px';
        }
        console.log(this.paginate);
        this.innactiveCaretLeft = this.paginate.prev_page === null;
        this.innactiveCaretRight = this.paginate.next_page === null;
    },
    methods: {
        prev() {
            var prevPage = this.paginate.prev_page;
            this.innactiveCaretLeft = this.paginate.prev_page === null || (this.paginate.current_page - 1) === 1;
            if(prevPage !== null) {
                this.innactiveCaretRight = false;
                this.showGallery = false;
                this.$emit('changePage', {page: prevPage});
                setTimeout(() => {
                    this.showGallery = true;
                }, 100);
            }
        },
        next() {
            var nextPage = this.paginate.next_page;
            this.innactiveCaretRight = this.paginate.next_page === null || (this.paginate.current_page + 1) >= this.paginate.max_page;
            if(nextPage !== null) {
                this.innactiveCaretLeft = false;
                this.showGallery = false;
                this.$emit('changePage', {page: nextPage});
                setTimeout(() => {
                    this.showGallery = true;
                }, 100);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    @import '~@styles/app.scss';
    .main-product {
        width: 100%;
        @include flex(column wrap, flex-start, flex-start);

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

        .caret-left, .caret-right {
            position: absolute;
            top: 45%;
            font-size: 3em;
            width: 50px;
            height: 50px;
            cursor: pointer;

            &::before, &::after {
                content: '';
                position: absolute;
                display: block;
                width: 15px;
                height: 2px;
                background-color: $mainBlack;  
            }

            &.inactive {
                &::before, &::after {
                    background-color: $mainWhite;
                    z-index: 1000;  
                }
            }
            
        }

        .caret-left {
            left: 40px;

            &::before {
                transform: rotate(-45deg);
                top: -7.5px;
            }

            &::after {
                transform: rotate(45deg);
                top: 2.5px;
            }

            .caret-circle {
                display: block;
                position: absolute;
                top: -22px;
                left: -11px;
                width: 40px;
                height: 40px;
                border: 1px solid $mainBlack;
                border-radius: 50%;

                &.inactive {
                    background-color: rgba($mainBlack, .7);
                    border: 1px solid $mainWhite;
                }
            }
        }

        .caret-right {
            right: 40px;

            &::before {
                transform: rotate(45deg);
                top: -7.5px;
                right: 0;
            }

            &::after {
                transform: rotate(-45deg);
                top: 2.5px;
                right: 0;
            }

            .caret-circle {
                display: block;
                position: absolute;
                top: -22px;
                right: -11px;
                width: 40px;
                height: 40px;
                border: 1px solid $mainBlack;
                border-radius: 50%;

                &.inactive {
                    background-color: rgba($mainBlack, .7);
                    border: 1px solid $mainWhite;
                }
            }
        }

        .gallery-product {
            width: 90%;
            position: relative;
            @include flex(row wrap, space-around, center);
            margin: 20px auto 0 auto;

            .image-container {
                width: 250px;
                height: 125px;
                border: 1px solid rgba($mainBlack, .2);
                border-radius: 5px;
                @include flex(row nowrap, center, center);
                overflow: hidden;
                margin-bottom: 20px;

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

    .show-enter-active, .show-leave-active {
        transition: opacity .5s ease-in;
    }

    .show-enter, .show-leave-to {
       opacity: 0; 
    }

    @media screen and (max-width: 500px) {
        .main-product {
            .caret-left {
                left: 35px;

                &::before, &::after {
                    width: 12px;
                }
                &::before {
                    top: -6.5px;

                }

                &::after {
                    top: 1.5px;
                }

                .caret-circle {
                    top: -18px;
                    left: -7px;
                    width: 30px;
                    height: 30px;
                }
            }

            .caret-right {
                right: 35px;

                &::before, &::after {
                    width: 12px;
                }

                &::before {
                    top: -6.5px;
                }

                &::after {
                    top: 1.5px;
                }

                .caret-circle {
                    top: -18px;
                    right: -7px;
                    width: 30px;
                    height: 30px;
                }
            }

            .gallery-product {
                .image-container {
                    width: 130px;
                    height: 100px;
                }
            }
        }
    }
</style>
