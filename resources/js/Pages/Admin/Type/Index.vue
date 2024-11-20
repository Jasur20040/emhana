<template>

    <head>
        <title>Админ панель | Типтер</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Типтер тізімі</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Типтер тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons d-flex align-items-center">
                <Link class="btn btn-primary mr-2" :href="route('admin.type.create')">
                <i class="fa fa-plus"></i> Қосу
                </Link>
                <div v-if="loading" class="spinner-border text-primary mx-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th>№</th>
                                        <th>Суреті</th>
                                        <th>Аты</th>
                                        <th>Сипаттамасы</th>
                                        <th>Латынша</th>
                                        <th>Әрекет</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(type, index) in type.data" :key="'type' + type.id">
                                        <td>
                                            {{ type.from ? type.from + index : index + 1 }}
                                        </td>
                                        <td><img :src="'/storage/' + type.image" class="img-fluid" :style="['max-width: 120px']"></td>
                                        <td>{{ type.name }}</td>
                                        <td>{{ type.description }}</td>
                                        <td>{{ type.latin_name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link :href="route('admin.type.edit', type)" class="btn btn-primary"
                                                    title="Изменить">
                                                <i class="fas fa-edit"></i>
                                                </Link>
                                                <button @click.prevent="deleteData(type.id)" class="btn btn-danger"
                                                    title="Жою">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <Pagination :links="type.links" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head
    },
    props: ["type"],
    data() {
        return {
            loading: 0,
        };
    },
    methods: {
        deleteData(id) {
            Swal.fire({
                title: "Жоюға сенімдісіз бе?",
                text: "Қайтып қалпына келмеуі мүмкін!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Иә, жоямын!",
                cancelButtonText: "Жоқ",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route('admin.type.destroy', id))
                }
            });
        },
    }
};
</script>