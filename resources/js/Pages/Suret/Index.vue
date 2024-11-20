<template>
    <Head />
    <div class="b1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="blog-index">
                        {{ !filter ? 'Hamma to\'ylar' : filter.description }} uchun taklifnoma namunalari
                    </h1>
                </div>
                <div class="col-12 col-sm-6 col-md-8"></div>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-center justify-content-end gap-2 mb-4">
                    <div class="selectspan">To'y turi:</div>
                    <select class="selecttoilar" @change.prevent="search" v-model="filter">
                        <option :value="null">
                            Hammasi
                        </option>
                        <option v-for="typee in types" :key="typee.id" :value="typee">
                            {{ typee.name }}
                        </option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-4" v-for="(maket, index) in maket.data" :key="'maket' + maket.id">
                    <div class="blog-a2">
                        <img :src="'/storage/' + maket.shablon_image" class="img-fluid mt-3" :alt="maket.title + ' taklifnomasi'">
                        <div class="blog-title">{{ maket.type.description }} uchun {{ maket.title }}
                            taklifnoma</div>
                        <div class="d-flex justify-content-around align-items-center gap-3 mt-2 mb-2">
                            <!-- <div class="shoto_price text-center" v-if="maket.price>0">{{ maket.price }}₸</div> -->
                            <div class="shoto_price text-center" v-if="maket.price>0">50000 so'm</div>
                            <div class="shoto_price text-center" v-else>Bepul</div>
                            <Link :href="route('suret.edit', [maket.type.latin_name, maket.id])"
                                class="blog-button2 w-100" title="Конструктор">
                                Yasab ko'rish
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="justify-content-center d-flex pb-5 c-p pagination">
                    <Pagination :links="maket.links" />
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>
<script>
import Pagination from "@/Components/Pagination.vue";
import Head from "@/Components/header.vue";
import Footer from "@/Components/main_footer.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Pagination,
        Head,
        Link,
        Footer,
    },
    props: [
        'maket',
        'types',
        'filter',
    ],
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
            document.title = !this.filter ? 'Barcha to‘ylar uchun surat taklifnomalarining namunalari | e-taklif.uz' : this.filter.description + ' uchun surat taklifnomalarining namunalari | e-taklif.uz';
        },
        search() {
            this.loading = 1
            if (this.filter) {
                if (this.filter.id < 13){
                    this.$inertia.visit('/suret/' + this.filter.latin_name);
                }
                else {
                    const link = document.createElement('a');
                    link.href = 'https://shaqyru.kz/suret/'  + this.filter.latin_name;
                    link.click();
                }
                
            }
            else {
                this.$inertia.get(route('suret.index'))
            }
        },
    }
};
</script>
<style>
.c-p {
    cursor: pointer;
}
.img-fluid{
    width: 100%;
    height: 100%;
    min-width: 244px;
    min-height: 244px;
}
.b1 {
    background: #F8F8F8;
    padding: 60px;
}

.blog-index {
    font-size: 34px;
    font-weight: 600;
    margin-bottom: 40px;
    text-align: center;
    font-family: 'Gilroy400';
}

.selectspan {
    font-size: 18px;
    font-family: 'Gilroy600';
}

.selecttoilar {
    width: 135px;
    height: 45px;
    margin-left: 10px;
    margin-right: 15px;
    padding: 0 9px;
    font-family: 'Gilroy400';
}

.blog-a2 {
    display: block;
    border-radius: 5px;
    padding: 0 15px 15px;
    margin-bottom: 20px;
    border: 1px solid #ebebeb;
    transition: 0.3s all ease;
}


.blog-title {
    font-size: 18px;
    margin-top: 10px;
    font-weight: 700;
    font-family: 'Gilroy600';
}

.shoto_price {
    color: white;
    font-size: 20px;
    background: green;
    border-radius: 30px;
    padding: 5px 10px;
    font-family: 'Gilroy600';
    white-space: nowrap;
}

.blog-button2 {
    background: linear-gradient(263.43deg, #00ADFF 16.23%, #04ACFB 48.37%, #00A6FA 72.92%, #00ADFF 94.53%);
    box-shadow: 0px 10px 20px rgb(0 127 166 / 20%);
    border-radius: 45px;
    height: 42px;
    text-align: center;
    font-size: 18px;
    font-family: 'gilroy500';
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Gilroy500';
}

.blog-button2:hover {
    background: linear-gradient(263.43deg, #079fe7 16.23%, #2cbbff 48.37%, #70bce3 72.92%, #00acff 94.53%);
    box-shadow: 0px 10px 20px rgb(0 127 166 / 30%);
    color: #fff;
}

.pagination {
    font-family: 'Gilroy400';
    font-size: 16px;
}

.float-right {
    gap: 5px;
}

a.page-link {
    height: 38px;
    width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none !important;
    border: 1px solid #00A6FA !important;
    color: #00A6FA;
}


.active a.page-link {
    background: linear-gradient(263.43deg, #00ADFF 16.23%, #04ACFB 48.37%, #00A6FA 72.92%, #00ADFF 94.53%);
    font-family: 'Gilroy400';
    font-size: 16px;
}

@media (max-width: 767px) {
    .b1 {
        padding: 50px 10px;
    }

    .blog-index {
        font-size: 24px;
        line-height: 28px;
        margin-bottom: 30px;
    }
}
</style>