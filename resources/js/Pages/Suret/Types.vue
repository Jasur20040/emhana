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
.section {
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
    width: 100%;
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

</style>