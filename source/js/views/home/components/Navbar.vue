<template>
    <div>
        <nav :class="leftNavbar ? (openNavbar ? 'navbar right open' : 'navbar right hidden') : 'navbar'">
            <a :class="openNavbar ? 'navbar-caret open' : 'navbar-caret'" 
                href="#" 
                v-if="leftNavbar"
                @click.prevent="openNavbar = !openNavbar"
                    ><i :class="openNavbar ? 'far fa-times-circle' : 'fas fa-bars'"></i>
            </a>
            <div>
                <img class="logo" src="@img/brand/logo.svg" alt="Logo Mira Que Lindo">
            </div>
            <ul class="navbar-menu">
                <li class="navbar-item" v-for="(item, i) in navbarItems" :key="i">
                    <a :class="onScreenElement === item.to ? 'navbar-link active' : 'navbar-link'" 
                        href="#" 
                        @click.prevent="sendToComponent(item.to)"
                        >{{ item.title }}
                    </a>
                </li>
            </ul>
        </nav>
        <img class="phone-logo" src="@img/brand/logo.svg" alt="Logo Mira Que Lindo" v-if="phoneLogo">
    </div>
</template>

<script>
export default {
    data() {
        return {
            navbarItems: [
                {to: 'principal', title: 'Home'},
                {to: 'seminars', title: 'Seminarios'},
                {to: 'products', title: 'Productos'},
                {to: 'about', title: 'Nosotros'},
                {to: 'contact', title: 'Contacto'}
            ],
            leftNavbar: false,
            openNavbar: false,
            phoneLogo: false,
            onScreenElement: ''
        }
    },
    methods: {
        sendToComponent(to) {
           var section = document.querySelector(`[rel=${to}-section--js]`);
           section.scrollIntoView({block: "start", behavior: "smooth"});
        },
        screenPosition() {
            window.addEventListener('scroll', (event) => {
                this.leftNavbar = (window.scrollY >= 300 || window.innerWidth < 780);
                
                var section;
                var bounding;
                this.navbarItems.forEach(element => {
                    section = document.querySelector(`[rel=${element.to}-section--js]`);
                    bounding = section.getBoundingClientRect();
                    if ( bounding.top <= 10 && bounding.top >= (-1 * bounding.height)) {
                        this.onScreenElement = element.to;
                    }
                });     
            });
        }
    },
    created() {
       this.leftNavbar = window.innerWidth < 780;
       this.phoneLogo = window.innerWidth < 780;
    },
    watch: {
        screenPosition: {
            handler: 'screenPosition',
            immediate: true
        }
    }
}
</script>

<style lang="scss" scoped>
    .navbar {
        width: 100%;
        height: 80px;
        padding: 0 80px;
        position: absolute;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        z-index: 2000;

        .logo {
            height: 60px;
        }

        .navbar-menu {
            list-style: none;
            margin: 0;
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-around;
            align-items: center;

            .navbar-item {
                margin: 0 10px;

                .navbar-link {
                    display: block;
                    text-transform: uppercase;
                    text-decoration: none;
                    color: #606060;
                    font-size: 1em;
                    transition: color .25s ease-out, transform .25s ease-in-out;

                    &:hover {
                        transform: scale(1.1);
                        color: #202020;
                    }
                }
            }
        }

        &.right {
            width: 200px;
            height: 100vh;
            position: fixed;
            padding: 30px 0;
            flex-flow: column nowrap;
            justify-content: start;
            align-items: center;
            background-color: #fafafa;
            transition: right .4s ease-out;

            &.hidden {
                right: -250px;
            }

            &.open {
                right: 0;
            }

            .navbar-caret {
                position: fixed;
                top: 10px;
                right: 0;
                font-size: 1.5em;
                text-decoration: none;
                color: #606060;
                background-color: #fafafa;
                padding: 5px 10px;
                line-height: 0;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                transition: right .4s ease-out;

                &.open {
                    right: 0;
                    font-size: 1.7em;
                }
            }

            ul {
                margin: 0;
                padding: 0;
            }

            .navbar-menu {
                width: 100%;
                padding-top: 30px;
                flex-flow: column nowrap;
                justify-content: start;

                .navbar-item {
                    width: 100%;
                    margin: 5px 0;
            
                    .navbar-link {
                        width: 100%;
                        padding: 10px 0;
                        font-size: 1.2em;
                        transition: color .3s ease-out, 
                            transform .3s ease-in-out, 
                            background-color .3s ease-out;

                        &:hover, &:focus, &:active, &.active {
                            transform: scaleX(1.2);
                            background-color:rgba(253, 182, 51, 0.95);
                            color: #fafafa;
                            font-weight: 600;
                        }
                    }
                }
            }
        }
    }

    .phone-logo {
        position: absolute;
        top: 20px;
        left: 40px;
        height: 60px;
    }
</style>


