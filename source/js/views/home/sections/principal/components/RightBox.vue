<template>
    <div>
        <img class="butter butter-1 hidden" src="@img/brand/butter_5.svg" alt="Mariposa" rel="butter--js">
        <img class="butter butter-2 hidden" src="@img/brand/butter_2.svg" alt="Mariposa" rel="butter--js">
        <img class="butter butter-3 hidden" src="@img/brand/butter_6.svg" alt="Mariposa" rel="butter--js">
        <div class="container hidden" rel="container--js">
            <h1 class="home-title">MIRA QUE LINDO</h1>
            <p class="home-subtitle">Deco &amp; Dise&ntilde;o</p>
        </div>
        <img class="butter butter-4 hidden" src="@img/brand/butter_3.svg" alt="Mariposa" rel="butter--js">
        <img class="butter butter-5 hidden" src="@img/brand/butter_1.svg" alt="Mariposa" rel="butter--js">
        <img class="butter butter-6 hidden" src="@img/brand/butter_4.svg" alt="Mariposa" rel="butter--js">
    </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    mounted() {
        var butters = document.querySelectorAll('[rel=butter--js]');
        var container = document.querySelector('[rel=container--js]');
        setTimeout(() => {
            container.classList.add('show');
            container.classList.remove('hidden');
            butters.forEach(butter => {
                butter.classList.add('show');
                butter.classList.remove('hidden');
            });
        }, 300);
        
    }
}
</script>


<style lang="scss" scoped>
    .container {
        padding: 25% 0;
        transition: opacity 2s .5s ease-in-out;
    }

    .butter {
        transition: opacity 1s ease-in-out;
        position: absolute;
        width: 13%;
        
    }

    .butter, .container{

        &.hidden {
            opacity: 0;
        }

        &.show {
            opacity: 1;
        }
    }

    .home-title {
        font-size: 2.5em;
    }

    .home-subtitle {
        font-size: 1.5em;
    }

    .butter-1 {
        top: 25%;
        left: 10%;
    }

    .butter-2 {
        top: 0%;
        left: 50%;
    }

    .butter-3 {     
        top: 27.5%;
        right: 15%;
    }

    .butter-4 {     
        bottom: 30%;
        right: 15%;
    }

    .butter-5 {     
        bottom: 25%;
        left: 15%;
    }

    .butter-6 {     
        bottom: 10%;
        left: 50%;
        transform: translateX(-50%);
    }

</style>