<template>

    <head>
        <link rel="preload" href="/fonts/Gilroy/gilroy.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/Optima/optima.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/CormorantInfant/CormorantInfant.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/KZ_GOTHIC/KZ_GOTHIC.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/KzFonts/kzFonts.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/AbrilFatface/AbrilFatface.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/AbhayaLibre/AbhayaLibre.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/Cormorant/Cormorant.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/otherFonts/otherfonts.css" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="/fonts/Lora/Lora.css" as="style" onload="this.rel='stylesheet'">
        <noscript>
            <link href="/fonts/Gilroy/gilroy.css" rel="stylesheet">
            <link href="/fonts/Optima/optima.css" rel="stylesheet">
            <link href="/fonts/CormorantInfant/CormorantInfant.css" rel="stylesheet">
            <link href="/fonts/KZ_GOTHIC/KZ_GOTHIC.css" rel="stylesheet">
            <link href="/fonts/KzFonts/kzFonts.css" rel="stylesheet">
            <link href="/fonts/AbrilFatface/AbrilFatface.css" rel="stylesheet">
            <link href="/fonts/AbhayaLibre/AbhayaLibre.css" rel="stylesheet">
            <link href="/fonts/Cormorant/Cormorant.css" rel="stylesheet">
            <link href="/fonts/otherFonts/otherfonts.css" rel="stylesheet">
            <link href="/fonts/Lora/Lora.css" rel="stylesheet">
            <div><img src="https://mc.yandex.ru/watch/97879060" style="position:absolute; left:-9999px;" alt="" /></div>
        </noscript>
     </head>
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center Gilroy400">
                <div class="d-flex mr-3 align-items-center ">
                    <a >
                        <img alt="logo" src="../../../public/static/logo.png" class="logo">
                    </a>
                    <a class="blogmenu Gilroy400" href="https://e-taklif.uz/blog">Басты бет</a>
                    <a class="blogmenu Gilroy400" href="https://e-taklif.uz/musics">Біз туралы</a>
                    <a class="blogmenu Gilroy400" href="https://e-taklif.uz/musics">Жазылу</a>
                    <a class="blogmenu Gilroy400" href="https://e-taklif.uz/musics">Қызметтер</a>

                </div>
                <!-- <div class="col-6 col-sm-6 col-lg-3">
                    <a href="https://t.me/e_taklif" rel="nofollow" target="_blank" class="whatsapp-phone">
                        <img width="24" height="24" alt="" src="../../../public/svg/telegram-white.svg" class="">
                        Telegram
                    </a>

                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {

    },
    methods: {

    }
}
</script>

<style>
.header {
    padding: 10px 0;
    background-color: #fff;
}

.Gilroy400 {
    font-family: 'Gilroy400';
    font-weight: 400;
}

img.logo {
    width: 100px;
}

a {
    color: #000;
    text-decoration: none;
    background-color: transparent;
}

a.whatsapp-phone {
    display: block;
    float: right;
    width: 125px;
    border: 2px solid #55ACEE;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 400;
    color: #fff;
    background: #55ACEE;
}a.whatsapp-phone:hover{
    color: #fff;
}

a:hover {
    color: #000;
}

a.blogmenu {
    font-size: 18px;
    margin-left: 70px;
}

.mainphone {
    font-weight: 400;
    font-size: 16px;
    line-height: 140%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    text-decoration: none;
    color: #000;
}

.mainphone-icon {
    width: 20px;
    margin-right: 7px;
    fill: white;
}

/* a.whatsapp-phone {
    display: none;
    border: 2px solid #096e19;
    padding: 6px 15px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 400;
    color: #fff;
    background: #096e19;
    margin-left: 20px;
} */

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}

@media (max-width: 991px) {
    .blogmenu {
        display: none;
    }
}

@media (max-width: 767px) {
    .mainphone {
        display: none;
    }

    a.whatsapp-phone {
        display: flex;
    }
}

@media (max-width: 450px) {
    img.logo {
        width: 100%;
    }
}
</style>