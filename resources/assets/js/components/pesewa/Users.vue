<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div class="fixed">
        <h2 class="head-text">Daftar Penyewa</h2>
      </div>
      <!-- users filter end -->
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card" :class="this.$gate.isAuthor() ? '': 'mt-5'">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
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
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Lokasi</th>
                      <th>Jumlah Tenant</th>
                      <th>Cetak Daftar Penyewa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.lokasi}}</td>
                      <td>{{user.jumlah}}</td>
                      <td>
                        <a
                          :href="'/wilayah/'+user.id"
                          onclick="window.open(this.href).print()"
                          target="_blank"
                        >
                          <svg
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M5 8V1H17V8M5 17H3C2.46957 17 1.96086 16.7893 1.58579 16.4142C1.21071 16.0391 1 15.5304 1 15V10C1 9.46957 1.21071 8.96086 1.58579 8.58579C1.96086 8.21071 2.46957 8 3 8H19C19.5304 8 20.0391 8.21071 20.4142 8.58579C20.7893 8.96086 21 9.46957 21 10V15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H17M5 13H17V21H5V13Z"
                              stroke="#828282"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination :limit="5" :data="users" @pagination-change-page="getResults"></pagination>
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
      search: "",
      editmode: false,
      users: {},
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get("api/lokasitenan?page=" + page).then((response) => {
        this.users = response.data;
      });
    },
    loadData() {
      axios.get("api/lokasitenan").then(({ data }) => (this.users = data));
    },
    searchit: _.debounce(() => {
      Fire.$emit("searching");
    }, 1000),
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get("api/findPenyewa?q=" + query)
        .then((data) => {
          this.users = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
  },
};
</script>
