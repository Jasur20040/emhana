<template>

    <head>
        <title>Админ панель | Шрифтты өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Шрифтты өзгерту</h1>
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
                            <a :href="route('admin.shrift.index')">
                                <i class="fas fa-dashboard"></i>
                                Шрифттар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Шрифтты өзгерту
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Стилінде берілген аты</label>
                            <input type="text" class="form-control" required v-model="shrift.name" name="name"
                                placeholder="Аты" />
                        </div>
                        <div class="form-group">
                            <label for="">Шрифт файлы</label>
                            <input type="file" class="form-control" @change="handleFileChange($event, 1)" required />
                        </div>
                        <div class="form-group">
                            <label for="">Шрифт стилі</label>
                            <input type="file" class="form-control" @change="handleFileChange($event, 2)" required />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сақтау
                        </button>
                        <button type="button" class="btn btn-danger" @click.prevent="back()">
                            Артқа
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
import ValidationError from "../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head
    },
    props: ["shrift"],
    methods: {
        handleFileChange(e, number) {
            if (number == 1) {
                this.shrift.shrift_file = e.target.files[0];
            }
            else {
                this.shrift.shrift_css = e.target.files[0];
            }
        },
        // submit() {
        //     const formData = new FormData();
        //     formData.append('name', this.shrift.name);
        //     formData.append('shrift_file', this.shrift.shrift_file);
        //     formData.append('shrift_css', this.shrift.shrift_css);
        //     formData.append('_method', 'PUT');
        //     this.$inertia.post(
        //         route("admin.shrift.update", this.shrift.id),
        //         formData,
        //         {
        //             onError: () => console.log("An error has occurred"),
        //             onSuccess: () =>
        //                 console.log("The new contact has been saved"),
        //         }
        //     );
        // },
        submit() {
            this.shrift['_method'] = 'put'
            this.$inertia.post(
                route("admin.shrift.update", this.shrift.id),
                this.shrift,
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