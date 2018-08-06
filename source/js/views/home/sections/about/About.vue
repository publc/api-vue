<template>
    <section class="about" rel="about-section--js">
        <div class="about-content" v-if="showContent">
            <p>Mira Que Lindo surge hace unos años cuando ser mama ocupaba el 100% de mi tiempo… mi primer hijo arranco el jardín y me pregunté… Que hago ahora? El 1er año de Joaqui en el jardín me recibí de profe de pilates… Estudié marketing a través de le web y como quería más empecé a ir a diferentes seminarios… Aprendi a hacer tapicería, me metí de lleno con el decoupage sobre todas las superficies, aprendi a hacer lamparas, aprendi mosaiquismo… Desde chica que soy emprendedora y busco aprender todo el tiempo. Siento que tengo la virtud de transformar y me encanta contarles a los demás todo lo que aprendí y aprendo a diario…</p>
            <p>Siento que el Arte se debe pasar de boca en boca para que quien lo desee lo pueda hacer</p>
            <p>Soy una mujer con ganas de mostrar y enseñar su arte.</p>
            <p>Ser ArteSana es tener la virtud de hacer</p>
        </div>
        <transition name="slide-right" :appear="true">
            <div class="about-image" v-if="showContent">
                <img src="@img/brand/about.jpg" alt="mira que lindo">
            </div>
        </transition>
    </section>
</template>

<script>
export default {
    data() {
        return {
            showContent: false
        }
    },
    mounted() {
        var section = document.querySelector('[rel=about-section--js]')
        var bounding;
        document.addEventListener('scroll', (event) => {
            bounding = section.getBoundingClientRect();
            if (bounding.top < 550) {
                this.showContent = true;
            } else {
                this.showContent = false;
            }
        });
    }
}
</script>


<style lang="scss" scoped>
@import '~@styles/app.scss';

    .about {
        position: relative;
        top: 150px;
        @include flex(row wrap, space-between, center);
        @include container;
        margin-bottom: 50px;
        overflow: hidden;

        .about-content {
            width: 65%;
            font-size: 1.2em;
            line-height: 28px;
            letter-spacing: .7px;
            text-shadow: 1px 1px rgba($mainBlack, .25);
        }

        .about-image {
            width: 35%;
            @include flex(row wrap, center, center);

            img {
                display: block;
                border-radius: 5px;
                width: 80%;
                box-shadow: 1px 1px 10px 3px rgba($mainBlack, .8);
            }
        }
    }

    .slide-right-enter-active, .slide-right-leave-active {
        transition: opacity .8s .6s ease-in-out;
    }

    .slide-right-enter, .slide-right-leave-to {
        opacity: 0;
    }
</style>
