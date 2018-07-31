<template>
    <div class="login">
        <transition name="appear">
            <span class="errors" v-if="showErrors">Los datos ingresados no existen en nuestros registros, intenta nuevamente</span>
        </transition>
        <div class="logo">
            <img src="@img/brand/logo.svg" alt="Logo Mira Que Lindo">
        </div>
        <mira-form @submitError="showErrors = $event"></mira-form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from './components/LoginForm.vue';
export default {
    data() {
        return {
            showErrors: false
        }
    },
    components: {
        'mira-form': Form
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .login {
        width: 100%;
        height: 100vh;
        @include flex(column nowrap, center, center);
        background-color: $adminBg;
        
        .logo {
            height: 80px;
            margin-bottom: 40px;

            img {
                height: 100%;
            }
        }
        .errors {
            position: absolute;
            display: block;
            top: 70px;
            left: 50%;
            width: 100%;
            transform: translate(-50%, 0);
            font-size: 1.2em;
            color: $errors;
        }
    }

    .appear-enter-active, .appear-leave-active {
        transition: opacity .4s ease-in-out;
    }
    .appear-enter, .appear-leave-to {
        opacity: 0;
    }
</style>



