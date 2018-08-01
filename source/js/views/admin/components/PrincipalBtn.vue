<template>
    <router-link :to="{name: button.link}" class="button">{{button.title}}</router-link>
</template>

<script>
export default {
    props: ['button']
}
</script>


<style lang="scss" scoped>
@import '~@styles/app.scss'; 
    .button {
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
</style>

