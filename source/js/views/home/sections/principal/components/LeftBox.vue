<template>
    <div>
        <img class="box" src="@img/brand/caja.png" alt="Caja Decorada" rel="box--js">
        <img class="egg" src="@img/brand/huevo.png" alt="Caja Decorada" rel="egg--js">
    </div>
</template>

<script>
export default {
    mounted() {
        var box = document.querySelector('[rel=box--js]');
        var egg = document.querySelector('[rel=egg--js]');
    
        setTimeout(() => {
            if (window.innerWidth < 1040) {
                box.style.transform = 'translate(5%, 0)';
                egg.style.transform = 'translate(0, 150%)';
            } else {
                box.style.transform = 'translate(15%, 0)';
                egg.style.transform = 'translate(40%, 80%)';
            }
            
        }, 0);
    }
}
</script>


<style scoped>
    .box {
        display: block;
        transform: translate(15%, -10%);
        transition: transform 1s ease-out;
    }

    .egg {
        display: block;
        width: 22%;
        height: 40%;
        transform: translate(150%, 80%);
        transition: transform 1s ease-out;
    }

    @media screen and (max-width: 1040px) {
        .box {
            display: block;
            transform: translate(5%, -10%);
            transition: transform 1s ease-out;
        }

        .egg {
            height: 30%;
            transform: translate(130%, 150%);
        }
    }

</style>
