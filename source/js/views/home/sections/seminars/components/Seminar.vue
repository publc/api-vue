<template>
    <transition name="fade-slide" :appear="true" mode="out-in">
        <div class="seminar" :key="seminar.id">
            <img src="@img/brand/logo.svg" alt="Mira Que Lindo" class="logo">
            <h2 class="title">{{ seminar.title }}</h2>
            <p class="subtitle">{{ seminar.subtitle }}</p>
            <div class="body">
                <div class="left-box">
                    <p class="knowledge">"{{ seminar.knowledge }}"</p>
                    <p class="expositor">{{ seminar.expositor }}</p>
                    <p class="place">{{ seminar.place }}</p>
                    <p class="place_phone">{{ seminar.contact }}</p>
                </div>
                <div class="right-box">
                    <p class="date">{{ seminar.date }}</p>       
                    
                    <div class="images">
                        <div class="images-group">
                            <div class="img-container">
                                <img :src="'/img/seminars/' + seminar.image_left" class="image" alt="image">
                            </div>
                            <p class="description">{{ seminar.image_left_title }}</p>
                        </div>
                        <div class="images-group">
                            <div class="img-container">
                                <img :src="'/img/seminars/' + seminar.image_right" class="image" alt="image">
                            </div>
                            <p class="description">{{ seminar.image_right_title }}</p>
                        </div>
                    </div>
                    <p class="limited">{{ limited }}</p>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['seminar'],
    computed: {
        limited() {
            return this.seminar.limited == '1' ? 'Cupos limitados' : 'Cupos ilimitados';
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .seminar {
        position: relative;
        width: 100%;
        background: #fdfdfd;
        border-radius: 5px;
        box-shadow: 0 0px 10px -3px #424242;

        .logo {
            height: 60px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .title {
            padding: 40px 10% 20px 10%;
            font-size: 4em;
            margin: 0;
            text-align: start;
        }

        .subtitle {
            padding: 0 20%;
            font-size: 3em;
            margin: 0;
            text-align: start;
        }

        .body {
            display: flex;
            flex-flow: row nowrap;
            justify-content: start;
            align-items: center;
            margin-top: 40px;
            padding-left: 20px;

            .left-box {
                width: 30%;
                padding: 30px 10px;
                display: flex;
                flex-flow: column nowrap;
                justify-content: center;
                align-items: center;
                background-color: rgba(255, 185, 55, 0.5);
                border-radius: 10px;
                box-shadow: 0px 0px 10px -2px #424242;

                .knowledge {
                    font-size: 1.5em;
                    margin: 0 0 40px 0;
                }

                .expositor, .place, .place_phone {
                    font-size: 1.3em;
                    margin: 0;
                    padding: 5px;
                }

            }

            .right-box {
                display: block;
                width: 70%;
                margin-top: -50px;
                margin-bottom: 100px;

                .date {
                    font-size: 3.5em;
                    margin: 0;
                    padding: 20px;
                }

                .limited {
                    font-size: 2em;
                    position: absolute;
                    bottom: 5px;
                    right: 5%;
                    margin: 0;
                    padding: 20px;
                }

                .images {
                    display: flex;
                    flex-flow: row nowrap;
                    justify-content: space-around;
                    align-items: center;

                    .images-group {
                        display: flex;
                        flex-flow: row nowrap;
                        justify-content: start;
                        align-items: center;

                        .img-container {
                            width: 160px;
                            height: 160px;
                            border-radius: 50%;
                            overflow: hidden;
                            display: flex;
                            flex-flow: row nowrap;
                            justify-content: center;
                            align-items: center;
                            box-shadow: 0 0 0 1px #2c3e50, 0 0 0 7px #fafafa, 0 0 0 8px #2c3e50;

                            .image {
                                display: block;
                                height: 100%;
                                cursor: pointer;
                                transition: transform .5s ease-out;

                                &:hover {
                                    transform: scale(1.2) rotate(5deg);
                                }
                            }

                        }

                        .description {
                            max-width: 120px;
                            padding: 0 10px;
                            margin: 0;
                            font-size: 1.5em;
                        }
                        
                    }      
                }
            }
        }
    }

    .fade-slide-enter-active, .fade-slide-leave-active {
        transition: opacity .25s, transform .5s ease-in-out;
        transform: rotateY(0deg);
    }

    .fade-slide-enter, .fade-slide-leave-to {
        opacity: 0.5;
        transform: rotateY(90deg);
    }
</style>


