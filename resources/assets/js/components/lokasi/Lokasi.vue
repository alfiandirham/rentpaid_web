<template>
  <div class="user">
    <!-- users list start -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Lokasi > List Lokasi</h2>
      </div>
      <div class="head-title">
        <button
          type="button"
          data-toggle="modal"
          data-target="#exampleModalCenter"
          class="btn btn-primary"
        >
          <i class="fa fa-map-marker fa-lg pr-1"></i>
          Tambah Lokasi
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
                <h2>TAMBAH LOKASI</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" class="clr-blue">Nama Lokasi</label>
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            placeholder="Nama Lokasi"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fname" style="color: #606060;">Pilih Lokasi</label>
                          <div class="map-section">
                            <div class="py-2 px-4">
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Ketik Nama Lokasi"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="lat"
                            placeholder="Latitude"
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="long"
                            placeholder="Longitude"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="email"
                            placeholder="Provinsi"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="kab"
                            placeholder="Kabupaten/Kota"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="kec"
                            placeholder="Kecematan"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="desa"
                            placeholder="Desa/Kelurahan"
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="owner"
                            placeholder="Pilih Owner"
                          />
                        </div>
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
                    <label for="location-list-owner">Owner</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="location-list-owner">
                        <option value>All</option>
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="location-list-status">Status</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="location-list-status">
                        <option value>All</option>
                        <option value="Active">Active</option>
                        <option value="Blocked">Blocked</option>
                        <option value="deactivated">Deactivated</option>
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
