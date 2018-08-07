<template>
    <div>
        <form class="contact-form" 
            action="#" 
            @submit.prevent="submitForm"
            rel="form--js">
            <div class="form-item">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-input" v-model="formData.name">
            </div>
            <div class="form-item">
                <label for="phone" class="form-label">Telefono:</label>
                <input type="tel" name="phone" id="phone" class="form-input" v-model="formData.phone">
            </div>
            <div class="form-item">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" name="email" id="email" class="form-input" v-model="formData.email">
            </div>
            <div class="form-item">
                <label for="query" class="form-label">Consulta:</label>
                <textarea name="query" id="query" class="form-textarea" v-model="formData.query"></textarea>
            </div>
            <div class="form-btn" v-if="!waitSendMail">
                <a class="submit-btn" href="#" @click.prevent="submitForm">Enviar</a>
            </div>
            <div class="animated-response" v-if="waitSendMail">
                <div class="circles">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </form>
        <div :class="sendMail ? 'send-mail open' : 'send-mail'">
            <span :class="errors ? 'send-mail-icon error' : 'send-mail-icon ok'">
                <i :class="errors ? 'fas fa-times' : 'fas fa-check'"></i>
            </span>
            <h3 class="response">{{ response }}</h3>
            <p class="aux-message">{{ auxMessage }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            formData: {
                name: '',
                phone: '',
                email: '',
                query: ''
            },
            waitSendMail: false,
            response: 'No se pudo enviar el correo',
            auxMessage: 'Tenemos problemas de comunicación. Por favor intenta de nuevo mas tarde',
            sendMail: false,
            errors: false
        }
    },
    methods: {
        submitForm() {
            this.waitSendMail = true;
            axios.post('api/email', this.formData)
                .then((res) => {
                    this.waitSendMail = false;
                    this.sendMail = true;
                    this.response = res.data.response;
                    this.auxMessage = res.data.message;
                    
                    if (res.data.errors === true) {
                        this.erorrs = true;
                    }

                    setTimeout(() => {
                        this.sendMail = false;
                        this.erorrs = false;
                        this.response = '';
                        this.auxMessage = '';
                        this.showForm = false;
                    }, 3500);
                })
                .catch(error => {
                    this.erorrs = true;
                    this.response = 'No se pudo enviar el correo';
                    this.auxMessage = 'Tenemos problemas de comunicación. Por favor intenta de nuevo mas tarde';
                });
        }
    }
}
</script>

<style lang="scss" scoped>
    
    .contact-form {
        display: block;
        width: 80%;
        max-width: 450px;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fafafa;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        transition: width .8s ease-in-out, height 1s ease-in-out, padding .8s ease-in-out;
        overflow: hidden;

        .form-item {
            min-width: 250px;
            padding: 10px 0;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: start;

            .form-label {
                font-size: 1.2em;
            }

            .form-input {
                width: 100%;
                line-height: 20px;
                font-size: 1em;
                padding: 3px 5px;
                border-radius: 5px;
                border: 1px solid rgb(169, 169, 169);
            }

            .form-textarea {
                min-width: 100%;
                max-width: 100%;
                min-height: 120px;
                max-height: 120px;
                font-size: 1em;
                padding: 3px 5px;
                border-radius: 5px;
            }

            
        }

        .form-btn {

            .submit-btn {
                text-decoration: none;
                font-size: 1.3em;
                font-weight: 600;
                color: #2c3e50;
            }
        }

        .animated-response {
            width: 100%;
            height: 40px;
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;

            .circles {
                width: 100px;
                display: flex;
                flex-flow: row nowrap;
                justify-content: space-around;
                align-items: center;
                
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

    .send-mail {
        width: 80%;
        max-width: 450px;
        position: absolute;
        top: 0;
        right: 50%;
        transform: translateX(50%);
        height: 0;
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        background-color: #2c3e50;
        color: #fafafa;
        padding: 0;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        transition: height 1s ease-in-out, padding .8s ease-in-out;
        overflow: hidden;
        z-index: 2000;

        &.open {
            height: 440px;
            padding: 20px 30px;
        }

        .response {
            font-size: 1.6em;
        }

        .aux-message {
            font-size: 1.3em;
        }

        .send-mail-icon {
            width: 60px;
            height: 60px;
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: #fafafa;
            font-size: 1.7em;

            &.ok {
                background-color: #33691E;
            }
            
            &.error {
                background-color: #E64A19;
            }
        }
    }

    @media screen and (max-width: 780px) {
        .contact-form {
            width: 100%;
            max-width: 300px;

            .form-item {
                min-width: 200px;
            }
        }

        .contact-btn {
            bottom: 10%;
        }

        .contact-form {

            &.open {
                width: 280px;
            }
        }

         .send-mail {
            width: 280px;
        }
    }
</style>

