<template>
    <Head />
    <!-- <div class="go1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="go1-title mt-12345">
                        Емхана веб сайты
                    </h1>
                </div>
            </div>

        </div>
    </div> -->
    <div class="section">
        <div class="image_section">
            <img src="../../../../public/static/medicine-center.webp" alt="">
            <div class="basty_soz">
                <h2>Emdel медициналық орталығына қош келдіңіздер</h2>
                <p>
                    Ваше здоровье и благополучие — наша главная забота. В медицинском центре «Emdel» мы
                    предоставляем высококачественные медицинские услуги в комфортной и поддерживающей атмосфере. Наша
                    команда высококвалифицированных специалистов использует самые современные методы диагностики и
                    лечения, чтобы предоставить вам лучшую медицинскую помощь.

                </p>
            </div>
        </div>
    </div>
    <div class="hr row-cols-5 my-5 border-top"></div>

    <!-- icon section start -->

    <h1 class="heading" id="icons-container"> Біз <span> туралы </span></h1>

    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-user-md"></i>
            <h3>140+</h3>
            <p>Медицина қызметкерлері</p>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <h3>140+</h3>
            <p>Науқастарға қараушы ұжым</p>
        </div>

        <div class="icons">
            <i class="fas fa-procedures"></i>
            <h3>500+</h3>
            <p>Емделушілерге арналған орын</p>
        </div>

        <div class="icons">
            <i class="fas fa-hospital"></i>
            <h3>10+</h3>
            <p>Қол жетімді орталық</p>
        </div>

    </section>

    <div class="hr row-cols-5 my-5 border-top"></div>
    <!-- icon section end -->

    <!-- doctor section start -->
    <section class="doctors" id="doctors">

        <h1 class="heading"> Біздің <span> дәрігерлер </span></h1>
        <div class="box-container">
            <div class="box">
                <img src="img/doctor-1.jpg" alt="">
                <h3>Ботбаев Жансерікбол</h3>
                <span>Тәжірибе: 17жыл</span>
            </div>

            <div class="box">
                <img src="img/doctor-2.jpg" alt="">
                <h3>Бишімбаев Марсел</h3>
                <span>Тәжірибе: 28жыл</span>
            </div>

            <div class="box">
                <img src="img/doctor-3.jpg" alt="">
                <h3>Берікұлы Серік</h3>
                <span>Тәжірибе: 25жыл</span>
            </div>


        </div>

    </section>

    <div class="hr row-cols-5 my-5 border-top"></div>

    <!-- doctor section end -->

    <!-- <Footer /> -->
</template>
<script>
import Head from "@/Components/header.vue";
import Footer from "@/Components/main_footer.vue";
export default {
    components: {
        Head,
        Footer,
    },
    props: ["types"],
    data() {
        return {
            loading: 0,
        };
    },
    mounted() {
        this.addTitle();
    },
    methods: {
        addTitle() {
            document.title = 'Емхана веб сайты';
        }
    }
};
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap');

:root {
    --green: #13AB7B;
    --black: #444;
    --light-color: #777;
    --box-shadow: .5rem .5rem 0 rgba(22, 160, 133, .2);
    --text-shadow: .4rem .4rem 0 rgba(0, 0, 0, .2);
    --border: .2rem solid var(--green);

}

* {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-decoration: none;
    transition: .2s linear;
}

/* Стилизация всего скроллбара */
::-webkit-scrollbar {
    width: 12px;
    /* Ширина скроллбара */
    height: 12px;
    /* Высота горизонтального скроллбара, если есть */
}

/* Стилизация дорожки скроллбара (части, по которой движется ползунок)section */
::-webkit-scrollbar-track {
    background: #f1f1f1;
    /* Цвет фона дорожки */
    border-radius: 10px;
    /* Закругление углов дорожки */
}

/* Стилизация ползунка скроллбара */
::-webkit-scrollbar-thumb {
    background-color: #13AB7B;
    /* Цвет ползунка */
    border-radius: 10px;
    /* Закругление углов ползунка */
    border: 3px solid #f1f1f1;
    /* Граница ползунка, делает его меньше дорожки */
}

/* Стилизация ползунка при наведении курсора */
::-webkit-scrollbar-thumb:hover {
    background-color: #555;
    /* Темнее цвет ползунка при наведении */
}

.hr {
    width: 1219px;
    margin-left: 158px;
}

.heading {
    text-align: center;
    padding-bottom: 2rem;
    text-shadow: var(--text-shadow);
    text-decoration: uppercase;
    color: var(--black);
    font-size: 5rem;
    letter-spacing: .4rem;
    margin-top: 4rem;
}

.heading span {
    text-decoration: uppercase;
    color: var(--green);
}

html {
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-padding-top: 9rem;
    scroll-behavior: smooth;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background-color: #13AB7B;
    color: white;
    display: flex;
    grid-column: 20px;
    align-items: center;
    border: var(--border);
    box-shadow: var(--box-shadow);
}

.logo {
    padding-left: 150px;
    margin-right: auto;
}

.logo img {
    font-size: 24px;
    font-weight: bold;
    width: 100px;
    height: 100px;
    margin-left: 50px;
}

.menu {
    margin-right: 20px;
    display: flex;
}

.menu a {
    width: auto;
    text-decoration: none;
    color: white;
    font-size: 16px;
    padding: 15px;
    margin: 0 5px;
    border-radius: 8px;
    transition: 0.4s;
}

.menu a:hover {
    background-color: rgb(255, 255, 255);
    color: black;
    transition: 0.4s;
}

.search-form__text {
    border: 1px;
    display: inline-flex;
    padding: 0 20px;
    justify-content: space-between;
    align-items: center;
    height: 50px;
    border-radius: 15px;
    overflow: hidden;
    border: none;
    width: 300px;
    outline: none;
    font-size: 20px;
}

.search {
    margin-left: 50px;
}

.search_btn {
    float: right;
    width: 40px;
    height: 40px;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    position: absolute;
    right: 30px;
    top: 30px;
}

.search_btn img {
    width: 30px;
}


.section {
    margin-top: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100vw;
    background-color: white;
}

.image_section {
    display: flex;
    justify-content: center;
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}


.image_section img {
    max-width: 80%;
    height: 700px;
}

/* basydagy soz */

.basty_soz {
    position: absolute;
    top: 50%;
    left: 70%;
    transform: translate(-50%, -50%);
    width: 30%;
    padding: 20px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    box-sizing: border-box;
    text-align: center;
    font-size: 20px;
    padding: 50px;
}

/* icon */

.icons-container {
    width: 1100px;
    margin: 0 auto;
    display: grid;
    gap: 2rem;
    grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.icons-container .icons {
    border: var(--border);
    box-shadow: var(--box-shadow);
    border-radius: .5rem;
    text-align: center;
    padding: 2rem;
}

.icons-container .icons i {
    font-size: 4.5rem;
    color: var(--green);
    padding-bottom: .7rem;
}

.icons-container .icons h3 {
    font-size: 4.5rem;
    color: var(--black);
    padding: .5rem 0;
    text-shadow: var(-textshadow);
}

.icons-container .icons p {
    font-size: 1.7rem;
    color: var(--light-color);
    padding: .5rem 0;
    text-shadow: var(-textshadow);
}

/* докторлардың бөлімі басталады */

.doctors .box-container {
    width: 1100px;
    margin: 0 auto;
    display: grid;
    gap: 2rem;
    grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.doctors .box-container .box {
    text-align: center;
    background: #fff;
    border-radius: .5rem;
    border: var(--border);
    box-sizing: var(--box-shadow);
    padding: 2rem;
}

.doctors .box-container .box img {
    height: 20rem;
    border: var(--border);
    border-radius: .5rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.doctors .box-container .box h3 {
    color: var(--black);
    font-size: 2.5rem;
}

.doctors .box-container .box span {
    color: var(--green);
    font-size: 1.5rem;
}

/* adress */

.addres1 {
    padding-bottom: 4rem;
}

.addres1 .addres2 {
    padding-top: 5rem;
    display: flex;
    justify-content: space-between;
    width: 1200px;
    margin: 0 auto;
    align-items: center;
}

.addres1 .addres2 .box {
    width: 400px;
}

.addres1 .addres2 .box h3 {
    color: var(--black);
    font-size: 2.5rem;
    margin-bottom: 15px;
}


.addres1 .addres2 .box span {
    color: var(--green);
    font-size: 1.5rem;
}

.addres1 .addres2 .box img {
    height: 200px;
}

/* footer style */

.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

.b-example-divider {
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

footer {
    font-size: 14px;
}

.nav-item {
    display: flex;
    align-items: center;
}

.nav-item .fab {
    margin-right: 10px;
}

/* qyzmetter html bastalady */

.top {
    margin-top: 140px;
}

.qyzmetter hr {
    border: none;
    height: 3px;
    margin: 40px 0;
    background-image: linear-gradient(to right, #FFF, #13AB7B, #FFF);
}

hr:before,
hr:after {
    content: '';
    display: inline-block;
    border-radius: 100%;
    width: 40px;
    height: 40px;
    border: 2px solid #13AB7B;
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #FFF;
}

hr:after {
    animation: anim-hr 2s linear infinite;
}

@keyframes anim-hr {
    0% {
        width: 40px;
        height: 40px;
    }

    100% {
        width: 0;
        height: 0;
    }
}

.qyzmetter {
    display: flex;
    /* Используем grid layout */
    justify-content: space-evenly;
    flex-wrap: wrap;
    width: 1200px;
    margin: 0 auto;
}

.qyzmetter .box {
    margin-top: 50px;
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 350px;
    min-height: 415px;
}

.qyzmetter .box a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
}

.qyzmetter .box a img {
    margin-right: 15px;
    width: 40px;
    height: 40px;
}

.qyzmetter .box h3 {
    margin: 0;
    font-size: 18px;
    color: var(--green);
}

.qyzmetter .box p {
    font-size: 15px;
    margin: 10px 0;
}

/* Жазылу бетінің дизайны басталды */

.doctor-card {
    margin-top: 145px;
    min-height: 100vh;
    
}


.profile-card {
    display: flex;
    align-items: center;
    margin-bottom: 50px;
    margin-left: 120px;
    margin-right: 120px;
    padding: 50px;
    box-shadow: var(--border);
    border-radius: 2rem;
    outline: .1rem solid rgba(0, 0, 0, .1);
    outline-offset: -1rem;
    box-shadow: 0 .5rem 1.5rem 1.5rem rgba(0, 0, 0, .1);
}

.profile-image {
    flex: 0 0 auto;
    /* Жестко фиксируем размер блока с фото профиля */
    margin-left: 50px;
    margin-right: 200px;
}

.profile-image img {
    width: auto;
    /* Ширина фото профиля */
    height: 200px;
    /* Высота фото профиля */
    border-radius: 4px;
    /* Делаем фото круглым */
}

.profile-details {
    flex: 1;
    /* Оставшееся пространство для данных профиля */
}

.profile-details h3 {
    margin-top: 0;
    /* Убираем внешний отступ у заголовка */
    font-size: 31px;
    color: #13AB7B;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.profile-card .profile-details hr {
    border: none;
    height: 3px;
    margin: 20px 0;
    background-image: linear-gradient(to right, #13AB7B, #13AB7B, #13AB7B);
}

.profile-card .profile-details hr:before,
.profile-card .profile-details hr:after {
    content: '';
    display: inline-block;
    border-radius: 100%;
    width: 40px;
    height: 40px;
    border: 2px solid #13AB7B;
    position: absolute;
    left: 85%;
    transform: translate(-50%, -50%);
    background: #FFF;
}

.profile-card .profile-details hr:after {
    animation: anim-hr 2s linear infinite;
}

@keyframes anim-hr {
    0% {
        width: 40px;
        height: 40px;
    }

    100% {
        width: 0;
        height: 0;
    }
}

.profile-details p {
    margin: 10px 0;
    /* Внешние отступы у абзацев */
    font-size: 15px;
    color: var(--light-color);
}

.profile-card .profile-details .btn {
    margin-left: 500px;
    display: inline-block;
    padding: 10px 30px;
    border: none;
    border-radius: 5px;
    background-color: #13AB7B;
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    transition: 0.4s ease;
}

.profile-card .profile-details .btn:hover {
    background-color: var(--light-color);
    color: white;
}

/* card end */

/* Modal-form start */

.doctor-card .profile-card .profile-details .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    overflow: auto;
    justify-content: center;
    align-items: center;
}

.doctor-card .profile-card .profile-details .modal-content{
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    text-align: center;
}

.doctor-card .profile-card .profile-details .close{
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.doctor-card .profile-card .profile-details .close:hover,
.doctor-card .profile-card .profile-details .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


/* login start */
.login-page{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(img/login-background.jpeg) no-repeat;
    background-size: cover;
}

.login-page .login-container{
    /* background-color: #13AB7B; */
    width: 420px;
    border: 2px solid rgb(255, 255, 255, 0.1);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    color: #fff;
    border-radius: 10px;
    backdrop-filter: blur(25px);
}

.login-page .login-container h1{
    font-size: 36px;
    text-align: center;
    padding-top: 25px;
}

.login-page .login-container .input-box{
    position: relative;
    width: 380px;
    height: 50px;
    margin: 30px 20px; 
}

.login-page .login-container .input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgb(255, 255, 255, 0.2);
    border-radius: 5px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
}

.login-page .login-container .input-box input::placeholder{
    color: #fff;
}

.login-page .login-container .btn{
    width: 380px;
    height: 45px;
    background: transparent;
    border: none;
    outline: none;
    border-radius: 5px;
    box-decoration-break: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 30px 20px;
    font-size: 18px;
    border: 2px solid rgb(255, 255, 255, 0.2);
    color: white;
}

.login-page .login-container .btn:hover{
    color: var(--black);
    background: none;
    background: white;
    border: none;
    outline: none;
    border: 2px solid rgb(255, 255, 255, 0.2);
    transition: 0.4s ease;
}

/* modal form */

.modal-forma{
    width: 800px;
    margin: 0 auto;
    margin-top: 140px;
    margin-bottom: 80px;
}

.modal-forma-info {
    margin: 0 auto;
    margin-top: 50px;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.modal-forma h2 {
    text-align: center;
    margin-top: 0;
    font-size: 80px;
}

.modal-forma label {
    display: block;
    margin: 10px 0 5px;
    font-size: 15px;
}

.modal-forma input,
.modal-forma select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 18px;
}


.button-container {
    display: flex;
    justify-content: space-between;
}

.button-container a {
    display: block;
    width: 48%;
    padding: 10px;
    text-align: center;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    background-color: var(--green);
    font-size: 14px;
}

.button-container a:hover {
    background-color: var(--black);
    transition: ease 0.4s;
    width: 50%;
    font-size: 16px;
}


    

</style>