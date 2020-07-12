<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Penyewa > List Penyewa</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn btn-primary">
          <i class="fa fa-user-plus fa-lg pr-1"></i>
          Tambah Penyewa
        </button>
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
                <h2>{{editmode ? 'EDIT' : 'TAMBAH'}} PENYEWA</h2>
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
                              placeholder="Nama Lengkap"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('nama') }"
                            />
                            <span class="clr-blue">Nama Lengkap</span>
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
                              :class="{ 'is-invalid': form.errors.has('ktp') }"
                              v-model="form.ktp"
                              name="ktp"
                              placeholder="No. KTP"
                            />
                            <span class="clr-blue">No. KTP</span>
                          </label>
                          <has-error :form="form" field="ktp"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{ 'is-invalid': form.errors.has('hp') }"
                              v-model="form.hp"
                              name="contact"
                              placeholder="No. Telepon"
                            />
                            <span class="clr-blue">No. Telepon</span>
                          </label>
                          <has-error :form="form" field="hp"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              v-model="form.alamat"
                              type="text"
                              :class="{ 'is-invalid': form.errors.has('alamat') }"
                              class="form-control"
                              name="alamat"
                              placeholder="Alamat"
                            />
                            <span class="clr-blue">Alamat</span>
                          </label>
                          <has-error :form="form" field="alamat"></has-error>
                        </div>
                      </div>
                      <div class="col-12 pl-2">
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
                  @click="editmode ? updateUser() : createUser()"
                  class="btn btn-primary"
                >Ok</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
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
                    <label for="users-list-status">Status</label>
                    <fieldset class="form-group">
                      <select @change="e =>filtering(e.target.value)" class="form-control">
                        <option value="uvuvwu">All</option>
                        <option value="1">Active</option>
                        <option value="uvuvwe">Deactivated</option>
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
                              <button
                                @click="nonAll('Disable data','penyewa')"
                                class="dropdown-item"
                              >
                                <i class="feather icon-trash-2"></i>
                                Non Active
                              </button>
                              <button
                                @click="nonAll('Active data', 'penyewa2')"
                                class="dropdown-item"
                              >
                                <i class="feather icon-activity"></i>
                                Active
                              </button>
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
                        <input type="checkbox" id="select-all" />
                      </th>
                      <th>Nama</th>
                      <th>Ktp</th>
                      <th>No Hp</th>
                      <th>Alamat</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <th scope="row">
                        <input type="checkbox" :value="user.id" />
                      </th>
                      <td>{{user.nama}}</td>
                      <td>{{user.ktp}}</td>
                      <td>{{user.hp}}</td>
                      <td>{{user.alamat}}</td>
                      <td v-if="user.status === 1">
                        <div class="badge badge-pill badge-light-success">Active</div>
                      </td>
                      <td v-if="user.status === 0">
                        <div class="badge badge-pill badge-light-warning">Non Active</div>
                      </td>
                      <td>
                        <a @click="editModal(user)">
                          <i class="users-edit-icon feather icon-edit-1 mr-50"></i>
                        </a>
                        <a @click="deleteUser(user.id)">
                          <i class="users-delete-icon feather icon-trash-2"></i>
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
      filter: {
        status: ""
      },
      form: new Form({
        id: "",
        nama: "",
        alamat: "",
        hp: "",
        status: "",
        ktp: ""
      })
    };
  },
  methods: {
    filtering(q) {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get("api/findPenyewa?q=" + q)
          .then(data => {
            this.users = data.data;
          })
          .catch(() => {});
      }
    },
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/penyewa/" + this.form.id)
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
            .delete("api/penyewa/" + id)
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
      axios.get("api/penyewa?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/penyewa").then(({ data }) => (this.users = data));
      }
    },
    nonAll(text, api) {
      swal({
        title: "Are you sure?",
        text: text + " !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then(result => {
        this.$Progress.start();
        // Send request to the server
        if (result.value) {
          // Iterate each checkbox
          $(":checkbox").each(function() {
            if (this.checked) {
              if (this.value == "on") return true;
              axios
                .delete("api/" + api + "/" + this.value)
                .then(data => {
                  toast({
                    type: "success",
                    title: text + " in successfully"
                  });
                })
                .catch(() => {});
            }
          });
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        }
      });
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/penyewa")
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
        .get("api/findPenyewa?q=" + query)
        .then(data => {
          this.users = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
  },
  mounted() {
    $("#select-all").click(function(event) {
      if (this.checked) {
        // Iterate each checkbox
        $(":checkbox").each(function() {
          this.checked = true;
        });
      } else {
        $(":checkbox").each(function() {
          this.checked = false;
        });
      }
    });
  }
};
</script>
