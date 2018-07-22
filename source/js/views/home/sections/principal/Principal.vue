<template>
    <section class="principal" rel="principal-section--js">
       <mira-left-box class="left-box" rel="left-box--js"></mira-left-box>
       <mira-right-box class="right-box"></mira-right-box>
       <mira-networks class="networks"></mira-networks>
       <a class="caret-down" href="#seminars" @click.prevent="goDown">
           <i class="fas fa-sort-down"></i>
       </a>
    </section>
</template>

<script>
import LeftBox from './components/LeftBox.vue';
import RightBox from './components/RightBox.vue';
import Networks from './components/Networks.vue';
export default {
    components: {
        'mira-left-box': LeftBox,
        'mira-right-box': RightBox,
        'mira-networks': Networks,
    },
    methods: {
        goDown() {
            var section = document.querySelector(`[rel=seminars-section--js]`);
            section.scrollIntoView({block: "start", behavior: "smooth"});
        }
    },
}
</script>


<style lang="scss" scoped>
    .principal {
        width: 100%;
        height: 100vh;
        max-height: 768px;
        position: relative;
        top: 0;
        display: flex;
        flex-flow: row nowrap;
        overflow: hidden;

        .left-box {
            width: 60%;
            height: 95%;
            display: flex;
            flex-flow: row nowrap;
        }

        .right-box {
            width: 40%;
            position: absolute;
            top: 20%;
            right: 2%;
        }

        .networks {
            width: 150px;
            position: absolute;
            bottom: 5%;
            right: 15%; 
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            align-items: center;
        }

        .caret-down {
            width: 50px;
            height: 35px;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 50%;
            transform: translateX(-50%);
            text-decoration: none;
            font-size: 2.7em;
            color: #202020;
            animation: go-down 3s 1s infinite;
        }

        @keyframes go-down {
            0% { color: #202020; transform: translateY(-50%, 0)}
            50% { color: rgba(32, 32, 32, 0.9); transform: translate(-50%, -10px)}
            100% { color: #202020; transform: translateY(-50%, 0) }
        }
    }

    @media screen and (max-width: 1040px) {
        .principal {
            .right-box {
                top: 30%;
            }    
        }     
    }

    @media screen and (max-width: 780px) {
        .principal {
            justify-content: center;
            align-items: center;
            max-height: 500px;

            .left-box {
                display: none;
            }

            .right-box {
                width: 100%;
                position: relative;
                top: 0;
                right: 0;
            }

            .caret-down {
                display: none;
            }

            .networks {
                width: 100%;
                position: absolute;
                bottom: 10%;
                right: 0; 
                display: flex;
                flex-flow: row nowrap;
                justify-content: space-around;
                align-items: center;
            }
        }    
    }
</style>



