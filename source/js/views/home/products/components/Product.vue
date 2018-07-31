<template>
    <div>
        <p> {{ product.name }}</p>
        <p> {{ product.description }}</p>
        <p> {{ product.image }}</p>
        <p> {{ product.sku }}</p>
    </div>
</template>

<script>
export default {
    props: ['product']
}
</script>

<style>

</style>
