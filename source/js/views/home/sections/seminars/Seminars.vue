<template>
    <section class="seminars" rel="seminars-section--js">
        <div class="left-box">
            <mira-menu :month="month" :months="months" 
                @changeMonth="month = $event"></mira-menu>
        </div>
        <div class="right-box">
            <mira-seminar v-for="(seminar, i) in seminarsToShow" :key="i" :seminar="seminar"></mira-seminar>
        </div>        
    </section>
</template>

<script>
import Seminar from './components/Seminar.vue';
import Menu from './components/Menu.vue';
import axios from 'axios';
export default {
    data() {
        return {
            seminarsByMonth: [],
            month: null,
            months: []
        }
    },
    computed: {
        seminarsToShow() {
            var seminars = this.seminarsByMonth[this.month];
            return seminars;
        }
    },
    components: {
        'mira-seminar': Seminar,
        'mira-menu': Menu
    },
    mounted() {
        var setDate = new Date();
        this.month = setDate.getMonth();
        var vm = this;
        axios.get('api/seminars/view', {
            headers: {
                'Content-Type': 'application/json',
                'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
            }
        })
        .then(res => {
                var seminars = res.data.seminars;
                var date;
                var seconds;
                var minutes;
                var hour;
                var year;
                var month;
                var realMonth;
                var day;
                var months = [];
                var seminarsByMonth = {};
                if(seminars instanceof Array && seminars.length >= 1) {
                    seminars.forEach(seminar => {
                        date = new Date(seminar.date * 1000);
                        seconds = date.getSeconds();
                        minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
                        hour = date.getHours();
                        year = date.getFullYear();
                        month = date.getMonth();                    
                        realMonth = month + 1;
                        day = date.getDate();

                        if(typeof(seminarsByMonth[month]) === 'undefined') {
                            seminarsByMonth[month] = [];
                        }

                        seminar.date = `${day}/${realMonth}/${year} - ${hour}:${minutes}`;
                        seminarsByMonth[month].push(seminar);
                        months.push(month);
                    });
                    vm.seminarsByMonth = seminarsByMonth;
                    vm.months = months;
                }

                
        })
        .catch(err => {
            console.log(err);
        });
    }
}
</script>



<style lang="scss" scoped>
@import '~@styles/app.scss';
    .seminars {
        position: relative;
        top: 50px;
        padding-top: 50px;
        @include flex (row nowrap, start, start);

        .left-box {
            width: 15%;
        }

        .right-box {
            width: 82.5%;
            height: 100%;
            min-height: 50vh;
            @include flex(column nowrap);
        }
    }

    @media screen and (max-width: 780px) {
        .seminars {
            position: relative;
            top: 50px;
            padding-top: 50px;
            @include flex (column nowrap, center, center);

            .left-box {
                width: 50%;
                margin: 0 auto;
            }

            .right-box {
                width: 100%;
                height: 100%;
                min-height: 50vh;
                @include flex(column nowrap);
            }
        }
    }
</style>
