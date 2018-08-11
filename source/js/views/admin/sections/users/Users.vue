<template>
    <div class="users">
        <mira-modal :modal="modal" v-if="showModal" @modalResponse="modalResponse($event)"></mira-modal>
        <a href="#" class="create-btn" @click.prevent="createUser">Registrar Usuario</a>
        <mira-create-user v-if="showCreate" 
                @confirmCreate="confirmCreate($event)"></mira-create-user>
        <div class="main">
            <div class="table">
                <div class="head">
                    <p class="title" v-for="(head, i) in heads" :key="i">{{ head }}</p>
                </div>
                <div class="body">
                    <div class="content" v-for="(user, i) in users" :key="i">
                        <p class="id">{{user.id}}</p>
                        <p class="id">{{user.name}}</p>
                        <p class="id">{{user.email}}</p>
                        <p class="id">{{user.phone}}</p>
                        <a href="#" class="delete-button" 
                            @click.prevent="confirmDeleteUser(user.id)">eliminar</a>
                    </div>
                    <div class="pagination">
                        <a class="paginate-link left" href="#"
                            @click.prevent="prev">anterior</a>
                        <a class="paginate-number" href="#"
                            @click.prevent>{{paginate.current_page}}</a>
                        <a class="paginate-link right" href="#"
                            @click.prevent="next">siguiente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Modal from '../../components/Modal.vue';
import CreateUser from './CreateUser.vue';
export default {
    data() {
        return {
            heads: ['id', 'name', 'email', 'phone', ''],
            dataToSend: {page: 1, limit: 6},
            users: [],
            paginate: {},
            modal: {
                title: 'Eliminar Usuario',
                description: 'Deseas eleminar el usuario que seleccionaste',
                id: 0
            },
            showCreate: false,
            showModal: false
        }
    },
    mounted() {
        var data = this.dataToSend;
        this.send(data);
    },
    methods: {
        send(data) {
            var vm = this;
            axios.post('/api/users/show', data, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.users = res.data.users;
                vm.paginate = res.data.paginate;
            })
            .catch(err => {
                console.log(err);    
            });
        },
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
        createUser() {
            this.showCreate = true;
        },
        confirmCreate(event) {
            this.showCreate = event.show;
        },
        modalResponse(event) {
            this.showModal = event.show;
            if(event.confirm) {
                var email;
                this.users.forEach(user => {
                    if(event.id === user.id) {
                        email = user.email
                    }
                });

                this.deleteUser(email);
            }
        },
        confirmDeleteUser(id) {
            this.modal.id = id;
            this.showModal = true;
        },
        deleteUser(email) {
            var vm = this;
            axios.post('/api/users/destroy', {email: email}, {
                headers: {
                    'Content-Type': 'application/json',
                    'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
                }
            })
            .then(res => {
                vm.users.forEach((el, index) => {
                    if(el.id == res.data.id) {
                        vm.$nextTick(function () {
                           vm.users.splice(index, 1);
                        }); 
                    }
                });                
            })
            .catch(err => {
                console.log(err);
            })
        } 
    },
    components: {
        'mira-create-user': CreateUser,
        'mira-modal': Modal
    },
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    
    .users {
        width: 100%;
        @include container;
        @include flex(column nowrap, flex-start, flex-start);
        padding: 50px;
        border: 1px solid rgba($mainBlack, .2);
        border-radius: 10px;

        .create-btn {
            padding: 10px 20px;
            border: 1px solid $bgLinkMini;
            border-radius: 20px;
            font-size: 1.4em;
            text-decoration: none;
            color: $link;
            cursor: pointer;
            transition: background-color .4s ease-in-out;

            &:hover {
                background-color: $bgLinkMini;
                color: $mainWhite;
                font-weight: 600;
            }
        }

        .main {
            width: 100%;
            @include flex(row nowrap, center, center);

            .table {
                @include flex(column nowrap, flex-start, flex-start);
                width: 70%;
                margin-top: 50px;
            
                .head {
                    width: 100%;
                    @include flex(row nowrap, space-around, flex-end);
                    font-size: 1.3em;
                    
                    .title {
                        width: 100%;
                        margin-right: 30px;
                        border-bottom: 1px solid rgba($mainBlack, .2);
                        border-right: 1px solid rgba($mainBlack, .2);
                    }
                }

                .body {
                    width: 100%;
                    @include flex(column nowrap, flex-start, center);
                    margin: 10px 0;
                    padding: 10px;
                    border-bottom: 1px solid rgba($mainBlack, .2);
                    border-top: 1px solid rgba($mainBlack, .2);
                    font-size: 1.3em;

                    .content {
                        width: 100%;
                        @include flex(row nowrap, space-around, center);

                        .image {
                            max-height: 80px;
                            max-width: 50px;
                        }

                        .delete-button {
                            @include tableBtn($errors);
                        }
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
            }
        }        
    }
</style>
