<template>

    <head>
        <title>Админ панель | Макет қосу</title>
        <link v-for="(shrift, index) in shrifts" :key="index" :href="shrift.link" rel="stylesheet">
        <link v-for="(shrift, index) in shrifts" :key="index" :href="'/storage/' + shrift.shrift_css" rel="stylesheet">
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Макет қосу</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a :href="route('admin.maket.index')">
                                <i class="fas fa-dashboard"></i>
                                Макеттер тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Макет қосу
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Көрсетілетін шаблон</label>
                        <input class="form-control max_w-input" type="file" @change="handleFileChange($event, 0)"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Құрастырылатын бос шаблон</label>
                        <input class="form-control max_w-input" type="file" @change="handleFileChange($event, 1)"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Аты</label>
                        <input type="text" class="form-control max_w-input" required v-model="title"
                            placeholder="Аты" />
                    </div>
                    <div class="form-group">
                        <label for="">Бағасы</label>
                        <input type="text" class="form-control max_w-input" required v-model="price"
                            placeholder="Бағасы" />
                    </div>
                    <div class="form-group">
                        <label for="">Типі</label>
                        <select class="form-control max_w-input" v-model="selectedType" required>
                            <option v-for="typee in types" :key="typee.id" :value="typee.id">
                                {{ typee.name }}
                            </option>
                        </select>
                    </div>
                    <h6><b>Аватар?</b></h6>
                    <input class="switch mb-2" type="checkbox" v-model="with_avatar">
                    <div v-if="with_avatar">
                        <input type="file" @change="handleFileChange($event, 2)" class="mb-2 form-control max_w-input">
                        <div class="form-group">
                            <label for="">Пропорциясы</label>
                            <input type="number" class="form-control max_w-input" required
                                v-model="avatar_sizes.aspectRatio" placeholder="Пропорциясы 0,5, 0.75, 1 т.с.с." />
                        </div>
                        <div class="max_w-input" v-if="isCropper">
                            <cropper ref="cropper" :stencil-props="{
                                aspectRatio: avatar_sizes.aspectRatio
                            }" class="example-cropper" :src="input_ava" v-if="input_ava" />

                            <button @click="cropImage" class="btn btn-success mb-3 mr-2" v-if="isCropper && input_ava">
                                Суретті қырқу
                            </button>
                            <button @click="hideCropper()" class="btn btn-primary mb-3" v-if="isCropper">
                                <i class="fas fa-regular fa-eye-slash"></i>
                            </button>
                        </div>
                        <button @click="openCropper()" class="btn btn-primary mb-3" v-if="!isCropper && input_ava">
                            <i class="fas fa-regular fa-eye"></i>
                        </button>
                        <div class="ava_option_panel d-flex justify-content-around align-items-center w-fit-content">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(1)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Mt</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(2)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Mt</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.margin_top">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(3)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Ml</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(4)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Ml</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.margin_left">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(5)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>W</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(6)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>W</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.width">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(7)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>H</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(8)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>H</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.height">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(9)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>zi</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(10)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>zi</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.z_index">
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(11)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Br</b></div>
                                    <i class="fas fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="align-items-center icon_size c-p no-select" @click="changeAva(12)">
                                <div class="d-flex align-items-baseline gap-1">
                                    <div style="font-size: 17px;"><b>Br</b></div>
                                    <i class="fas fa-solid fa-minus"></i>
                                </div>
                            </div>
                            <input type="number" class="panel_input margin_width" v-model="avatar_sizes.border_radius">
                        </div>
                    </div>
                    <hr>
                    <div class="option_panel d-flex justify-content-around align-items-center" v-if="options.length"
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
                        <div class="align-items-center icon_size c-p no-select" @click="chooseSlider(3)"
                            :class="slider == 3 ? 'active_icon' : ''">
                            <div class="d-flex align-items-baseline">
                                <i class="fas fa-solid fa-text-height"></i>
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
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(7)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>Mt</b></div>
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(8)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>Mt</b></div>
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                        </div>
                        <input type="number" class="panel_input margin_width" v-model="options[text_index].margin_top">
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(13)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>Tx</b></div>
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(14)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>Tx</b></div>
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                        </div>
                        <input type="number" class="panel_input margin_width" v-model="options[text_index].transform_x">
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(9)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>W</b></div>
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(10)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>W</b></div>
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                        </div>
                        <input type="number" class="panel_input margin_width" v-model="options[text_index].max_width">
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(11)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>H</b></div>
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="align-items-center icon_size c-p no-select" @click="changeText(12)">
                            <div class="d-flex align-items-baseline gap-1">
                                <div style="font-size: 17px;"><b>H</b></div>
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mr-2">
                            <input type="number" class="panel_input margin_width"
                                v-model="options[text_index].max_height">
                            <b>есе</b>
                        </div>
                    </div>
                    <div v-if="options.length">
                        <div class="d-flex align-items-center" v-if="slider == 1 && standartShrifts.length">
                            <carousel :items-to-show="2" class="slider pt-1 pb-1">
                                <slide v-for="shrift in standartShrifts" :key="shrift.id"
                                    class="color_box d-flex justify-content-center align-items-center c-p max_w-input"
                                    :class="[options[text_index].shrift == shrift.name ? 'color_box_active' : '']"
                                    @click="assignShrift(shrift.id)">
                                    <div :style="['font-family: ' + shrift.name]">
                                        {{ shrift.name }}
                                    </div>
                                </slide>
                                <template #addons>
                                    <navigation />
                                </template>
                            </carousel>
                        </div>
                        <div class="d-flex align-items-center" v-if="slider == 2">
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
                            <div class="btn btn-success mr-2" @click="increaseFontSize()">
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                            <div class="btn btn-warning" @click="decreaseFontSize()">
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                            <input type="number" class="panel_input margin_width mr-2"
                                v-model="options[text_index].size" :max="options[text_index].maxSize" :min=20>
                            <b>Max font-size:</b>
                            <input type="number" class="panel_input margin_width" v-model="options[text_index].maxSize"
                                :max="150" :min=20>
                        </div>
                        <div class="d-flex align-items-center" v-if="slider == 3">
                            <carousel :items-to-show="10" class="slider pt-1 pb-1">
                                <slide v-for="lineHeight in 131" :key="lineHeight"
                                    class="color_box d-flex justify-content-center align-items-center c-p"
                                    :class="[options[text_index].line_height == lineHeight + 9 ? 'color_box_active' : '']"
                                    @click="assignlineHeight(lineHeight + 9)">
                                    {{ lineHeight + 9 }}
                                </slide>
                                <template #addons>
                                    <navigation />
                                </template>
                            </carousel>
                            <div class="btn btn-success mr-2" @click="increaseLineHeight()">
                                <i class="fas fa-solid fa-plus"></i>
                            </div>
                            <div class="btn btn-warning" @click="decreaseLineHeight()">
                                <i class="fas fa-solid fa-minus"></i>
                            </div>
                            <input type="number" class="panel_input margin_width mr-2"
                                v-model="options[text_index].line_height" :max="options[text_index].maxSize" :min=10>
                        </div>
                        <div v-if="slider == 4 && standartColors.length">
                            <div class="d-flex align-items-center">
                                <carousel :items-to-show="5" class="slider pt-1 pb-1">
                                    <slide v-for="(color, index) in standartColors" :key="index"
                                        class="color_box d-flex justify-content-center align-items-center c-p"
                                        :class="[options[text_index].color == color.name ? 'color_box_active' : '']"
                                        @click="assignColor(color.name, index)">
                                        <div class="color_bubble" :style="'background-color: ' + color.name"></div>
                                    </slide>
                                    <template #addons>
                                        <navigation />
                                    </template>
                                </carousel>
                            </div>
                            <div class="d-flex align-items-center gap-2 ml-3 mt-3">
                                <input type="color" v-model="standartColors[color_index].name">
                                <input type="text" class="form-control max_w-input"
                                    v-model="standartColors[color_index].name">
                                <button type="button" class="btn btn-danger" @click="removeColor(color_index)">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 ml-3 mt-3" v-if="slider == 4">
                            <input type="color" v-model="temp_color">
                            <input type="text" class="form-control max_w-input" v-model="temp_color">
                            <button type="button" class="btn btn-success" @click="addColor(color_index)">
                                <i class="fas fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <multiselect v-model="standartShrifts" :options="shrifts" :multiple="true" :taggable="true"
                            placeholder="Шрифттарды таңдаңыз" label="name" :hide-selected="true"
                            :close-on-select="false" :searchable="false" track-by="id" v-if="slider == 1"
                            class="mt-3 ml-3">
                        </multiselect>
                    </div>
                    <hr>
                    <div v-for="(option, index) in options" :key="index" class="mb-3 mt-3">
                        <label>Тексті</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control max_w-input" v-model="option.text"
                                placeholder="Тексті" @click="takeIndex(index)" />
                            <button type="button" class="btn btn-danger mr-3" @click="removeOption(index)">
                                <i class="fas fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <input class="switch" type="checkbox" v-model="option.can_replace">
                        </div>
                        <hr>
                    </div>
                    <button @click.prevent="addOption()" class="btn btn-success mb-3">
                        <i class="fas fa-solid fa-plus mr-1"></i>
                        <b style="font-size: 17px">Текст</b>
                    </button>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-1" @click.prevent="submit()">
                        Сақтау
                    </button>
                    <button type="button" class="btn btn-danger" @click.prevent="back()">
                        Артқа
                    </button>
                </div>
            </div>
            <div class="makets">
                <div ref="parent" class="maket_container" :class="{ 'background_maket': bg_color }">
                    <div class="d-flex gap-1 h-100">
                        <div class="position-relative shablon">
                            <img ref="shablon_image" :src="preview_shablon" class="maket_img"
                                @load="adjustParentHeight" />
                        </div>
                        <div class="position-relative shablon" :class="{ 'background_maket': bg_color }">
                            <div class="ava_block" v-if="cropped_ava" :style="avaStyles()">
                                <img :src="cropped_ava" class="ava_imgg" v-if="cropped_ava"
                                    :style="['border-radius: ' + avatar_sizes.border_radius + '%']">
                            </div>
                            <img ref="image" :src="preview_maket" class="maket_img" @load="adjustParentHeight" />
                            <div class="texts d-block">
                                <div v-for="(option, index) in options" :key="index">
                                    <div class="mx-auto text" contenteditable="true" @input="inputText($event, index)"
                                        @click="takeIndex(index)" :style="optionStyles(option)"
                                        :class="{ 'bold': option.is_bold, 'italic': option.is_italic, 'underline': option.is_underline, [option.position]: true, 'active_text': index == text_index, 'clear_active': is_clear }">
                                        {{ option.text }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Navigation } from 'vue3-carousel'

import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";
export default {
    props: [
        'types',
        'shrifts',
    ],
    components: {
        AdminLayout,
        Head,
        Carousel,
        Slide,
        Navigation,
        Cropper,
    },
    data() {
        return {
            shablon_image: null,
            preview_shablon: null,
            maket_image: null,
            preview_maket: null,
            selectedType: this.types[0].id,
            title: '',
            price: null,
            with_avatar: false,
            avatar_sizes: {
                margin_top: 0,
                margin_left: 0,
                height: 50,
                width: 100,
                z_index: 0,
                border_radius: 0,
                aspectRatio: 1,
            },
            input_ava: null,
            cropped_ava: null,
            options: [{
                number: 1,
                text: 'test text 0',
                margin_top: 0,
                transform_x: 0,
                max_width: 70,
                shrift: this.shrifts[0].name,
                color: '#000000',
                size: 50,
                maxSize: 100,
                max_height: 2,
                line_height: 25,
                position: 'text-center',
                can_replace: true,
                is_bold: false,
                is_underline: false,
                is_italic: false,
            }],
            standartColors: [
                {
                    name: '#000000',
                },
                {
                    name: '#d3c0c0',
                },
                {
                    name: '#9de576',
                },
                {
                    name: '#55b3d3',
                },
                {
                    name: '#463806',
                },
            ],
            standartShrifts: [
                {
                    id: this.shrifts[0].id,
                    name: this.shrifts[0].name,
                },
                {
                    id: this.shrifts[1].id,
                    name: this.shrifts[1].name,
                },
            ],
            text_index: 0,
            is_clear: true,
            slider: 1,
            color_index: 0,
            temp_color: '#ffffff',
            bg_color: false,
            screenWidth: window.innerWidth,
            isCropper: false,
        }
    },
    mounted() {
        this.handleResize();
        window.addEventListener('resize', this.handleResize);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
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
            return commonStyles;
        },
        adjustParentHeight() {
            const parent = this.$refs.parent;
            const image = this.$refs.image;
            const shablon_image = this.$refs.shablon_image;

            const imageHeight = image.offsetHeight;
            const shablonImageHeight = shablon_image.offsetHeight;

            parent.style.height = shablonImageHeight != 0 ? shablonImageHeight : imageHeight != 0 ? imageHeight : 0 + 'px';
            if (shablonImageHeight != 0 && shablonImageHeight > imageHeight) {
                parent.style.height = shablonImageHeight + 'px';
            }
            else if (imageHeight != 0 && imageHeight > shablonImageHeight) {
                parent.style.height = imageHeight + 'px';
            }
            if (imageHeight > 0 && shablonImageHeight > 0) {
                this.bg_color = true;
            }
        },
        cropImage() {
            const result = this.$refs.cropper.getResult();
            this.cropped_ava = result.canvas.toDataURL("image/jpeg");
        },
        hideCropper() {
            this.isCropper = false;
        },
        openCropper() {
            this.isCropper = true;
        },
        inputText(event, index) {
            this.options[index].text = event.target.textContent;
        },
        assignColor(color, index) {
            this.options[this.text_index].color = color;
            this.color_index = index;
        },
        assignShrift(shrift_id) {
            let shrift = this.shrifts.find(shrift => shrift.id === shrift_id);
            this.options[this.text_index].shrift = shrift.name;
        },
        assignSize(size) {
            this.options[this.text_index].size = size <= this.options[this.text_index].maxSize ? size : this.options[this.text_index].size;
        },
        assignlineHeight(lineHeight) {
            this.options[this.text_index].line_height = lineHeight;
        },
        increaseFontSize() {
            if (this.options[this.text_index].size < this.options[this.text_index].maxSize) {
                this.options[this.text_index].size++;
            }
        },
        decreaseFontSize() {
            if (this.options[this.text_index].size > 20) {
                this.options[this.text_index].size--;
            }
        },
        increaseLineHeight() {
            this.options[this.text_index].line_height++;
        },
        decreaseLineHeight() {
            if (this.options[this.text_index].line_height > 10) {
                this.options[this.text_index].line_height--;
            }
        },
        takeIndex(index) {
            this.text_index = index;
            this.is_clear = false;
        },
        clearFocus() {
            this.is_clear = true;
        },
        chooseSlider(sliderIndx) {
            this.slider = sliderIndx;
        },
        changeAva(number) {
            if (number == 1) {
                this.avatar_sizes.margin_top += 10;
            }
            else if (number == 2) {
                this.avatar_sizes.margin_top -= 10;
            }
            else if (number == 3) {
                this.avatar_sizes.margin_left += 10;
            }
            else if (number == 4) {
                this.avatar_sizes.margin_left -= 10;
            }
            else if (number == 5) {
                this.avatar_sizes.width += 10;
            }
            else if (number == 6) {
                this.avatar_sizes.width -= 10;
            }
            else if (number == 7) {
                this.avatar_sizes.height += 10;
            }
            else if (number == 8) {
                this.avatar_sizes.height -= 10;
            }
            else if (number == 9) {
                this.avatar_sizes.z_index++;
            }
            else if (number == 10) {
                this.avatar_sizes.z_index--;
            }
            else if (number == 11) {
                this.avatar_sizes.border_radius += 50;
            }
            else if (number == 12) {
                this.avatar_sizes.border_radius -= 50;
            }
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

        handleFileChange(e, number) {
            if (number == 0) {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    this.preview_shablon = e.target.result;
                }
                this.shablon_image = e.target.files[0];
            }
            else if (number == 1) {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    this.preview_maket = e.target.result;
                }
                this.maket_image = e.target.files[0];
                this.options[0].margin_top = 100;
            }
            else {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    this.input_ava = e.target.result;
                }
                this.isCropper = true;
            }
        },
        addOption() {
            this.options.push({
                number: this.options.length + 1,
                text: 'test text ' + this.options.length,
                margin_top: 0,
                transform_x: 0,
                max_width: 70,
                shrift: this.shrifts[0].name,
                color: '#000000',
                size: 50,
                maxSize: 100,
                max_height: 2,
                line_height: 25,
                position: 'text-center',
                can_replace: true,
                is_bold: false,
                is_underline: false,
                is_italic: false,
            });
            this.text_index = this.options.length - 1;
        },
        removeOption(index) {
            this.options.splice(index, 1);
            this.text_index = 0;
        },
        addColor() {
            this.standartColors.push({
                name: this.temp_color,
            });
            this.temp_color = '#ffffff';
        },
        removeColor(index) {
            this.standartColors.splice(index, 1);
        },
        submit() {
            const texts = JSON.stringify(this.options);
            const avatar_sizes = JSON.stringify(this.avatar_sizes);
            const standartColors = JSON.stringify(this.standartColors);
            const standartShrifts = JSON.stringify(this.standartShrifts);
            const formData = new FormData();
            formData.append('shablon_image', this.shablon_image);
            formData.append('maket_image', this.maket_image);
            formData.append('type_id', this.selectedType);
            formData.append('title', this.title);
            formData.append('price', this.price);
            formData.append('texts', texts);
            formData.append('standartColors', standartColors);
            formData.append('standartShrifts', standartShrifts);
            formData.append('avatar_sizes', avatar_sizes);
            formData.append('with_avatar', this.with_avatar);
            formData.append('ava_image', this.cropped_ava);
            this.$inertia.post(
                route("admin.maket.store"), formData,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                }
            );
        },
    },
};
</script>
<style>
.max_w-input {
    max-width: 500px;
}

/* .limitter {
    padding: 0 250px;
} */

.example-cropper {
    border: solid 1px #eee;
    min-height: 300px;
    width: 100%;
    height: 50vh;
}

.makets {
    overflow-x: scroll
}

.maket_container {
    width: 804px;
    margin: 30px auto 30px;
    position: relative;
}

.shablon {
    width: 400px;
    position: relative;
}


.ava_block {
    position: absolute;
    top: 0;
}

.ava_imgg {
    width: 100%;
    height: 100%;
}

.maket_img {
    width: 100%;
    height: auto;
    position: absolute;
}

.texts {
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 2;
}

.background_maket {
    background: gray;
}

.multiselect {
    width: 95%;
}

[contenteditable="true"]:focus {
    outline: none;
}

.color_box {
    min-height: 34px;
    max-height: 50px;
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

.active_text {
    border: 1px solid #fdd835;
}

.clear_active {
    border: 1px solid transparent;
}

input[type="color"] {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    transition: 0.3s all ease;
}

input[type="color"]:hover,
input[type="color"]:focus {
    box-shadow: 0 0 5px #99f;
}

.ava_option_panel {
    max-width: fit-content;
    height: 51px;
    background: #efefef;
    overflow-x: scroll;
}

.option_panel {
    max-width: fit-content;
    height: 51px;
    background: #efefef;
    overflow-x: scroll;
}

.slider {
    max-width: 420px;
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
    min-width: 34px;
    align-items: center;
    justify-content: center;
    margin: 0 10px;
}

.panel_input {
    background: transparent;
    border: none;
    max-width: 50px;
    width: 41px;
    text-align: right;
    padding: 0;
    margin: 0;
}

.panel_input:focus {
    outline: none;
}

.margin_width {
    width: 50px;
}

.active_icon {
    background: #fdd835;
}

.c-p {
    cursor: pointer;
}

input.switch {
    -moz-appearance: none;
    -webkit-appearance: none;
    -o-appearance: none;
    appearance: none;
    height: 1em;
    width: 2em;
    border-radius: 1em;
    box-shadow: inset -1em 0px 0px 0px rgba(192, 192, 192, 1);
    background-color: white;
    border: 1px solid rgba(192, 192, 192, 1);
    outline: none;
    -webkit-transition: 0.2s;
    transition: 0.2s;
}

input.switch:checked {
    box-shadow: inset 1em 0px 0px 0px rgba(33, 150, 243, 0.5);
    border: 1px solid rgba(33, 150, 243, 1);
}

input.switch:focus {
    outline-width: 0;
}

/* @media screen and (max-width: 600px) {
    .maket_container {
        width: 560px;
        margin: 30px auto 30px;
        position: relative;
    }

    .shablon {
        width: 280px;
        position: relative;
    }
} */
</style>