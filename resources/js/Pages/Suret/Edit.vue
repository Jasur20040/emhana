<template>

    <head>
        <link v-for="(shrift, index) in shrifts" :key="index" :href="'/storage/' + shrift.shrift_css" rel="stylesheet">
    </head>

    <Head />
    <div class="wrapper mx-auto">
        <div class="Gilroy400" @click="back()">
            <div class="btn btn-color d-flex w-fit-content align-items-center gap-2" @click="reset()">
                <b>Orqaga qaytish</b>
                <i class="fas fa-solid fa-reply"></i>
            </div>
        </div>
        <div class="avatar" v-if="with_avatar">
            <div v-if="isCropper" class="overlay" @click="hideCropper()">
                <div @click.stop class="cropper_out">
                    <div class="cropper_head d-flex align-items-center justify-content-between">
                        <div class="cropper_decription">
                            Rasmni kesish
                        </div>
                        <button type="button" class="cropper_close" @click="hideCropper()">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="hideCropper()">Bekor qilish</button>
                        <button type="button" class="btn btn-primary" @click="cropImage">Saqlash</button>
                    </div>
                    <div class="cropper_body">
                        <cropper :key="inputKey" ref="cropper" :stencil-props="{
                            aspectRatio: avatar_sizes.aspectRatio
                        }" class="cropper-popup" :src="input_ava" v-if="input_ava" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block">
            <div class="d-flex align-items-center justify-content-center text-center description mt-2 w-100">
                Matn ustiga bosib shriftini , <br/>
                rangini, o'lchamini o'zgartirishingiz mumkin.
            </div>
            <a href="https://youtu.be/hOCMnkKMr9U?si=T5TVVBsNy0L2qJZu" target="_blank" class="btn btn-link text-decoration-none d-flex justify-content-center description w-100">
                Video qo'llanmani ko'rish
            </a>
        </div>
        <div class="option_panel d-flex justify-content-around align-items-center mt-3"
            :class="!options[text_index].can_replace ? 'w-fit-content' : ''">
            <div class="icon_size c-p no-select" style="font-size: 18px;" @click="chooseSlider(1)"
                :class="slider == 1 ? 'active_icon' : ''">
                <b>T</b>
            </div>
            <div class="align-items-center icon_size c-p no-select" @click="chooseSlider(2)"
                :class="slider == 2 ? 'active_icon' : ''">
                <div class="d-flex align-items-baseline">
                    <i class="fas fa-font"></i>
                    <i class="fas fa-font" style="font-size: 10px;"></i>
                </div>
            </div>
            <i class="fas fa-palette icon_size c-p no-select" @click="chooseSlider(4)"
                :class="slider == 4 ? 'active_icon' : ''"></i>
            <i class="fas fa-solid fa-align-left icon_size c-p no-select" @click="changeText(1)"
                :class="options[text_index].position == 'text-left' ? 'active_icon' : ''"
                v-if="options[text_index].can_replace"></i>
            <i class="fas fa-solid fa-align-center icon_size c-p no-select" @click="changeText(2)"
                :class="options[text_index].position == 'text-center' ? 'active_icon' : ''"
                v-if="options[text_index].can_replace"></i>
            <i class="fas fa-solid fa-align-right icon_size c-p no-select" @click="changeText(3)"
                :class="options[text_index].position == 'text-right' ? 'active_icon' : ''"
                v-if="options[text_index].can_replace"></i>
            <i class="fas fa-solid fa-bold icon_size c-p no-select" @click="changeText(4)"
                :class="options[text_index].is_bold ? 'active_icon' : ''"></i>
            <i class="fas fa-solid fa-italic icon_size c-p no-select" @click="changeText(5)"
                :class="options[text_index].is_italic ? 'active_icon' : ''"></i>
            <i class="fas fa-solid fa-underline icon_size c-p no-select" @click="changeText(6)"
                :class="options[text_index].is_underline ? 'active_icon' : ''"></i>
        </div>
        <div class="d-flex align-items-center corousel" v-if="slider == 1">
            <carousel :items-to-show="2" class="slider pt-1 pb-1">
                <slide v-for="shrift in maket.shrifts" :key="shrift.id"
                    class="color_box d-flex justify-content-center align-items-center c-p max_w-input"
                    :class="[options[text_index].shrift == shrift.name ? 'color_box_active' : '']"
                    @click="assignShrift(shrift.name)">
                    <div :style="['font-family: ' + shrift.name]">
                        {{ shrift.name }}
                    </div>
                </slide>
                <template #addons>
                    <navigation />
                </template>
            </carousel>
        </div>
        <div class="d-flex align-items-center corousel" v-if="slider == 2">
            <carousel :items-to-show="10" class="slider pt-1 pb-1">
                <slide v-for="fontSize in 131" :key="fontSize"
                    class="color_box d-flex justify-content-center align-items-center c-p"
                    :class="[options[text_index].size == fontSize + 19 ? 'color_box_active' : '', (fontSize + 19) > options[text_index].maxSize ? 'deactiveSize' : '']"
                    @click="assignSize(fontSize + 19)">
                    {{ fontSize + 19 }}
                </slide>
                <template #addons>
                    <navigation />
                </template>
            </carousel>
        </div>
        <div class="d-flex align-items-center corousel" v-if="slider == 4">
            <carousel :items-to-show="5" class="slider pt-1 pb-1">
                <slide v-for="(color, index) in standartColors" :key="index"
                    class="color_box d-flex justify-content-center align-items-center c-p"
                    :class="[options[text_index].color == color.name ? 'color_box_active' : '']"
                    @click="assignColor(color.name)">
                    <div class="color_bubble" :style="'background-color: ' + color.name"></div>
                </slide>
                <template #addons>
                    <navigation />
                </template>
            </carousel>
        </div>
        <div class="maket_wrapper">
            <div class="mx-auto w-fit-content">
                <div class="maket mx-auto">
                    <div class="maket_container">
                        <input type="file" ref="avaInput" style="display: none" @change="handleFileChange"
                            :key="inputKey" />
                        <div v-if="with_avatar" class="d-flex align-items-center gap-2">
                            <div class="w-100" v-if="!cropped_ava && cnt == 0">
                                <div class="c-p upload_input d-flex align-items-center gap-2 btn btn-primary mt-2 w-100 justify-content-center"
                                    @click="openFileInput">
                                    Rasm qo'shish
                                    <i class="fas fa-solid fa-upload"></i>
                                </div>
                            </div>
                            <div class="w-100" v-if="cropped_ava || cnt > 0">
                                <div class="c-p upload_input d-flex align-items-center gap-2 btn btn-primary mt-2 w-100 justify-content-center"
                                    @click="openFileInput">
                                    Rasmni o'zgartirish
                                    <i class="fas fa-solid fa-upload"></i>
                                </div>
                            </div>
                            <div class="w-100" v-if="(!isCropper && cropped_ava) || cnt > 0">
                                <div class="c-p upload_input d-flex align-items-center gap-2 btn btn-primary mt-2 w-100 justify-content-center"
                                    @click="openCropper()">
                                    Qayta qirqish
                                    <img :src="'/static/cut.svg'" class="cut" />
                                </div>
                            </div>
                        </div>
                        <img :src="'/static/StampWater.png'" class="no_paid maket_img"
                            :class="{ 'mt-3': with_avatar }" ref="stamp" />
                    </div>
                </div>
                <div class="maket mx-auto mt-3" ref="maket">
                    <div ref="parent" class="maket_container shadow" id="maket">
                        <div class="position-relative shablon h-100">
                            <div class="ava_block" :style="avaStyles()" v-if="with_avatar">
                                <!-- <img :src="'/static/ava_place.jpg'" class="ava_imgg" v-if="with_avatar && !cropped_ava"
                                    :style="['border-radius: ' + avatar_sizes.border_radius + '%']" />
                                <img :src="cropped_ava" class="ava_imgg" v-else
                                    :style="['border-radius: ' + avatar_sizes.border_radius + '%']"> -->
                                <img :src="cropped_ava" class="ava_imgg" v-if="with_avatar && cropped_ava"
                                    :style="['border-radius: ' + avatar_sizes.border_radius + '%']">
                            </div>
                            <img ref="image" :src="'/storage/' + maket.maket_image" class="maket_img"
                                @load="adjustParentHeight" />
                            <div class="texts d-block">
                                <div v-for="(option, index) in options" :key="index">
                                    <div class="mx-auto text c-p" contenteditable="true"
                                        @input="inputText($event, index)" @click="takeIndex(index)"
                                        @focusout="inputFocusOut(index)" :style="optionStyles(option)"
                                        :class="{ 'bold': option.is_bold, 'italic': option.is_italic, 'underline': option.is_underline, [option.position]: true }">
                                        {{ option.text }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-block mt-3">
                        <div class="d-flex justify-content-center description w-100 text-center mb-2">
                            Taklifnomangizni tayyorlagan bo'lsangiz,
                            <br>
                            uni yuklab olishingiz mumkin.
                        </div>
                        <button @click="captureElement()" v-if="!loading && maket.price>0" class="btn btn-primary w-100 Gilroy300">
                            Yuklash - <!-- {{ maket.price }}-->50000 so'm 
                        </button>
                        <button @click="captureElement()" v-else-if="!loading && maket.price==0" class="btn btn-primary w-100 Gilroy300">
                            Bepul
                        </button>
                        <div class="progress mt-2" v-if="loading">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                :style="{ width: progress + '%' }"></div>
                        </div>
                        <div class="reset btn btn-link d-flex align-items-center gap-2 Gilroy300 justify-content-center w-100"
                            @click="reset()">
                            <b>Asl holatiga qaytarish</b>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div v-if="showModal" class="whatsapp-overlay" @click="closeModal">
        <div class="whatsapp" v-if="clientMaketId"  @click.stop>
            <img :src="'/static/close.svg'" @click="closeModal()" alt="" class="close_popup">
            <!-- <Lottie class="succes" :options="successOption" v-on:animCreated="handleAnimation" /> -->
            <div class="whatsapp-otu">
                <img :src="'/static/satti.webp'" alt="" class="succes">
                <div class="kutti">Tabriklamymiz!</div>
                <div class="sh_nom">Sizning taklifnomangiz #{{clientMaketId }} tayyor!</div>
                <div class="text_whats">
                    Taklifnomani to'lab va yuklab olish uchun menejerning telegramiga #{{clientMaketId }} nomerini yuboring.
                </div>
                <button class="whats_button" @click="generateTelegramLink">
                    <img :src="'/static/telegram-white.svg'" alt="" class="iconka-whatsapp">
                    Telegram-ga yozish
                </button>
                <div class="keste">
                    Ish jadvali: <br>
                    Dam olishsiz 9:00-22:00 vaqt oralig'ida
                </div>
            </div>
        </div>
        <div class="whatsapp" v-else @click.stop>
            <img :src="'/static/close.svg'" @click="closeModal()" alt="" class="close_popup">
            <div class="whatsapp_kate">
                <div class="kate">
                    Taklifnoma to'g'ri saqlanmadi, qaytalab ko'ring
                </div>
            </div>
        </div>
    </div>

    <Footer />
</template>
<script>
import Head from "@/Components/header.vue";
import Footer from "@/Components/main_footer.vue";
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Navigation } from 'vue3-carousel'

import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import html2canvas from 'html2canvas';
// import Lottie from 'vue-lottie/src/lottie.vue';
// import Lottie from 'vue-lottie';
// import animationSuccess from "@/json/satti_zhauap.json";
export default {
    components: {
        Head,
        Carousel,
        Slide,
        Navigation,
        Cropper,
        Footer,
        // Lottie,
    },
    props: [
        'maket',
    ],
    data() {
        return {
            with_avatar: this.maket.with_avatar ? true : false,
            avatar_sizes: JSON.parse(this.maket.avatar_sizes),
            input_ava: null,
            cropped_ava: null,
            options: JSON.parse(this.maket.texts),
            standartColors: JSON.parse(this.maket.colors),
            text_index: 0,
            slider: 1,
            isCropper: false,
            screenWidth: window.innerWidth,
            inputTextTemp: '',
            loading: false,
            progress: 0,
            whatsappLink: null,
            inputKey: 0,
            cnt: 0,
            isChat: false,
            showModal: false,
            // successOption: {
            //     animationData: animationSuccess,
            //     loop: false,
            // },
            // anim: null,
            clientMaketId: null,
        };
    },
    mounted() {
        this.handleResize();
        window.addEventListener('resize', this.handleResize);
        // this.addTitle();
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        // handleAnimation: function(anim) {
        //     this.anim = anim;
        // },
        startProgress() {
            this.loading = true;
            this.progress = 0;

            const duration = 2000;
            const interval = 100;

            const steps = duration / interval;
            let step = 0;

            const progressInterval = setInterval(() => {
                step++;
                this.progress = Math.round((step / steps) * 100);

                if (step >= steps) {
                    clearInterval(progressInterval);
                    this.progress = 100;
                    setTimeout(() => {
                        this.loading = false;
                        this.showModal = true;
                        // window.open(this.whatsappLink, '_blank');
                    }, 700);
                }
            }, interval);
        },
        back() {
            window.history.back();
        },
        reset() {
            this.inputTextTemp = ''
            this.options = JSON.parse(this.maket.texts);
            this.cropped_ava = null;
            this.isCropper = false;
            this.input_ava = null;
        },
        captureElement() {
            const maket = document.getElementById('maket');
            this.startProgress();
            html2canvas(maket, {
                scale: 2,
                quality: 1,
                allowTaint: true,
            }).then(canvas => {
                const imageData = canvas.toDataURL('image/jpeg', 1.0);
                this.uploadImage(imageData);
            });
            
        },
        closeModal() {
            this.showModal = false;
        },
        uploadImage(imageData) {
            axios.put(route("suret.update", this.maket.id), {
                image: imageData
            })
                .then(response => {
                    this.clientMaketId = response.data.client_maket.id;
                    // this.anim.play();
                })
        },
        generateTelegramLink() {
            console.log('sss')
            const message = encodeURIComponent(`Assalomu alaykum. Men #${this.clientMaketId} taklifnomasini sotib olmoqchiman.`);
            this.telegramLink = `https://t.me/e_taklif?text=${message}`;
            window.open(this.telegramLink, '_blank');
        },
        handleResize() {
            this.adjustParentHeight();
            this.updateScreenWidth();
        },
        updateScreenWidth() {
            this.screenWidth = window.innerWidth;
        },
        avaStyles() {
            return {
                'margin-top': this.avatar_sizes.margin_top + '%',
                'margin-left': this.avatar_sizes.margin_left + '%',
                'width': this.avatar_sizes.width + '%',
                'height': this.avatar_sizes.height + '%',
                'z-index': this.avatar_sizes.z_index,
                'border-radius': this.avatar_sizes.border_radius + '%',
            };
        },
        optionStyles(option) {
            const commonStyles = {
                'margin-top': option.margin_top + '%',
                'transform': 'translateX(' + option.transform_x + '%)',
                'max-width': option.max_width + '%',
                'color': option.color,
                'font-size': option.size / 3 + 'px',
                'font-family': option.shrift,
                'line-height': option.line_height + 'px',
                'max-height': option.line_height * option.max_height + 2 + 'px',
            };
            if (this.screenWidth <= 470 && this.screenWidth > 400) {
                return {
                    ...commonStyles,
                    'font-size': option.size * 0.8 / 3 + 'px',
                    'line-height': option.line_height * 0.8 + 'px',
                    'max-height': option.line_height * 0.8 * option.max_height + 2 + 'px',
                };
            }
            else if (this.screenWidth <= 400) {
                return {
                    ...commonStyles,
                    'font-size': option.size * 0.65 / 3 + 'px',
                    'line-height': option.line_height * 0.65 + 'px',
                    'max-height': option.line_height * 0.65 * option.max_height + 2 + 'px',
                };
            }
            return commonStyles;
        },
        adjustParentHeight() {
            const parent = this.$refs.parent;
            const stamp = this.$refs.stamp;
            const image = this.$refs.image;

            const imageHeight = image.offsetHeight;

            parent.style.height = imageHeight + 'px';
            stamp.style.height = imageHeight + 'px';
        },
        cropImage() {
            const result = this.$refs.cropper.getResult();
            this.cropped_ava = result.canvas.toDataURL("image/jpeg");

            const maketElement = this.$refs.maket;
            maketElement.scrollIntoView({ behavior: 'smooth' });
            this.hideCropper();
            this.cnt++;
        },
        hideCropper() {
            this.isCropper = false;
            document.body.classList.remove('body_style');
        },
        openCropper() {
            this.isCropper = true;
        },
        inputText(event) {
            this.inputTextTemp = event.target.textContent
        },
        inputFocusOut(index) {
            this.options[index].text = this.inputTextTemp
        },
        assignColor(color) {
            this.options[this.text_index].color = color;
        },
        assignShrift(shrift_name) {
            this.options[this.text_index].shrift = shrift_name;
        },
        assignSize(size) {
            this.options[this.text_index].size = size <= this.options[this.text_index].maxSize ? size : this.options[this.text_index].size;
        },
        takeIndex(index) {
            this.text_index = index;
            this.inputTextTemp = this.options[index].text
        },
        chooseSlider(sliderIndx) {
            this.slider = sliderIndx;
        },
        changeText(number) {
            if (number == 1) {
                this.options[this.text_index].position = 'text-left';
            }
            else if (number == 2) {
                this.options[this.text_index].position = 'text-center';
            }
            else if (number == 3) {
                this.options[this.text_index].position = 'text-right';
            }
            else if (number == 4) {
                this.options[this.text_index].is_bold = !this.options[this.text_index].is_bold;
            }
            else if (number == 5) {
                this.options[this.text_index].is_italic = !this.options[this.text_index].is_italic;
            }
            else if (number == 6) {
                this.options[this.text_index].is_underline = !this.options[this.text_index].is_underline;
            }
            else if (number == 7) {
                this.options[this.text_index].margin_top += 10;
            }
            else if (number == 8) {
                this.options[this.text_index].margin_top -= 10;
            }
            else if (number == 9) {
                this.options[this.text_index].max_width += 5;
            }
            else if (number == 10) {
                this.options[this.text_index].max_width -= 5;
            }
            else if (number == 11) {
                this.options[this.text_index].max_height++;
            }
            else if (number == 12) {
                this.options[this.text_index].max_height--;
            }
            else if (number == 13) {
                this.options[this.text_index].transform_x += 10;
            }
            else if (number == 14) {
                this.options[this.text_index].transform_x -= 10;
            }
        },
        openFileInput() {
            this.$refs.avaInput.click();
        },
        handleFileChange(event) {
            this.inputKey++;
            const file = event.target.files[0];
            this.loadImage(file);
        },
        loadImage(file) {
            if (file && file.type.startsWith('image/')) {
                this.input_ava = null;
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.input_ava = event.target.result;
                };
                reader.readAsDataURL(file);
                this.isCropper = true;

                document.body.classList.add('body_style');
            } else {
                alert('Iltimos, rasm tanlang!');
            }
        },
    }
};
</script>
<style>
.body_style {
    overflow: hidden;
}
.succes {
    width: 150px !important;
    height: 150px !important;
    /* margin-top: -80px !important; */
    /* position: absolute; */
    /* left: 50%;
    transform: translate(-50%); */
}
.kate{
    color: red;
    font-size: 30px;
}
.whatsapp-overlay {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    transition: opacity 0.15s linear;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.5);
}
.whatsapp {
    position: relative;
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1001;
    margin: 20px !important;
}
.close_popup {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
}
.whatsapp_kate {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: 60px 10px;
}
.whatsapp-otu {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    /* margin-top: 180px; */
}
.kutti{
    color: rgb(9, 201, 9);
    font-size: 24px;
    font-weight: 700;
}
.sh_nom{
    font-size: 16px;
    font-weight: 700;
    margin: 5px 0;
}
.text_whats{
    font-size: 16px;
    max-width: 360px;
    width: 100%;
}
.whats_button{
    background: #55ACEE;
    border-radius: 5px;
    width: 100%;
    max-width: 280px;
    border: 0px;
    padding: 10px;
    display: flex;
    justify-content: center;
    color: #FFFFFF;
    margin: 20px 0;
    font-size: 18px;
    box-shadow: 0px 6px 10px -5px #00000061;
}
.iconka-whatsapp {
    width: 28px;
    margin-right: 10px;
}
.keste{
    color: rgb(174, 174, 174);
    font-size: 14px;
    margin-bottom: 30px;
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow-y: auto;
    padding: 0 17px;
    align-items: start;
}

.cropper_out {
    max-width: 800px;
    width: 100%;
    ;
    background-color: #fff;
    margin-bottom: 58px;
    position: relative;
    margin-top: 35px;
    border-radius: calc(0.3rem - 1px);
}

.cropper_body {
    padding: 0 16px;
    height: auto;
}

.cropper-popup {
    margin: 0 auto;
    height: auto;
    margin-top: 16px;
    margin-bottom: 16px;
    border-bottom: 1px solid #dee2e6;
    width: 100%;
}

.cropper_head {
    max-height: 63px;
    height: 100%;
    padding: 16px;
    font-size: 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}

.cropper_close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    text-shadow: 0 1px 0 #efefef;
    opacity: .5;
    border: none;
    background: none;
}

.cropper_close span {
    color: #1b1b1b;
}

.cropper_close span:hover {
    color: #000;
}

.modal-footer {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 16px;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
    gap: 8px;
}

.progress {
    height: 20px;
    margin-bottom: 20px;
}

.Gilroy300 {
    font-family: 'Gilroy300';
    font-weight: 300;
}

.Gilroy400 {
    font-family: 'Gilroy400';
    font-weight: 400;
}

.image-upload {
    text-align: center;
}

.drop-area {
    display: block;
    background: #EFF3FF;
    border: 2px dashed #1C77FD;
    border-radius: 6px;
    padding: 20px;
    transition: 0.3s all;
}

.wrapper {
    max-width: 550px;
    width: 100%;
    padding: 10px 15px;
}

.btn-color {
    background-color: #329ad7;
    color: #fff;
    border: none;
}

.btn-color:hover {
    background-color: #329ad7;
    color: #fff;
}

.description {
    font-size: 16px;
}

.w-fit-content {
    width: fit-content;
}

.corousel {
    max-width: 520px;
    width: 100%;
}

.maket {
    width: fit-content;
}

.maket_container {
    position: relative;
    width: 400px;
}

.cut {
    width: 20px;
}

.shadow {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5) !important;
}

.no_paid {
    z-index: 1;
}

.shablon {
    width: 400px;
    position: relative;
}

.ava_place {
    height: 45px;
    z-index: 1;
    top: 50%;
    left: 50%;
    transform: rotateZ(-30deg) translate(-35%, -150%);
}

.ava_block {
    position: absolute;
    top: 0;
    background-image: url('/static/ava_place.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.ava_imgg {
    width: 100%;
    height: 100%;
}

.maket_img {
    width: 100%;
    height: auto;
    min-width: 260px;
    min-height: 260px;
    position: absolute;
}

.texts {
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 2;
}

[contenteditable="true"]:focus {
    outline: 1px solid #fdd835;
}

.color_box {
    height: 34px;
    transition: 0.3s all ease;
}

.color_box:hover {
    background: #efefef;
}

.color_box_active {
    background: #fdd835;
}

.deactiveSize {
    color: #d4d4d4;
}

.color_bubble {
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.no-select {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.text {
    overflow: hidden;
    border: 1px solid transparent;
    transition: 0.3s all ease;
}

.text:hover {
    border: 1px solid #fdd835;
}

.bold {
    font-weight: 900;
}

.italic {
    font-style: italic;
}

.underline {
    text-decoration: underline;
}

.option_panel {
    max-width: 520px;
    height: 34px;
    background: #efefef;
}

.slider {
    max-width: 520px;
    width: 100%;
    padding: 0 50px;
}

.carousel__viewport {
    max-width: 420px;
}

ol.carousel__track {
    transition: all 0ms ease 0s;
    width: 100%;
    margin-bottom: 0;
}

.icon_size {
    display: flex;
    height: 100%;
    max-width: 34px;
    width: 100%;
    align-items: center;
    justify-content: center;
}

.active_icon {
    background: #fdd835;
}

.c-p {
    cursor: pointer;
}

.reset {
    text-decoration: none;
    margin-top: 10px;
}

@media (max-width: 960px) {
    .cropper_out {
        max-width: 600px;
        margin: 1.75rem auto;
    }
}

@media (max-width: 760px) {
    .cropper_out {
        max-width: 500px;
    }
}

@media (max-width: 576px) {
    .cropper_out {
        max-width: 500px;
    }
}

@media screen and (max-width: 470px) {
    .maket_container {
        width: 320px;
    }

    .shablon {
        width: 320px;
    }

    .upload_input {
        width: 100%;
        justify-content: center;
    }

    .progress {
        max-width: 100%;
    }
}

@media screen and (max-width: 400px) {
    .maket_container {
        width: 260px;
    }

    .shablon {
        width: 260px;
    }
}
</style>