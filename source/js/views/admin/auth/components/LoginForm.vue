<template>
    <div>
        <form action="#" class="form" @submit.prevent="submit">
            <div class="form-item">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" 
                    name="email" 
                    id="email" 
                    class="form-input"
                    placeholder="Correo Electronico" 
                    v-model="formData.email">
                <span>{{errors.email}}</span>
            </div>
            <div class="form-item">
                <label for="password" class="form-label">Contrase&ntilde;a:</label>
                <input type="password" 
                    class="form-input" 
                    name="password" 
                    id="password"
                    placeholder="Contraseña"
                    v-model="formData.password">
                <span>{{errors.password}}</span>
            </div>
            <div class="form-remember">
                <input type="checkbox" 
                    class="form-input" 
                    name="remember" 
                    id="remember"
                    placeholder="Contraseña"
                    v-model="formData.remember">
                <label for="remember" class="form-label">Recordarme</label>
            </div>
            <div class="form-btn" v-if="!waitingSubmit">
                <a class="submit-btn" href="#" @click.prevent="submit">Ingresar</a>
            </div>
            <div class="animated-response" v-else>
                <div class="circles">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            formData: {email: null, password: null, remember: false},
            errors: {email: null, password: null},
            waitingSubmit: false
        }
    },
    methods: {
        submit() {
            this.formValidation();
            
            if (this.errors.email && this.errors.password) {
                return;
            }

            this.waitingSubmit = true;
            axios.post('api/login', this.formData, {
                'Content-Type': 'application/json',
                'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
            })
            .then(res => {
                setTimeout(() => {
                    this.waitingSubmit = false;
                    this.$router.replace('admin');
                }, 1000);                
            })
            .catch(err => {
                setTimeout(() => {
                    this.waitingSubmit = false;
                    this.$emit('submitError', true);
                }, 1000);

                setTimeout(() => {
                    this.$emit('submitError', false);
                }, 4000);
            });
        },
        formValidation() {
            this.errors.email = null;
            this.errors.password = null;

            if (!this.formData.password || this.formData.password.length < 6) {
                this.errors.password = 'Introduce una contraseña valida';
            }

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            if (!re.test(this.formData.email)) {
                this.errors.email = 'Introduce un email valido para continuar';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .form {
        @include flex(column nowrap, start, center);

        .form-item {
            min-width: 400px;
            padding: 10px 0;
            @include flex(column nowrap, center, start);

            .form-label {
                font-size: 1.4em;
            }

            .form-input {
                width: 100%;
                line-height: 30px;
                font-size: 1.3em;
                padding: 5px 10px;
                border-radius: 5px;
                border: 1px solid rgb(169, 169, 169);
            }
        }

        .form-remember {
            width: 100%;
            margin-top: 5px;
            font-size: 1.2em;
            @include flex(row nowrap, start, center);

            .form-input {
                transform: scale(1.3);
            }

            .form-label {
                margin-left: 10px;
            }
        }

        .form-btn {
            margin-top: 20px;

            .submit-btn {
                text-decoration: none;
                font-size: 1.5em;
                font-weight: 600;
                color: #2c3e50;
            }
        }

        .animated-response {
            width: 100%;
            height: 40px;
            @include flex;

            .circles {
                width: 100px;
                @include flex(row nowrap, space-around, center);
                
                span {
                    display: block;
                    width: 15px;
                    height: 15px;
                    border-radius: 50%;
                    background-color: #2c3e50;

                    &:nth-child(1) {
                        background: #2c3e50;
                        animation: slide-up 1s infinite linear;
                    }

                    &:nth-child(2) {
                        background: #2c3e50;
                        animation: slide-up 1s .3s infinite linear;
                    }

                    &:nth-child(3) {
                        background: #2c3e50;
                        animation: slide-up 1s .6s infinite linear;
                    }

                    @keyframes slide-up {
                        0% { transform: translateY(0) }
                        25% { transform: translateY(-5px) }
                        75% { transform: translateY(5px) }
                        100% { transform: translateY(0) }
                    }
                }                
            }
        } 
    }     
</style>