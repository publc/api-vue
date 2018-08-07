<template>
    <div class="create-container">
        <transition name="appear">
            <div :class="responseError ? 'response error' : 'response success'" v-if="message">
                {{ message }}
            </div>
        </transition>
        <div class="create-main" @click.prevent="$emit('confirmCreate', {show: false})"></div>
        <div class="content">
            <h2 class="title">Crear Producto</h2>
            <form class="form" action="#" @submit.prevent="submit">
                <div class="form-item">
                    <label for="category" class="form-label">Categorias:</label>
                    <select class="form-input" name="category" id="category" v-model="inputData.category">
                        <option v-for="(category, i) in categories" :key="i" :value="category">{{ category }}</option>
                    </select>
                    <span>{{ inputErrors.category }}</span>
                </div>
                <div class="form-item">
                    <label for="image" class="form-label">Imagen:</label>
                    <input type="file" 
                        name="image" 
                        id="image" 
                        class="form-input"
                        @change="imageData">
                </div>
            </form>
            <div class="buttons">
                <div class="animated-response" v-if="waitingSubmit">
                    <div class="circles">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <a href="#" class="confirm"
                    @click.prevent="submit"
                    v-else>Confirmar</a>
                <a href="#" class="cancel" 
                    @click.prevent="$emit('confirmCreate', {show: false})">Cancelar</a>
            </div>
        </div>
    </div>    
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            inputData: {
                category: null
            },
            inputErrors: {
                category: null
            },
            dataToSend: null,
            formData: new FormData(),
            dataToSend: null,
            categories: ['mosaiquismo', 'tapiceria', 'decoupage', 'seminarios'],
            waitingSubmit: false,
            message: false,
            responseError: false
        }
    },
    methods: {
        submit() {
            this.formData.append('category', this.inputData.category);
            this.dataToSend = this.formData;
            var vm = this;

            this.waitingSubmit = true;
            axios.post('/api/products/put', this.dataToSend, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.message = 'Se han guardado los elementos con exito.';
                setTimeout(() => {
                    vm.message = false;
                    this.$emit('confirmCreate', {show: false})
                }, 2500);              
            })
            .catch(err => {
                vm.message = 'Ups no pudimos guardar la información intenta nuevamente.';
                vm.responseError = true;
                setTimeout(() => {
                    vm.message = false;
                    vm.responseError = false;
                    this.$emit('confirmCreate', {show: false})
                }, 2500)     
            }); 
        },
        imageData(event) {
            const file = event.target.files;
            this.formData.append('image', file[0]);
        },
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    .create-container {
        position: fixed;
        width: 100%;
        height: 100vh;
        @include flex(row nowrap, center, center);
    }
    .create-main {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba($mainBlack, .4);
    }

    .content {
        width: 50%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        @include flex(column nowrap, flex-start, flex-start);
        padding: 40px;
        background-color: $mainWhite;
        border: 1px solid rgba($mainBlack, .4);
        border-radius: 5px;
        box-shadow: 0 0 10px 1px rgba($mainBlack, .4);
        z-index: 2000;


        .title {
            width: 100%;
            text-align: start;
            font-size: 1.8em;
            border-bottom: 1px solid rgba($mainBlack, .4);
        }

         .form {
            width: 100%;
            margin-bottom: 20px;
            @include flex(column nowrap, space-around, start);

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
                    line-height: 28px;
                    font-size: 1.1em;
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: 1px solid rgb(169, 169, 169);
                }
            }
         }


        .buttons {
            width: 100%;
            @include flex(row nowrap, flex-end);

            .confirm {
                @include tableBtn($primaryBtn, $mainWhite, 1.1em);
                margin-right: 20px;
            }
        
            .cancel {
                @include tableBtn($errors, $mainWhite, 1.1em);
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
    }

    .appear-enter-active, .appear-leave-active {
        transition: opacity .4s ease-in-out;
    }

    .appear-enter, .appear-leave-to {
        opacity: 0;
    }
</style>
