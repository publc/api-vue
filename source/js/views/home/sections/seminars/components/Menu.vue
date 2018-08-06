<template>
    <div class="nav">
        <h3 class="title">Proximos Seminarios</h3>
        <ul class="menu">
            <li class="menu-item" v-for="(monthToShow, i) in monthsToShow" :key="i">
                <a :class="i == month ? 'menu-link active' : 'menu-link'" 
                href="#"
                @click.prevent="$emit('changeMonth', i)">{{ monthsToShow[i] }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['month', 'months'],
    computed: {
        monthsToShow() {
            var strMonths = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

            var monthsToShow = {};
            this.months.forEach(month => {
                monthsToShow[month] = strMonths[month];
            });
            return monthsToShow;
        }
    }
}
</script>

<style lang="scss" scoped>
    .nav {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;

        .title {
            font-size: 2em;
            transform: translateY(-50px);

            &::after {
                content: '';
                display: block;
                position: relative;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                width: 40%;
                height: 2px;
                background-color: rgba(253, 182, 51, 0.95);
            }
        }

        .menu {
            width: 100%;
            margin: 0;
            padding: 0;
            list-style: none;

            .menu-item {
                margin: 10px 0;
                display: block;
                width: 100%;

                .menu-link {
                    display: block;
                    width: 100%;
                    padding: 10px 0;
                    font-size: 1.3em;
                    text-decoration: none;
                    color: #606060;
                    transition: color .3s ease-out, 
                    background-color .3s ease-out;

                    &:hover, &.active {
                        background-color:rgba(253, 182, 51, 0.95);
                        color: #fafafa;
                        font-weight: 600;
                    }
                }
            }
        }
    }
</style>


