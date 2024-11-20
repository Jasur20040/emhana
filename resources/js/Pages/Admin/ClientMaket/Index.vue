<template>

    <head>
        <title>Админ панель | Жасалған шақырулар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жасалған шақырулар</h1>
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
                            Жасалған шақырулар
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons d-flex align-items-center">
                <Link class="btn btn-danger mr-3" :href="route('admin.clientMaket.index')">
                <i class="fa fa-trash"></i> Фильтрді тазалау
                </Link>
                <!-- <button @click.prevent="destroy()" class="btn btn-danger" title="Жою">
                    Жою
                    <i class="ml-1 fas fa-solid fa-trash"></i>
                </button> -->
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
                                        <th>ID</th>
                                        <th>Суреті</th>
                                        <th>Датасы</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td :style="'width: 150px;'">
                                            <input v-model="filter.id" class="form-control" placeholder="ID"
                                                @keyup.enter="search" />
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(clientMaket, index) in clientMaket.data"
                                        :key="'clientMaket' + clientMaket.id">
                                        <td>
                                            {{ clientMaket.id }}
                                        </td>
                                        <td><img :src="'/storage/' + clientMaket.client_maket" class="img-fluid"
                                                :style="['max-width: 300px']"></td>
                                        <td>{{ clientMaket.upload_date }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button @click.prevent="deleteData(clientMaket.id)"
                                                    class="btn btn-danger" title="Жою">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <button
                                                    @click.prevent="download(clientMaket.client_maket, clientMaket.id)"
                                                    class="btn btn-success" title="Жүктеу">
                                                    <i class="fas fa-solid fa-download"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <Pagination :links="clientMaket.links" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
import axios from 'axios';
export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head
    },
    props: ["clientMaket"],
    data() {
        return {
            loading: 0,
            filter: {
                id: route().params.id ? route().params.id : null,
            },
        };
    },
    methods: {
        destroy() {
            this.$inertia.get('/destroy/clientsImages')
        },
        download(filename, id) {
            axios.get(`/admin/download?url=/storage/${filename}`, {
                responseType: 'blob',
            }).then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', id + '.png');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }).catch(error => {
                console.error('An error occurred:', error);
            });
        },
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
                    this.$inertia.delete(route('admin.clientMaket.destroy', id))
                }
            });
        },
        search() {
            this.loading = 1
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.clientMaket.index'), params)
        },
    }
};
</script>