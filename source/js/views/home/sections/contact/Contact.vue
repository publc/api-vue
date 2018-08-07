<template>
    <section class="contact" rel="contact-section--js">
        <div class="contact-left">
            <img class="logo" src="@img/brand/logo.svg" alt="Logo mira que lindo" rel="butter--js">
            <img class="butter butter-1" src="@img/brand/butter_5.svg" alt="Mariposa" rel="butter--js">
            <p class="text">Telefono: (011) 15 3788-5222</p>
            <p class="text">Correo: miraquelindodeco@gmail.com</p>
            <img class="butter butter-2" src="@img/brand/butter_2.svg" alt="Mariposa" rel="butter--js">
            <img class="butter butter-3" src="@img/brand/butter_6.svg" alt="Mariposa" rel="butter--js">
        </div>
        <mira-contact-form class="contact-right"></mira-contact-form>
    </section>
</template>

<script>
import ContactForm from './components/ContactForm.vue';
export default {
    components: {
        'mira-contact-form': ContactForm
    }
}
</script>


<style lang="scss" scoped>
@import '~@styles/app.scss';

    .contact {
        position: relative;
        top: 150px;
        @include container;
        @include flex(row wrap, space-between, center);
        margin-bottom: 50px;

        .contact-right {
            width: 40%;
            position: relative;
        }

        .contact-left {
            position: relative;
            width: 60%;

            .text {
                font-size: 1.5em;
            }

            .logo {
                position: absolute;
                display: block;
                width: 15%;
                top: -150%;
                left: 50%;
                transform: translateX(-50%);
            }

            .butter {
                position: absolute;
                display: block;
                width: 10%;
            }

            .butter-1 {
                top: -50%;
                left: 70%;
            }

             .butter-2 {
                bottom: -120%;
                left: 55%;
            }

             .butter-3 {
                top: -40%;
                left: 20%;
            }
        }
    }

    @media screen and (max-width: 780px) {
        .contact {
            top: 250px;
            @include flex(column wrap, center, center);
            margin-bottom: 100px;

            .contact-right {
                width: 100%;
            }

            .contact-left {
                width: 100%;

                .text {
                    font-size: 1.5em;
                }

                .logo {
                    top: -80%;
                }

                .butter {
                    position: absolute;
                    display: block;
                    width: 10%;
                }

                .butter-1 {
                    top: -50%;
                    left: 70%;
                }

                .butter-2 {
                    bottom: -120%;
                    left: 55%;
                }

                .butter-3 {
                    top: -40%;
                    left: 20%;
                }
            }
        }
    }
</style>
