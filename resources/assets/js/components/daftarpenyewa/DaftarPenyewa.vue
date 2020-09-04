<template>
    <div class="user">
        <section class="users-list-wrapper">
            <div>
                <h2 class="head-text">Daftar Penyewa</h2>
            </div>
            <!-- Ag Grid users list section start -->
            <div id="basic-examples">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                                        <div class="mb-1 mb-sm-0">
                                            <input
                                                type="search"
                                                @keyup="searchit"
                                                v-model="search"
                                                class="ag-grid-filter form-control w-100 mr-1 mb-1 mb-sm-0"
                                                id="filter-text-box"
                                                placeholder="Search...."
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                        class="float-right ag-grid-btns d-flex justify-content-between flex-wrap mb-1"
                                    >
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>Jumlah Tenant</th>
                                        <th class="text-right">Cetak Daftar Penyewa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="lokasi in lokasi_tenant.data" :key="lokasi.id">
                                        <td>{{lokasi.lokasi}}</td>
                                        <td>{{lokasi.jumlah_tenant}}</td>
                                        <td class="text-right">
                                            <a target="_blank" :href="'/xl-lokasi-tenant/'+lokasi.id">
                                                <i class="feather icon-printer mr-50"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2 pl-1">
                                    <pagination :limit="5" :data="lokasi_tenant"
                                                @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ag Grid users list section end -->
        </section>
        <!-- users list ends -->
        <!-- <div v-if="!$gate.isAdminOrAuthor()">
          <not-found></not-found>
        </div>-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            search : '',
            lokasi_tenant : {}
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("api/lokasi-tenant?page=" + page).then((response) => {
                this.lokasi_tenant = response.data
                console.log(this.lokasi_tenant);
            });
        },
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000),
    },
    created() {
        Fire.$on("AfterCreate", () => {
            this.getResults();
        });
        this.getResults()
    },
};
</script>
