<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Users > List User</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn btn-primary">
          <i class="fa fa-user-plus fa-lg pr-1"></i>
          Tambah User
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
                <h2>TAMBAH USER</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <form
                @submit.prevent="editmode ? updateUser() : createUser()"
                class="form mt-1 form-vertical"
              >
                <div class="modal-body modal-nav-body">
                  <div class="row align-items-end" style="margin-left:0px;">
                    <div class="col-4">
                      <form
                        action="#"
                        class="dropzone dropzone-area row flex-column justify-content-between align-items-center"
                        id="dpz-btn-select-files"
                      >
                        <div class="dz-message">Upload file</div>
                        <i class="fa fa-cloud-upload"></i>
                      </form>
                    </div>
                    <div class="col-8">
                      <button id="select-files" class="btn btn-primary mb-1">
                        <i class="icon-file2"></i> Ganti Foto
                      </button>
                    </div>
                  </div>
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" class="clr-blue">Nama Lengkap</label>
                          <input
                            type="text"
                            name="fname"
                            v-model="form.name"
                            placeholder="Nama Lengkap"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('name') }"
                          />
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('ktp') }"
                            v-model="form.ktp"
                            name="ktp"
                            placeholder="No. KTP"
                          />
                          <has-error :form="form" field="ktp"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('nohp') }"
                            v-model="form.nohp"
                            name="contact"
                            placeholder="No. Telepon"
                          />
                          <has-error :form="form" field="nohp"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            v-model="form.email"
                            type="email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                            class="form-control"
                            name="email"
                            placeholder="Email"
                          />
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="password"
                            v-model="form.password"
                            :class="{ 'is-invalid': form.errors.has('password') }"
                            class="form-control"
                            name="contact"
                            placeholder="Password"
                          />
                          <has-error :form="form" field="password"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <p>Tipe User</p>
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  v-model="form.type"
                                  name="type"
                                  checked
                                  value="superadmin"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Sys Admin</span>
                              </div>
                            </fieldset>
                          </li>
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input type="radio" v-model="form.type" name="type" value="admin" />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Company Staff</span>
                              </div>
                            </fieldset>
                          </li>
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  v-model="form.type"
                                  name="type"
                                  value="collector"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Collector</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                        <has-error :form="form" field="type"></has-error>
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
                    <label for="users-list-role">Role</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="users-list-role">
                        <option value>All</option>
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Status</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="users-list-status">
                        <option value>All</option>
                        <option value="Active">Active</option>
                        <option value="Blocked">Blocked</option>
                        <option value="deactivated">Deactivated</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Verified</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="users-list-verified">
                        <option value>All</option>
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-department">Department</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="users-list-department">
                        <option value>All</option>
                        <option value="Sales">Sales</option>
                        <option value="Devlopment">Devlopment</option>
                        <option value="Management">Management</option>
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>No Hp</th>
                      <th>Tipe User</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <th scope="row">
                        <input type="checkbox" :checked="cekall" />
                      </th>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.nohp}}</td>
                      <td>{{user.type}}</td>
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
                  <tfoot>
                    <div class="mt-2 pl-1">
                      <pagination :limit="5" :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                  </tfoot>
                </table>
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
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        nohp: "",
        status: "",
        ktp: "",
        photo: ""
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
        .put("api/user/" + this.form.id)
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
            .delete("api/user/" + id)
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
      axios.get("api/user?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/user").then(({ data }) => (this.users = data));
      }
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
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
        .get("api/findUser?q=" + query)
        .then(data => {
          this.users = data.data;
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
