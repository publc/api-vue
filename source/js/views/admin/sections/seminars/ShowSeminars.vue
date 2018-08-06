<template>
    <div class="main">
        <mira-modal :modal="modal" v-if="showModal" @modalResponse="modalResponse($event)"></mira-modal>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody v-for="(seminar, i) in seminars" :key="i">
                <tr class="table-body">
                    <td>{{seminar.id}}</td>
                    <td>{{seminar.title}}</td>
                    <td>{{seminar.date}}</td>
                    <td>
                        <router-link 
                        href="#" class="edit-button" 
                        :to="{
                            name: 'adminEditSeminar', 
                            params: {seminar}
                            }">editar</router-link>
                        <a href="#" class="delete-button" 
                            @click.prevent="confirmDeleteSeminar(seminar.id)">eliminar</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="pagination">
                            <a class="paginate-link left" href="#"
                                @click.prevent="prev">anterior</a>
                            <a class="paginate-number" href="#"
                                @click.prevent>{{paginate.current_page}}</a>
                            <a class="paginate-link right" href="#"
                                @click.prevent="next">siguiente</a>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import Modal from '../../components/Modal.vue';
export default {
    data() {
        return {
            dataToSend: {page: 1, limit: 10},
            seminars: [],
            paginate: {},
            modal: {
                title: 'Eliminar Seminario',
                description: 'Deseas eleminar el seminario que seleccionaste',
                id: 0
            },
            showModal: false
        }
    },
    mounted() {
        this.send(this.dataToSend);
    },
    components: {
        'mira-modal': Modal
    },
    methods: {
        next() {
            var page = this.dataToSend.page;
            var limit = this.dataToSend.limit;
            var paginate = this.paginate;

            if (paginate.next_page === null || page + 1 > paginate.next_page) {
                return;
            }

            var data = {page: page += 1, limit: limit};
            this.dataToSend.page += 1;

            this.send(data);
        },
        prev() {
            var page = this.dataToSend.page;
            var limit = this.dataToSend.limit;
            var paginate = this.paginate;

            if (paginate.prev_page === null || page - 1 < paginate.prev_page) {
                return;
            }

            var data = {page: page -= 1, limit: limit};
            this.dataToSend.page -= 1;

            this.send(data);
        },
        send(data) {
            var vm = this;
            axios.post('/api/seminars/show', data, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.seminars = res.data.seminars;
                vm.paginate = res.data.paginate;
            })
            .catch(err => {
                console.log(err);    
            });
        },
        confirmDeleteSeminar(id) {
            this.modal.id = id;
            this.showModal = true;
        },
        deleteSeminar(id) {
            var vm = this;
            axios.post('/api/seminars/destroy', {id: id}, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.seminars.forEach((el, index) => {
                    if(el.id == res.data.id) {
                        vm.$nextTick(function () {
                           vm.seminars.splice(index, 1);
                        }); 
                    }
                });                
            })
            .catch(err => {
                console.log(err);
            })
        },
        modalResponse(event) {
            this.showModal = event.show;
            if(event.confirm) {
                this.deleteSeminar(event.id);
            }
        } 
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    .main {
        display: block;
        width: 100%;
        padding: 30px 0;

        .table {
            width: 100%;
            padding: 30px 0;
            font-size: 1.3em;
            border: 1px solid rgba($link, .2);
            border-radius: 5px;
            border-collapse: collapse;

            th {
                padding: 10px 0;
            }

            .table-body {
                td {
                    padding: 10px 0;
                }
            }

            .edit-button {
                @include tableBtn;
            }

            .delete-button {
                @include tableBtn($errors);
            }

            .pagination {
                width: 80%;
                margin: 0 auto;
                padding-top: 40px;
                @include flex(row nowrap, flex-end);

                .paginate-link {
                    text-decoration: none;
                    color: $link;
                    padding: 5px 15px;
                    border: 1px solid rgba($link, .2);
                    transition: background-color .25s ease-out;

                    &.left {
                        border-top-left-radius: 5px;
                        border-bottom-left-radius: 5px;
                    }

                    &.right {
                        border-top-right-radius: 5px;
                        border-bottom-right-radius: 5px;
                    }

                    &:hover {
                        background-color: rgba($link, .8);
                        color: $mainWhite;
                    }
                }
            }

            .paginate-number {
                cursor: default;
                text-decoration: none;
                color: $link;
                padding: 5px 15px;
                border: 1px solid rgba($link, .2);
                transition: background-color .25s ease-out;
            }
        }
    }
</style>
