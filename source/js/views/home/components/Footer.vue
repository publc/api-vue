<template>
    <footer class="footer">
        <p>&copy; - 2018. MiraQueLindo todos los derechos reservados</p>
        <p>diseño: publicidadLoCa</p>
        <div class="networks">
            <a class="facebook" href="https://www.facebook.com/miraquelindodeco/" target="_blank">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a class="instagram" href="https://www.instagram.com/miraquelindodecoydiseno/" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .footer {
        position: relative;
        top: 180px;
        display: block;
        width: 100%;
        padding: 5px;
        font-size: 1.2em;
        background-color: rgb(52, 20, 110);
        color: $mainWhite;

        .networks {
            width: 100%;
            font-size: 1.6em;

            .facebook, .instagram {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                color: $mainWhite;
                text-decoration: none;
                transition: transform .3s ease-out;

                &:hover {
                    transform: scale(1.1) translateY(-50%);
                }
            }

            .facebook {
                left: 25%;
            }

            .instagram {
                right: 25%;
            }
        }
    }

    @media screen and (max-width: 780px) {
        .footer {
            
            .networks {

                .facebook, .instagram {
                    top: 70%;
                }

                .facebook {
                    left: 25%;
                }

                .instagram {
                    right: 25%;
                }
            }
        }
    }

    @media screen and (max-width: 350px) {
        .footer {
            
            .networks {

                .facebook, .instagram {
                    top: 70%;
                }

                .facebook {
                    left: 5%;
                }

                .instagram {
                    right: 5%;
                }
            }
        }
    }
</style>
