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
                          <label class="has-float-label">
                            <input
                              type="text"
                              name="fname"
                              v-model="form.nama"
                              placeholder="Nama Kategori"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('nama') }"
                            />
                            <span class="clr-blue">Nama Kategori</span>
                          </label>
                          <has-error :form="form" field="nama"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('kode') }"
                              v-model="form.kode"
                              minlength="3"
                              maxlength="3"
                              name="kode"
                              placeholder="Kode Kategori"
                            />
                            <span class="clr-blue">Kode Kategori</span>
                          </label>
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
                            @change="setTarif()"
                            placeholder="Pilih Tarif"
                            :class="{ 'is-invalid': form.errors.has('tarif_id') }"
                          >
                            <option v-for="tarif in tarifs.data" :value="tarif.id" :key="tarif.id">
                              {{tarif.nama}} - Rp. {{tarif.sampah + tarif.barang + tarif.listrik
                              + tarif.air + tarif.bop + (tarif.bop * 0.1) + tarif.permeter}}
                            </option>
                          </select>
                          <has-error :form="form" field="tarif_id"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Harga per m2</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.permeter || 0}}</h6>
                          </div>
                        </div>
                        <div class="col-6">
                          <hr />
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">BOP</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.bop || 0}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">PPN BOP</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{(tarif.bop || 0) * 0.1}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Air</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.air || 0}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Listrik</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.listrik || 0}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Barang Masuk</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.barang || 0}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Sampah</p>
                          </div>
                          <div class="col-6">
                            <h6>Rp. {{tarif.sampah || 0}}</h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-5">
                            <p class="lead">Total Iuran Harian</p>
                          </div>
                          <div class="col-6">
                            <h6>
                              Rp. {{(tarif.sampah + tarif.barang + tarif.listrik
                              + tarif.air + tarif.bop + (tarif.bop * 0.1) + tarif.permeter) || 0}}
                            </h6>
                          </div>
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
                      <th>Nama Kategori</th>
                      <th>Kode</th>
                      <th>Tarif Sewa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="kategori in kategoris.data" :key="kategori.id">
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
      tarif: {},
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
    setTarif() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get("api/tarif/" + this.form.tarif_id)
          .then(({ data }) => (this.tarif = data));
      }
    },
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
