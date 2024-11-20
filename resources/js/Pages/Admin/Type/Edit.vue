<template>

    <head>
        <title>Админ панель | Типті өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Типті өзгерту</h1>
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
                            <a :href="route('admin.type.index')">
                                <i class="fas fa-dashboard"></i>
                                Типтер тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Типті өзгерту
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
                            <label for="">Аты</label>
                            <input type="text" class="form-control" required v-model="type.name" name="name"
                                placeholder="Үйлену той" />
                        </div>
                        <div class="form-group">
                            <label for="">Сипаттамасы</label>
                            <input type="text" class="form-control" required v-model="type.description"
                                placeholder="Үйлену тойға" />
                        </div>
                        <div class="form-group">
                            <label for="">Латынша</label>
                            <input type="text" class="form-control" required v-model="type.latin_name"
                                placeholder="uilenu_toi" />
                        </div>
                        <div class="form-group">
                            <label for="">Суреті</label>
                            <input type="file" class="form-control" @change="handleFileChange($event)" />
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
    props: ["type"],
    mounted() {
        this.type.image = null;
    },
    methods: {
        handleFileChange(e) {
            this.type.image = e.target.files[0];
        },
        submit() {
            const formData = new FormData();
            formData.append('name', this.type.name);
            formData.append('description', this.type.description);
            formData.append('latin_name', this.type.latin_name);
            formData.append('image', this.type.image);
            formData.append('_method', 'PUT');
            this.$inertia.post(
                route("admin.type.update", this.type.id),
                formData,
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