<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Tenant > Kategori</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn btn-primary">Tambah Kategori</button>
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
                <h2>{{editmode ? 'EDIT' : 'TAMBAH'}} KATEGORI</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            name="fname"
                            v-model="form.nama"
                            placeholder="Nama Kategori"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('nama') }"
                          />
                          <has-error :form="form" field="nama"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('kode') }"
                            v-model="form.kode"
                            name="kode"
                            placeholder="Kode Kategori"
                          />
                          <has-error :form="form" field="kode"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="tarif_id">Pilih Tarif</label>
                          <select
                            name="tarif_id"
                            class="form-control"
                            v-model="form.tarif_id"
                            placeholder="Pilih Tarif"
                            :class="{ 'is-invalid': form.errors.has('tarif_id') }"
                          >
                            <option
                              v-for="tarif in tarifs.data"
                              :value="tarif.id"
                              :key="tarif.id"
                            >{{tarif.nama}} - Rp. {{tarif.sampah + tarif.barang + tarif.listrik + tarif.air + tarif.bop}}</option>
                          </select>
                        </div>
                      </div>
                      <has-error :form="form" field="tarif"></has-error>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  @click="editmode ? updateUser() : createUser()"
                  class="btn btn-primary"
                >Accept</button>
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
                    <div class="ag-btns d-flex flex-wrap">
                      <div class="action-btns">
                        <div class="btn-dropdown">
                          <div class="btn-group dropdown actions-dropodown">
                            <button
                              type="button"
                              class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >Actions</button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">
                                <i class="feather icon-trash-2"></i>
                                Delete
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="feather icon-clipboard"></i>
                                Archive
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="feather icon-printer"></i>
                                Print
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="feather icon-download"></i>
                                CSV
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>
                        <input type="checkbox" @click="checkall" v-model="cekall" />
                      </th>
                      <th>Nama Kategori</th>
                      <th>Kode</th>
                      <th>Tarif Sewa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="kategori in kategoris.data" :key="kategori.id">
                      <th scope="row">
                        <input type="checkbox" :checked="cekall" />
                      </th>
                      <td>{{kategori.nama}}</td>
                      <td>{{kategori.kode}}</td>
                      <td>Rp. {{kategori.tarif}}</td>
                      <td>
                        <a @click="editModal(kategori)">
                          <i class="feather icon-edit-1 mr-50"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination :limit="5" :data="kategoris" @pagination-change-page="getResults"></pagination>
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
      tarifs: {},
      kategoris: {},
      form: new Form({
        id: "",
        nama: "",
        kode: "",
        tarif_id: ""
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
        .put("api/kategori/" + this.form.id)
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
            .delete("api/kategori/" + id)
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
      axios.get("api/kategori?page=" + page).then(response => {
        this.kategoris = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/kategori").then(({ data }) => (this.kategoris = data));
        axios.get("api/tarif").then(({ data }) => (this.tarifs = data));
      }
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/kategori")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "User Created in successfully"
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
        .get("api/findKategori?q=" + query)
        .then(data => {
          this.kategoris = data.data;
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
