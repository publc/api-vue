<template>
    <div class="main">
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
                <tr>
                    <td>{{seminar.id}}</td>
                    <td>{{seminar.title}}</td>
                    <td>{{seminar.date}}</td>
                    <td>buttons</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="pagination">
                            <a class="paginate-link left" href="#"
                                @click.prevent="prev">anterior</a>
                            <a class="paginate-number" href="#">{{paginate.current_page}}</a>
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
export default {
    data() {
        return {
            dataToSend: {page: 1},
            seminars: [],
            paginate: {}
        }
    },
    mounted() {
        this.send(this.dataToSend);
    },
    methods: {
        next() {
            var page = this.dataToSend.page;
            var paginate = this.paginate;

            if (paginate.next_page === null || page + 1 > paginate.next_page) {
            return;
            }

            var data = {page: page += 1}

            this.send(data);
        },
        prev() {
            var page = this.dataToSend.page;
            var paginate = this.paginate;

            if (paginate.prev_page === null || page - 1 < paginate.prev_page) {
                return;
            }

            var data = {page: page -= 1}

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
                console.log(res.data.seminars);
            })
            .catch(err => {
                console.log(err);    
            });
        } 
    }
}
</script>

<style lang="scss" scoped>
@import '~@styles/app.scss';    
    .main {
        display: block;
        width: 100%;
        padding-top: 30px;

        .table {
            width: 100%;
            padding: 10px;
            font-size: 1.3em;
            border: 1px solid rgba($link, .2);
            border-radius: 5px;

            th, tr {
                padding: 10px 0;
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
