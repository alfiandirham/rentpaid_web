<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Setoran > List Setoran</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn btn-primary">Tambah Setoran</button>
        <!-- Modal -->
        <div
          class="modal fade"
          id="addNew"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div
            class="modal-dialog float-right modal-dialog-scrollable modal-nav-dialog"
            role="document"
          >
            <div class="modal-nav">
              <div class="modal-header modal-nav-header">
                <h2>{{editmode ? 'EDIT' : 'TAMBAH'}} Setoran</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="date"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('tanggal') }"
                            v-model="form.tanggal"
                            name="tanggal"
                            placeholder="Tanggal"
                          />
                          <has-error :form="form" field="tanggal"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('collector_id') }"
                            v-model="form.collector_id"
                            name="collector_id"
                            placeholder="Kolektor ID"
                          />
                          <has-error :form="form" field="collector_id"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('jumlah') }"
                            v-model="form.jumlah"
                            name="jumlah"
                            placeholder="Jumlah Setoran"
                          />
                          <has-error :form="form" field="jumlah"></has-error>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  @click="editmode ? updateUser() : createUser()"
                  class="btn btn-primary"
                >Ok</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card">
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
                      <th>Tanggal</th>
                      <th>Collector</th>
                      <th>Lokasi</th>
                      <th>Jumlah Setoran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="setor in setorans.data" :key="setor.id">
                      <td>{{setor.tanggal}}</td>
                      <td>{{setor.collector}}</td>
                      <td>{{setor.lokasi}}</td>
                      <td>Rp. {{setor.jumlah}}</td>
                      <td>
                        <a @click="editModal(setor)">
                          <i class="feather icon-edit-1 mr-50"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination :limit="5" :data="setorans" @pagination-change-page="getResults"></pagination>
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
      cekall: false,
      search: "",
      editmode: false,
      setorans: {},
      form: new Form({
        id: "",
        collector_id: "",
        jumlah: "",
        tanggal: ""
      })
    };
  },
  methods: {
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/setoran/" + this.form.id)
        .then(() => {
          // success
          $("#addNew").modal("hide");
          swal("Updated!", "Information has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteUser(id) {
      swal({
        title: "Are you sure?",
        text: "Disable this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/setoran/" + id)
            .then(() => {
              swal("Disabled!", "Your data has been disabled.", "success");
              Fire.$emit("AfterCreate");
            })
            .catch(() => {
              swal("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    getResults(page = 1) {
      axios.get("api/setoran?page=" + page).then(response => {
        this.setorans = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/setoran").then(({ data }) => (this.setorans = data));
      }
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/setoran")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Berhasil Menambah Setoran."
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    searchit: _.debounce(() => {
      Fire.$emit("searching");
    }, 1000)
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get("api/findSetoran?q=" + query)
        .then(data => {
          this.setorans = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
  }
};
</script>
