<template>
    <div class="modal" @click.prevent="$emit('modalResponse', {show: false})">
        <div class="modal-content">
            <h2 class="title">{{modal.title}}</h2>
            <p class="description">{{modal.description}}</p>
            <div class="buttons">
                <a href="#" class="confirm"
                    @click.prevent="$emit('modalResponse', {confirm: true, id: modal.id, show: false})">Confirmar</a>
                <a href="#" class="cancel" 
                    @click.prevent="$emit('modalResponse', {show: false})">Cancelar</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['modal']
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba($mainBlack, .4);
        @include flex;

        .modal-content {
            width: 50%;
            @include flex(column nowrap, flex-start, flex-start);
            padding: 20px;
            background-color: $mainWhite;
            border: 1px solid rgba($mainBlack, .4);
            border-radius: 5px;
            box-shadow: 0 0 10px 1px rgba($mainBlack, .4);


            .title {
                width: 100%;
                text-align: start;
                font-size: 1.8em;
                border-bottom: 1px solid rgba($mainBlack, .4);
            }

            .description {
                width: 100%;
                text-align: start;
                font-size: 1.3em;
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

            }
        }
    }
</style>
