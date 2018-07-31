<template>
    <div class="main">
        <transition name="appear">
            <div :class="responseError ? 'response error' : 'response success'" v-if="message">
                {{ message }}
            </div>
        </transition>
        <h2 class="title">cargar seminarios</h2>
        <form action="#" class="form" @submit.prevent="submit">
            <div class="left-form">
                <div class="form-item" v-for="(input, i) in inputs" :key="i">
                    <label :for="input.label" class="form-label">{{input.title}}</label>
                    <input :type="input.type" 
                        :name="input.label" 
                        :id="input.label" 
                        class="form-input"
                        :placeholder="input.placeholder" 
                        v-model="inputData[input.label]">
                    <span>{{ inputErrors[input.label] }}</span>
                </div>
            </div>
            <div class="right-form">
                <div class="form-item">
                    <label for="image_left_title" class="form-label">Nombre:</label>
                    <input type="text" 
                        name="image_left_title" 
                        id="image_left_title" 
                        class="form-input"
                        placeholder="Nombre de la imagen izquierda" 
                        v-model="inputData.image_left_title">
                    <span>{{ inputErrors.image_left_title }}</span>
                </div>
                <div class="form-item">
                    <label for="image_left" class="form-label">Imagen Izquierda</label>
                    <input type="file" 
                        name="image_left" 
                        id="image_left" 
                        class="form-input"
                        @change="imageLeftData">
                </div>
                <div class="form-item">
                    <label for="image_right_title" class="form-label">Nombre:</label>
                    <input type="text" 
                        name="image_right_title" 
                        id="image_right_title" 
                        class="form-input"
                        ref="image"
                        placeholder="Nombre de la imagen derecha" 
                        v-model="inputData.image_right_title">
                    <span>{{ inputErrors.image_right_title }}</span>
                </div>
                <div class="form-item">
                    <label for="image_right" class="form-label">Imagen Derecha</label>
                    <input type="file" 
                        name="image_right" 
                        id="image_right" 
                        class="form-input"
                        ref="image"
                        @change="imageRightData">
                </div>
                <div class="form-limited">
                    <input type="checkbox" 
                        class="form-input" 
                        name="limited" 
                        id="limited"
                        placeholder="Cupos limitados"
                        v-model="inputData.limited">
                    <label for="remember" class="form-label">Cupos limitados</label>
                </div>
                <div class="form-btn" v-if="!waitingSubmit">
                    <a class="submit-btn" href="#" @click.prevent="submit">Cargar Seminario</a>
                </div>
                <div class="animated-response" v-else>
                    <div class="circles">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
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
            inputData: {
                title: null,
                subtitle: null,
                place: null,
                knowledge: null,
                date: null,
                image_left_title: null,
                image_right_title: null,
                limited: false
            },
            inputErrors: {
                title: null,
                subtitle: null,
                place: null,
                knowledge: null,
                date: null,
                image_left_title: null,
                image_right_title: null,
                limited: false
            },
            formData: new FormData(),
            dataToSend: null,
            inputs: [
                {label: 'title', title: 'Titulo:', type: 'text', placeholder: 'Titulo del seminario'},
                {label: 'subtitle', title: 'Subtitulo:', type: 'text', placeholder: 'Subtitulo del seminario'},
                {label: 'place', title: 'Lugar:', type: 'text', placeholder: 'Lugar del seminario'},
                {label: 'knowledge', title: 'Conocimientos:', type: 'text', placeholder: 'Conocimientos Necesarios'},
                {label: 'date', title: 'Fecha:', type: 'date', placeholder: 'Fecha del seminario dd/mm/YY'}
            ],
            waitingSubmit: false,
            message: false,
            responseError: false
        }
    },
    methods: {
        submit() {
            var validate = this.validate();
            
            if (validate !== false) {
                
                this.inputData.limited = this.inputData.limited ? 1 : 0;

                Object.keys(this.inputData).forEach((key) => {
                    this.formData.append(key, this.inputData[key]);
                })
                this.dataToSend = this.formData;
                var vm = this;

                this.waitingSubmit = true;
                axios.post('/api/seminars/put', this.dataToSend, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    vm.message = 'Se han guardado los elementos con exito.';
                    vm.waitingSubmit = false;
                    setTimeout(() => {
                        vm.message = false;
                    }, 2500);              
                })
                .catch(err => {
                    vm.message = 'Ups no pudimos guardar la información intenta nuevamente.';
                    vm.responseError = true;
                    vm.waitingSubmit = false;
                    setTimeout(() => {
                        vm.message = false;
                        vm.responseError = false;
                    }, 2500)     
                });
            }
        },
        imageLeftData(event) {
            const file = event.target.files;
            this.formData.append('image_left', file[0]);
        },
        imageRightData(event) {
            const file = event.target.files;
            this.formData.append('image_right', file[0]);
        },
        validate() {
            var validate = true;
            Object.keys(this.inputData).forEach( key => {
                this.inputErrors[key] = null;
                if (!this.inputData[key]) {
                    this.inputErrors[key] = 'El campo es requerido para continuar';
                }

                if (this.inputErrors[key] !== null) {
                    validate = false;
                }
            });
            return validate;
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';
    .main {
        @include container;
        @include flex(column nowrap, start, start);

        .title {
            font-size: 1.8em;
            text-transform: uppercase;
        }

        .response {
            position: fixed;
            top: 80px;
            right: 0;
            padding: 15px 30px;
            font-size: 1.8em;
            color: $mainWhite;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;

            &.error {
                background-color: $errors
            }

            &.success {
                background-color: $success
            }
        }

        .form {
            width: 100%;
            @include flex(row nowrap, space-around, start);
            
            .left-form, .right-form {
                width: 40%;
                padding: 10px 20px;
                @include flex(column nowrap, start, start);
            }

            .form-item {
                min-width: 100%;
                padding: 10px 0;
                @include flex(column nowrap, center, start);

                .form-label {
                    font-size: 1.4em;
                    margin-bottom: 3px;
                }

                .form-input {
                    min-width: 100%;
                    line-height: 30px;
                    font-size: 1.3em;
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: 1px solid rgb(169, 169, 169);
                }
            }

            .form-limited {
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

        .appear-enter-active, .appear-leave-active {
        transition: opacity .4s ease-in-out;
        }

        .appear-enter, .appear-leave-to {
            opacity: 0;
        }
    }
</style>
