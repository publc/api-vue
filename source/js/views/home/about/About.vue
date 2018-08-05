<template>
    <section id="about" class="about">
        <div class="inner"></div>
        <div class="main">
            <p class="description">Nuestros perfumes nacionales están en el mismo nivel que los que importamos, la aceptación ha sido tan impactante que sobrepasó todas las proyecciones calculadas para lograr dicho resultado, contamos con el constante apoyo de nuestra compañía de Francia, que como factor principal, nos provee de lo que nosotros consideramos, es la materia prima más importante para desarrollar un excelente perfume...</p>
            <h2 class="title">Made In France</h2>
        </div>
    </section>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';    
    .about {
        position: relative;
        width: 100%;
        height: 100vh;
        top: -150px;

        &::before, &::after {
            content: '';
            position: absolute;
            left: 0;
            display: block;
            width: 100%;
            height: 25px;
            z-index: 2000;
        }

         &::before {
            top: -30px;
            box-shadow: 0 10px 20px 5px $white, 0 30px 50px 5px $white;
        }

        .inner {
            width: 100%;
            height: 100vh;
            background-image: url('~@img/brand/about-bg.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            filter: grayscale(100%);
        }

        .main {
            position: absolute;
            @include container;
            @include flex(column nowrap);
            height: 80%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px 80px;
            color: $text;
            background-color: rgba($white, .4);
            border-radius: 5px;
            box-shadow: 0 10px 25px 4px $text;

            .description {
                text-shadow: 1px 1px rgba($text, .6);
            }

            .title {
                text-shadow: 2px 2px rgba($text, .6);
            }

            .description {
                font-size: 1.5em;
                line-height: 32px;
                letter-spacing: 2px;
            }

            .title {
                font-size: 2.8em;
                font-weight: 600;
                margin-top: 60px;

                &::after {
                    content: '';
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                    display: block;
                    width: 13%;
                    height: 2px;
                    margin-top: 20px;
                    background-color: $text;
                }
            }
        }
    }
</style>
