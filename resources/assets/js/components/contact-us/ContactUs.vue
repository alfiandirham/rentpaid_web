<template>
    <div class="user">
        <section class="users-list-wrapper">
            <div>
                <h2 class="head-text">Contact Us</h2>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Perusahaan</th>
                                        <th>Pesan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="contact in data_contact.data" :key="contact.id">
                                        <td>{{contact.name}}</td>
                                        <td>{{contact.email}}</td>
                                        <td>{{contact.perusahaan}}</td>
                                        <td>{{contact.pesan}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2 pl-1">
                                    <pagination :limit="5" :data="data_contact"
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
            data_contact : {}
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("api/contact-us?page=" + page).then((response) => {
                this.data_contact = response.data
            });
        },
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000),
    },
    created() {
        Fire.$on("searching", () => {
            let query = this.search;
            axios
                .get("api/contact-us?q=" + query)
                .then((response) => {
                    this.data_contact = response.data;
                })
                .catch(() => {});
        });
        Fire.$on("AfterCreate", () => {
            this.getResults();
        });
        this.getResults()
    },
};
</script>
