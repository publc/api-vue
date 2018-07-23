<template>
    <div>
        <a class="network" href="https://www.facebook.com/miraquelindodeco/" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="network" href="https://www.instagram.com/miraquelindodecoydiseno/" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
</template>

<style lang="scss" scoped>
    .network {
        width: 40px;
        height: 40px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        font-size: 1.5em;
        color: #fafafa;
        background-color: #202020;
        border-radius: 50%;
        transition: transform .25s ease-out;

        &:hover {
            transform: scale(1.1);
        }
    }
</style>

