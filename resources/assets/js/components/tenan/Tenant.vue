<template>
  <div class="location">
    <section class="data-list-view-header">
      <div>
        <h2 class="head-text">Tenant > List Tenant</h2>
      </div>
      <div class="row">
        <div class="col-1">
          <div class="action-btns">
            <div class="btn-dropdown mr-1 mb-1">
              <div class="btn-group dropdown actions-dropodown">
                <button
                  type="button"
                  class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >Actions</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">
                    <i class="feather icon-trash"></i>Delete
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="feather icon-archive"></i>Archive
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="feather icon-file"></i>Print
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="feather icon-save"></i>Another Action
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-9">
          <button
            type="button"
            @click="newModal"
            class="btn waves-effect waves-light btn-primary px-1 py-1"
          >
            <i class="feather icon-box"></i> Tambah Tenant
          </button>
        </div>
        <div class="col-2">
          <input
            id="searchStyle"
            @keyup="searchit"
            v-model="search"
            type="search"
            placeholder="Search...."
            class="form-control form-control"
          />
        </div>
      </div>
      <div class="table-responsive">
        <table class="table data-list-view dataTable">
          <thead>
            <tr>
              <th class="pl-1">
                <input type="checkbox" @click="checkall" v-model="cekall" />
              </th>
              <th>Nama Lokasi</th>
              <th>Jumlah Tenant</th>
              <th>Sudah Disewakan</th>
              <th>Jumlah Tersedia</th>
              <th>Owner</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tenant in tenants.data" :key="tenant.id">
              <th scope="row">
                <input type="checkbox" :checked="cekall" />
              </th>
              <td>
                <router-link v-if="tenant.jumlah != 0" :to="`tenant/${tenant.id}`">{{tenant.lokasi}}</router-link>
                <p v-if="tenant.jumlah == 0">{{tenant.lokasi}}</p>
              </td>
              <td>{{tenant.jumlah}}</td>
              <td>{{tenant.disewa}}</td>
              <td>{{tenant.tersedia}}</td>
              <td>{{tenant.owner}}</td>
              <td>
                <a @click="editModal(tenant)">
                  <i class="users-edit-icon feather icon-edit-1 mr-50"></i>
                </a>
                <a @click="deleteData(tenant.id)">
                  <i class="users-delete-icon feather icon-trash-2"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="mt-2 pl-1">
          <pagination :limit="5" :data="tenants" @pagination-change-page="getResults"></pagination>
        </div>
      </div>
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
              <h2>TAMBAH TENANT</h2>
              <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
            </div>
            <form
              @submit.prevent="editmode ? updateData() : createData()"
              class="form mt-1 form-vertical"
            >
              <div class="modal-body modal-nav-body">
                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="owner">Pilih Lokasi</label>
                        <select
                          name="owner"
                          class="form-control"
                          v-model="form.lokasi_id"
                          placeholder="Pilih Lokasi"
                          :class="{ 'is-invalid': form.errors.has('lokasi_id') }"
                        >
                          <option
                            v-for="lokasi in locations.data"
                            :value="lokasi.id"
                            :key="lokasi.id"
                          >{{lokasi.lokasi}}</option>
                        </select>
                        <has-error :form="form" field="lokasi_id"></has-error>
                      </div>
                      <hr />
                    </div>
                    <div class="row" style="padding-left:13px; align-items: baseline;">
                      <div class="col-4">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.kategori"
                            placeholder="Kategori Tenant"
                            :class="{ 'is-invalid': form.errors.has('kategori') }"
                          />
                          <has-error :form="form" field="kategori"></has-error>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            v-model="form.jumlah"
                            placeholder="Jumlah Tenant"
                            :class="{ 'is-invalid': form.errors.has('jumlah') }"
                          />
                          <has-error :form="form" field="jumlah"></has-error>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.harga"
                            placeholder="Harga Sewa"
                            :class="{ 'is-invalid': form.errors.has('harga') }"
                          />
                          <has-error :form="form" field="harga"></has-error>
                        </div>
                      </div>
                      <div class="col-1">
                        <a>
                          <i class="fa danger fa-trash"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Accept</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cekall: false,
      search: "",
      editmode: false,
      tenants: {},
      locations: {},
      form: new Form({
        id: "",
        kategori: "",
        harga: "",
        jumlah: "",
        lokasi_id: ""
      })
    };
  },
  methods: {
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateData() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/tenan/" + this.form.id)
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
    deleteData(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/tenan/" + id)
            .then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
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
      axios.get("api/lokasitenan?page=" + page).then(response => {
        this.tenants = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/lokasitenan").then(({ data }) => (this.tenants = data));
        axios.get("api/lokasi").then(({ data }) => (this.locations = data));
      }
    },
    createData() {
      this.$Progress.start();
      this.form
        .post("api/tenan")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Data Created in successfully"
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
        .get("api/findLocationTenant?q=" + query)
        .then(data => {
          this.tenants = data.data;
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

<style scoped>
button.btn.btn-white.px-1.py-1.dropdown-toggle.waves-effect.waves-light {
  box-shadow: 0 0px 6px 1px rgb(179, 183, 185);
}
#searchStyle {
  padding: 1.45rem !important;
  border-radius: 1.428rem;
  border: 1px solid #dae1e7;
}
table.data-list-view.dataTable thead th,
table.data-thumb-view.dataTable thead th {
  padding: 0.714rem 1.785rem;
  font-weight: 600;
}
</style>