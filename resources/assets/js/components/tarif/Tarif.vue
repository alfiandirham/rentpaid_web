<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <div class="fixed">
        <h2 class="head-text">Tenant > Tarif</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn btn-primary fixed-2">Tambah Tarif</button>
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
                <h2>{{editmode ? 'EDIT' : 'TAMBAH'}} TARIF</h2>
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
                              placeholder="Nama Tarif"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('nama') }"
                            />
                            <span class="clr-blue">Nama Tarif</span>
                          </label>
                          <has-error :form="form" field="nama"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('permeter') }"
                              v-model="form.permeter"
                              name="permeter"
                              placeholder="Harga sewa per m2"
                            />
                            <span class="clr-blue">Harga Sewa per m2</span>
                          </label>
                          <has-error :form="form" field="permeter"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('bop') }"
                              v-model="form.bop"
                              name="bop"
                              placeholder="Jumlah Tarif BOP"
                            />
                            <span class="clr-blue">Tarif BOP</span>
                          </label>
                          <has-error :form="form" field="bop"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input type="number" class="form-control" disabled placeholder="PPN 10%" />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('air') }"
                              v-model="form.air"
                              name="air"
                              placeholder="Jumlah Tarif Air"
                            />
                            <span class="clr-blue">Tarif Air</span>
                          </label>
                          <has-error :form="form" field="air"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('listrik') }"
                              v-model="form.listrik"
                              placeholder="Jumlah Tarif Listrik"
                            />
                            <span class="clr-blue">Tarif Listrik</span>
                          </label>
                          <has-error :form="form" field="listrik"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('barang') }"
                              v-model="form.barang"
                              placeholder="Jumlah Tarif Barang Masuk"
                            />
                            <span class="clr-blue">Tarif Masuk</span>
                          </label>
                          <has-error :form="form" field="barang"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('sampah') }"
                              v-model="form.sampah"
                              placeholder="Jumlah Tarif Sampah"
                            />
                            <span class="clr-blue">Tarif Sampah</span>
                          </label>
                          <has-error :form="form" field="sampah"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <label>Total Tarif</label>
                        <p class="lead" style="padding-left:0.2em; padding-top:1em;">
                          Rp. {{(parseFloat(form.permeter || 0) + parseFloat(form.bop || 0)
                          + parseFloat((form.bop || 0) * 0.1) + parseFloat(form.air || 0)
                          + parseFloat(form.listrik || 0) + parseFloat(form.barang || 0) + parseFloat(form.sampah || 0))}}
                        </p>
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
        <div class="card mt-7">
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
                      <th>Nama Tarif</th>
                      <th>BOP</th>
                      <th>Permeter</th>
                      <th>Air</th>
                      <th>Listrik</th>
                      <th>Brg Masuk</th>
                      <th>Sampah</th>
                      <th>Total Sewa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="tarif in tarifs.data" :key="tarif.id">
                      <td>{{tarif.nama}}</td>
                      <td>Rp. {{tarif.bop}}</td>
                      <td>Rp. {{tarif.permeter}}</td>
                      <td>Rp. {{tarif.air}}</td>
                      <td>Rp. {{tarif.listrik}}</td>
                      <td>Rp. {{tarif.barang}}</td>
                      <td>Rp. {{tarif.sampah}}</td>
                      <td>
                        Rp. {{tarif.sampah + tarif.barang + tarif.listrik + tarif.air
                        + tarif.bop + tarif.permeter}}
                      </td>
                      <td>
                        <a @click="editModal(tarif)">
                          <i class="feather icon-edit-1 mr-50"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination :limit="5" :data="tarifs" @pagination-change-page="getResults"></pagination>
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
      form: new Form({
        id: "",
        nama: "",
        air: "",
        bop: "",
        permeter: "",
        listrik: "",
        barang: "",
        sampah: "",
      }),
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
        .put("api/tarif/" + this.form.id)
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
        confirmButtonText: "Yes",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/tarif/" + id)
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
      axios.get("api/tarif?page=" + page).then((response) => {
        this.tarifs = response.data;
      });
    },
    loadData() {
      axios.get("api/tarif").then(({ data }) => (this.tarifs = data));
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/tarif")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Berhasil menambah Tarif.",
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
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
        .get("api/findTarif?q=" + query)
        .then((data) => {
          this.tarifs = data.data;
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
