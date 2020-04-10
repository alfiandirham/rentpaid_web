<template>
  <div class="location">
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Tenant > {{tenants.data[0].lokasi}}</h2>
      </div>
      <div class="head-title">
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
                <h2>EDIT TENANT</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" class="clr-blue">Kode</label>
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            v-model="form.kode"
                            placeholder="Kode Tenant"
                            :class="{ 'is-invalid': form.errors.has('kode') }"
                          />
                          <has-error :form="form" field="kode"></has-error>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="fname"
                            v-model="form.luas"
                            @keyup="upluas"
                            placeholder="Luas tenant (m2)"
                            :class="{ 'is-invalid': form.errors.has('luas') }"
                          />
                          <has-error :form="form" field="luas"></has-error>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            disabled
                            v-model="form.permeter"
                            placeholder="Harga sewa per m2"
                          />
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            disabled
                            id="swb"
                            placeholder="Sewa bulanan"
                          />
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <input type="text" class="form-control" disabled placeholder="PPN 10%" />
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            disabled
                            id="tsw"
                            placeholder="Total sewa /Bln"
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <select
                            class="form-control"
                            v-model="form.kategori_id"
                            @change="setTarif()"
                            :class="{ 'is-invalid': form.errors.has('kategori') }"
                          >
                            <option value="pilih">Pilih Kategori</option>
                            <option
                              v-for="kategori in kategoris.data"
                              :value="kategori.id"
                              :key="kategori.id"
                            >{{kategori.kode}}</option>
                          </select>
                          <has-error :form="form" field="kategori"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            disabled
                            id="iuaran"
                            v-model="form.harga"
                            placeholder="Iuran Harian"
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.utara"
                            placeholder="Batas Utara"
                            :class="{ 'is-invalid': form.errors.has('utara') }"
                          />
                          <has-error :form="form" field="utara"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.timur"
                            placeholder="Batas Timur"
                            :class="{ 'is-invalid': form.errors.has('timur') }"
                          />
                          <has-error :form="form" field="timur"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.selatan"
                            placeholder="Batas Selatan"
                            :class="{ 'is-invalid': form.errors.has('selatan') }"
                          />
                          <has-error :form="form" field="selatan"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.barat"
                            placeholder="Batas Barat"
                            :class="{ 'is-invalid': form.errors.has('barat') }"
                          />
                          <has-error :form="form" field="barat"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <p>Status</p>
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  v-model="form.status"
                                  name="status"
                                  checked
                                  value="true"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Aktif</span>
                              </div>
                            </fieldset>
                          </li>
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  name="status"
                                  v-model="form.status"
                                  value="false"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Tidak Aktif</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                        <has-error :form="form" field="status"></has-error>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  @click="editmode ? updateData() : createData()"
                  class="btn btn-primary"
                >Accept</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Filters</h4>
          <a class="heading-elements-toggle">
            <i class="fa fa-ellipsis-v font-medium-3"></i>
          </a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li>
                <a data-action="collapse">
                  <i class="feather icon-chevron-down"></i>
                </a>
              </li>
              <li>
                <a data-action>
                  <i class="feather icon-rotate-cw users-data-filter"></i>
                </a>
              </li>
              <li>
                <a data-action="close">
                  <i class="feather icon-x"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="users-list-filter">
              <form>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="location-list-status">Status</label>
                    <fieldset class="form-group">
                      <select
                        @change="filtering(filter.status)"
                        v-model="filter.status"
                        class="form-control"
                      >
                        <option value="1">Tersedia</option>
                        <option value="0">Disewa</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- users filter end -->
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
                      <th>Kode Tenant</th>
                      <th>Luas(m2)</th>
                      <th>Bulanan + PPN</th>
                      <th>Iuran Harian</th>
                      <th>Status</th>
                      <th>Penyewa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="tenant in tenants.data" :key="tenant.id">
                      <th scope="row">
                        <input type="checkbox" :checked="cekall" />
                      </th>
                      <td>{{tenant.kode}}</td>
                      <td>{{tenant.luas}}</td>
                      <td>Rp. {{tenant.luas * tenant.permeter + tenant.luas * tenant.permeter * 0.1}}</td>
                      <td>Rp. {{tenant.harga}}</td>
                      <td v-if="tenant.disewa === 0">
                        <div class="badge badge-pill badge-light-success">Tersedia</div>
                      </td>
                      <td v-if="tenant.disewa === 1">
                        <div class="badge badge-pill badge-light-warning">Disewa</div>
                      </td>
                      <td>
                        <select
                          :id="`tenant${tenant.id}`"
                          @change="upData(tenant.id)"
                          class="form-control before"
                        >
                          <option :value="tenant.penyewa_id">{{tenant.penyewa}}</option>
                          <option
                            v-for="user in users.data"
                            :key="user.id"
                            :value="user.id"
                          >{{user.nama}}</option>
                        </select>
                      </td>
                      <td>
                        <a @click="editModal(tenant)">
                          <i class="users-edit-icon feather icon-edit-1 mr-50"></i>
                        </a>
                        <!-- <a @click="deleteData(tenant.id)">
                          <i class="users-delete-icon feather icon-trash-2"></i>
                        </a>-->
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination :limit="5" :data="tenants" @pagination-change-page="getResults"></pagination>
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
      sewa: "",
      cekall: false,
      search: "",
      kategoris: {},
      editmode: false,
      users: {},
      filter: {
        status: ""
      },
      tenants: {},
      form: new Form({
        id: "",
        kode: "",
        luas: 0,
        permeter: "",
        harga: "",
        utara: "",
        timur: "",
        selatan: "",
        barat: "",
        status: ""
      })
    };
  },
  methods: {
    setTarif() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get("/api/kategori/" + this.form.kategori_id)
          .then(({ data }) => (this.form.harga = data.data.tarif));
      }
    },
    filtering(q) {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get("/api/findTenan/" + this.$route.params.id + "?q=" + q)
          .then(data => {
            this.tenants = data;
          })
          .catch(() => {});
      }
    },
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateData() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("/api/tenan/" + this.form.id)
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
            .delete("/api/lokasi/" + id)
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
    upData(id) {
      let getVal = document.getElementById("tenant" + id);
      swal({
        title: "Anda Yakin?",
        text: "Pastikan Penyewa Benar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Okay!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form.disewa = 1;
          this.form.penyewa_id = getVal.value;
          this.form
            .put("/api/tenan/" + id)
            .then(() => {
              getVal.className = "form-control after";
              swal("Disewa!", "Tenant berhasil disewa.", "success");
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
      document.getElementById("swb").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter);
      document.getElementById("tsw").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) +
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) * 0.1;
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    getResults(page = 1) {
      axios
        .get("/api/lokasitenan/" + this.$route.params.id + "?page=" + page)
        .then(response => {
          this.tenants = response.data;
        });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("/api/penyewa").then(({ data }) => (this.users = data));
        axios.get("/api/kategori").then(({ data }) => (this.kategoris = data));
        axios
          .get("/api/lokasitenan/" + this.$route.params.id)
          .then(({ data }) => (this.tenants = data));
      }
    },
    createData() {
      this.$Progress.start();
      this.form
        .post("/api/lokasi")
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
    }, 1000),
    upluas: _.debounce(() => {
      Fire.$emit("upluas");
    }, 1000)
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get("/api/findTenan/" + this.$route.params.id + "?q=" + query)
        .then(data => {
          this.tenants = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    Fire.$on("upluas", () => {
      document.getElementById("swb").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter);
      document.getElementById("tsw").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) +
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) * 0.1;
    });
    this.loadData();
  }
};
</script>

<style scoped>
.before {
  background-color: #ecf3f7;
}

.after {
  background-color: #ffe2e2;
}
</style>