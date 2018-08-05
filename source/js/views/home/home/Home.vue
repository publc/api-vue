<template>
    <section id="home" class="home">
        <div class="inner-bg"></div>
        <h1 class="title">fragancias nya</h1>
        <div class="networks">
            <a href="#" class="icon">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="icon">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    
}
</script>

<style lang="scss" scoped>
@import '~@styles/styles.scss';
    .home {
        position: relative;
        top: -100px;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;

        &::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 0;
            display: block;
            width: 100%;
            height: 25px;
            box-shadow: 0 -10px 20px 5px $white, 0 -30px 50px 5px $white;
        }
        
        .inner-bg {
            width: 100%;
            height: 100vh;
            background-image: url('~@img/brand/pr-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            animation: bg-scale 20s ease-in-out forwards;
        }

        @keyframes bg-scale {
            0% { transform: scale(1.2) rotate(0) translate(0, 0); }
            50% { transform: scale(1.2) rotate(.5deg) translate(20px, -50px) }
            100% { transform: scale(1.2) rotate(0) translate(0, 0) }
        }

        .title {
            position: absolute;
            bottom: 20%;
            right: 5%;
            font-size: 2.6em;
            font-weight: 500;
            text-transform: uppercase;
            color: rgba($white, .25);
            text-shadow: 1px 1px rgba($white, 0.2); 
            transform: translateY(-50%);
        }

        .networks {
            position: absolute;
            bottom: 12%;
            left: 3%;
            height: 80px;
            @include flex(column nowrap, space-around, center);

            .icon {
                @include link($white, 1.4em, 0);
            }
            
        }
    }   
    
</style>

