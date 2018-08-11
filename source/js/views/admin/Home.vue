<template>
    <div class="admin-home">
        <h1 class="title">Bienvenidos al Administrador de Mira Que Lindo</h1>
        <p class="content">Selecciona de la barra de navegaci&oacute;n una acci&oacute;n para continuar</p>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
    .admin-home {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 60vh;
        z-index: -1;

        .title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .content {
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    }
</style>
