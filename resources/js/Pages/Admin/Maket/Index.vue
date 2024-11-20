<template>
    <head>
        <title>Админ панель | Макеттер</title>
        <link v-for="(shrift, index) in shrifts" :key="index" :href="'/storage/' + shrift.shrift_css" rel="stylesheet">
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Макеттер тізімі</h1>
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
                            Макеттер тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons d-flex align-items-center">
                <Link class="btn btn-primary mr-2" :href="route('admin.maket.create')">
                <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.maket.index')">
                <i class="fa fa-trash"></i> Фильтрді тазалау
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
                                        <th>Бағасы</th>
                                        <th>Типі</th>
                                        <th>Шрифттар</th>
                                        <th>Сурет қою</th>
                                        <th>Түстер</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input v-model="filter.title" class="form-control" placeholder="Іздеу..."
                                                @keyup.enter="search" />
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="form-control" @change.prevent="search"
                                                v-model="filter.type_id">
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option v-for="typee in types" :key="typee.id" :value="typee.id">
                                                    {{ typee?.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="form-control" @change.prevent="search"
                                                v-model="filter.with_avatar">
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option :value="1">
                                                    Жоқ
                                                </option>
                                                <option :value="2">
                                                    Бар
                                                </option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(maket, index) in maket.data" :key="'maket' + maket.id">
                                        <td>
                                            {{
                                                maket.from
                                                ? maket.from + index
                                                : index + 1
                                            }}
                                        </td>
                                        <td :style="['max-width: 100px']"><img :src="'/storage/' + maket.shablon_image" class="img-fluid"></td>
                                        <td>{{ maket.title }}</td>
                                        <td>{{ maket.price }} ₸</td>
                                        <td>{{ maket.type?.name }}</td>
                                        <td>
                                          <div class="shrift_box" v-for="shrift in maket.shrifts" :key="shrift" :style="['font-family: ' + shrift?.name]">{{ shrift?.name }}</div>
                                        </td>
                                        <td v-if="maket.with_avatar">Бар</td>
                                        <td v-else>Жоқ</td>
                                        <td>
                                          <div class="color_box" v-for="color in JSON.parse(maket.colors)" :key="color" :style="['background-color: ' + color?.name]"></div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link :href="route(
                                                    'admin.maket.edit',
                                                    maket)
                                                    " class="btn btn-primary" title="Изменить">
                                                <i class="fas fa-edit"></i>
                                                </Link>

                                                <button @click.prevent="deleteData(maket.id)" class="btn btn-danger"
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
                    <Pagination :links="maket.links" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head
    },
    props: [
      'maket',
      'types',
      'shrifts',
    ],
    data() {
        return {
            filter: {
                title: route().params.title ? route().params.title : null,
                type_id: route().params.type_id ? route().params.type_id : null,
                with_avatar: route().params.with_avatar ? route().params.with_avatar : null,
            },
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
                    this.$inertia.delete(route('admin.maket.destroy', id))
                }
            });
        },
        search() {
            this.loading = 1
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.maket.index'), params)
        },
    }
};
</script>
<style>
.color_box {
  width: 80px;
  height: 20px;
  border: 1px solid #fff;
}
</style>