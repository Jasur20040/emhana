<template>

    <head>
        <link href="/fonts/Gilroy/gilroy.css" rel="stylesheet">
    </head>
    <div class="footer">
        <div class="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 main_footer_logo">
                        <a href="https://e-taklif.uz/">
                            <img width="194" height="37" alt="footer icon" src="../../../public/svg/logo-footer.svg"
                                class="logo-footer">
                        </a>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="mainfooteradres Gilroy400">
                            <img width="24" height="24" alt="footer icon" src="../../../public/svg/place-icon.svg"
                                class="mainplace-icon">
                                Toshkent 100084, Amir Temur shox ko‘chasi 94 uy
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                    <a href="https://t.me/e_taklif" rel="nofollow" class="mainphone2">
                        <!-- <img width="24" height="24" alt="footer icon" src="/images/main/phone-icon2.svg" class="mainphone-icon2"> -->
                        <img width="24" height="24" alt="telegram" src="../../../public/svg/tgram-icon.svg" class="mainfooter-ss">
                        @e_taklif
                    </a>
                </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style>
.Gilroy400 {
    font-family: 'Gilroy400';
    font-weight: 400;
}

a {
    color: #000;
    text-decoration: none;
    background-color: transparent;
}

.footer1 {
    margin-top: 80px;
    padding: 50px 0;
    background: #272727;
    color: #AEAEAE;
}

.mainfooteradres {
    display: flex;
    font-size: 16px;
}

img.mainplace-icon {
    margin-right: 10px;
    width: 25px;
}

a.mainphone2 {
    display: flex;
    color: #AEAEAE;
    font-size: 16px;
}

img.mainphone-icon2 {
    margin-right: 10px;
    width: 25px;
}


.footer2 {
    padding: 10px 0;
    background: #000;
    color: #AEAEAE;
}

a.footerpolit {
    color: #AEAEAE;
    display: block;
    font-size: 16px;
}

a.footerpolit:hover {
    text-decoration: underline;
}

.footertext2 {
    color: #AEAEAE;
    font-size: 16px;
}

a.footerpeaksoft {
    color: #AEAEAE;
}

a.footerpeaksoft:hover {
    text-decoration: underline;
}

.footer-ssetter {
    display: flex;
}

a.footer-sset {
    display: block;
    margin: 0 10px;
    margin-top: 7px;
}

img.mainfooter-ss {
    width: 23px;
    margin-right: 10px;
}

@media (max-width: 991px) {
    a.mainphone2 {
        color: #AEAEAE;
        display: block;
        margin-top: 30px;
    }

    .footer-ssetter {
        margin: 20px 0;
    }

}

@media (max-width: 767px) {
    a.footerpolit {
        margin-top: 15px;
    }
}

@media (max-width: 576px) {
    .main_footer_logo {
        margin-bottom: 20px;
    }
}

@media (max-width: 575px) {
    .footer1 {
        padding: 35px 0;
    }

    a.mainphone2 {
        margin-top: 20px;
    }

    .main_footer_logo {
        margin-bottom: 0;
    }

    .mainfooteradres {
        margin-top: 20px;
    }

    img.mainphone-icon2 {
        margin-right: 10px;
        display: inline !important;
    }

    .mainfooterdoc {
        margin-top: 20px;
        margin-bottom: 20px;
    }
}

@media (max-width: 380px) {
    a.footerpolit {
        font-size: 14px;
    }

    .mainfooteradres {
        font-size: 14px;
    }

    .footertext2 {
        font-size: 14px;
    }

    a.mainphone2 {
        font-size: 14px;
    }
}
</style>