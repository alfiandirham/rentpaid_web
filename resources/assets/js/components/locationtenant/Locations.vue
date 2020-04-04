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
              <form
                @submit.prevent="editmode ? updateData() : createData()"
                class="form mt-1 form-vertical"
              >
                <div class="modal-header modal-nav-header">
                  <h2>TAMBAH LOKASI</h2>
                  <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
                </div>
                <div class="modal-body modal-nav-body">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" class="clr-blue">Nama Lokasi</label>
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            v-model="form.lokasi"
                            placeholder="Nama Lokasi"
                            :class="{ 'is-invalid': form.errors.has('lokasi') }"
                          />
                          <has-error :form="form" field="lokasi"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="fname"
                            v-model="form.lat"
                            placeholder="Latitude"
                            :class="{ 'is-invalid': form.errors.has('lat') }"
                          />
                          <has-error :form="form" field="lat"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="fname"
                            v-model="form.long"
                            placeholder="Longitude"
                            :class="{ 'is-invalid': form.errors.has('long') }"
                          />
                          <has-error :form="form" field="long"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.provinsi"
                            placeholder="Provinsi"
                            :class="{ 'is-invalid': form.errors.has('provinsi') }"
                          />
                          <has-error :form="form" field="provinsi"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.kab"
                            placeholder="Kabupaten/Kota"
                            :class="{ 'is-invalid': form.errors.has('kab') }"
                          />
                          <has-error :form="form" field="kab"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.kec"
                            placeholder="Kecematan"
                            :class="{ 'is-invalid': form.errors.has('kec') }"
                          />
                          <has-error :form="form" field="kec"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.kel"
                            placeholder="Desa/Kelurahan"
                            :class="{ 'is-invalid': form.errors.has('kel') }"
                          />
                          <has-error :form="form" field="kel"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="owner">Pilih Owner</label>
                          <select
                            name="owner"
                            class="form-control"
                            v-model="form.user_id"
                            placeholder="Pilih Owner"
                            :class="{ 'is-invalid': form.errors.has('user_id') }"
                          >
                            <option
                              v-for="user in users.data"
                              :value="user.id"
                              :key="user.id"
                            >{{user.id}}</option>
                          </select>
                          <has-error :form="form" field="user_id"></has-error>
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
                      <th>Kategori Tenant</th>
                      <th>Nomor Tenant</th>
                      <th>Harga Sewa</th>
                      <th>Status</th>
                      <th>Penyewa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="tenant in tenants.data" :key="tenant.id">
                      <th scope="row">
                        <input type="checkbox" :checked="cekall" />
                      </th>
                      <td>{{tenant.kategori}}</td>
                      <td>{{tenant.nomor}}</td>
                      <td>Rp. {{tenant.harga}}</td>
                      <td v-if="tenant.status === 1">
                        <div class="badge badge-pill badge-light-success">Tersedia</div>
                      </td>
                      <td v-if="tenant.status === 0">
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
                      <!-- <td>
                        <a @click="editModal(tenant)">
                          <i class="users-edit-icon feather icon-edit-1 mr-50"></i>
                        </a>
                        <a @click="deleteData(tenant.id)">
                          <i class="users-delete-icon feather icon-trash-2"></i>
                        </a>
                      </td>-->
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
      editmode: false,
      users: {},
      filter: {
        status: ""
      },
      tenants: {},
      form: new Form({
        id: "",
        penyewa_id: "",
        status: ""
      })
    };
  },
  methods: {
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
        .put("/api/lokasi/" + this.form.id)
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
          this.form.status = 0;
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