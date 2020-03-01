<template>
  <div class="user">
    <!-- users list start -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Users > List User</h2>
      </div>
      <div class="head-title">
        <button
          type="button"
          data-toggle="modal"
          data-target="#exampleModalCenter"
          class="btn btn-primary"
        >
          <i class="fa fa-user-plus fa-lg pr-1"></i>
          Tambah User
        </button>
        <!-- Modal -->
        <div
          class="modal fade"
          id="exampleModalCenter"
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
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" class="clr-blue">Nama Lengkap</label>
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            placeholder="Nama Lengkap"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input type="text" class="form-control" name="ktp" placeholder="No. KTP" />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="contact"
                            placeholder="No. Telepon"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input type="email" class="form-control" name="email" placeholder="Email" />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="password"
                            class="form-control"
                            name="contact"
                            placeholder="Password"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <p>Tipe User</p>
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input type="radio" name="type" checked value="admin" />
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
                                <input type="radio" name="type" value="staff" />
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
                                <input type="radio" name="type" value="user" />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Collector</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                      </div>
                      <div class="col-12">
                        <p>Status</p>
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input type="radio" name="status" checked value="true" />
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
                                <input type="radio" name="status" value="false" />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Tidak Aktif</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
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
                    <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                      <button
                        class="btn btn-white filter-btn dropdown-toggle border text-dark"
                        type="button"
                        id="dropdownMenuButton6"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >1 - 20 of 50</button>
                      <div
                        class="dropdown-menu dropdown-menu-right"
                        aria-labelledby="dropdownMenuButton6"
                      >
                        <a class="dropdown-item" href="#">20</a>
                        <a class="dropdown-item" href="#">50</a>
                      </div>
                    </div>
                    <div class="ag-btns d-flex flex-wrap">
                      <input
                        type="text"
                        class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0"
                        id="filter-text-box"
                        placeholder="Search...."
                      />
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
              <div id="myGrid" class="aggrid ag-theme-material"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section end -->
    </section>
    <!-- users list ends -->
  </div>
</template>

<script>
const setupD = require("./setup");
export default {
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: ""
      })
    };
  },
  methods: {
    setup() {
      setupD.setup("api/user");
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          // success
          $("#myGrid").modal("hide");
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

    createUser() {
      this.$Progress.start();

      this.form
        .post("api/user")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#myGrid").modal("hide");

          toast({
            type: "success",
            title: "User Created in successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    }
  },
  created() {
    Fire.$on("AfterCreate", () => {
      this.setup();
    });
    this.setup();
  }
};
</script>
