<template>
  <div class="tenant">
    <section id="data-list-view" class="data-list-view-header">
      <div>
        <h2 class="head-text">Tenant > List Tenant</h2>
      </div>
      <div class="action-btns d-none">
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

      <!-- DataTable starts -->
      <div class="table-responsive">
        <table class="table data-list-view">
          <thead>
            <tr>
              <th></th>
              <th>Nama Lokasi</th>
              <th>Jumlah Tenant</th>
              <th>Sudah Disewakan</th>
              <th>Jumlah Tersedia</th>
              <th>Owner</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td class="product-name">Pasar Badung</td>
              <td class="product-total">300</td>
              <td class="product-rent">200</td>
              <td class="product-available">100</td>
              <td class="product-owner">Pd Pasar Bali</td>
              <td class="product-action">
                <span class="action-edit">
                  <i class="feather icon-edit"></i>
                </span>
                <span class="action-delete">
                  <i class="feather icon-trash"></i>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- DataTable ends -->

      <!-- add new sidebar starts -->
      <div class="add-new-data-sidebar">
        <div class="overlay-bg"></div>
        <div class="add-new-data">
          <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
              <h4 class="text-uppercase">List View Data</h4>
            </div>
            <div class="hide-data-sidebar">
              <i class="feather icon-x"></i>
            </div>
          </div>
          <div class="data-items pb-3">
            <div class="data-fields px-2 mt-3">
              <div class="row align-items-end">
                <div class="col-sm-12 data-field-col">
                  <select placeholder="Pilih Lokasi" class="form-control">
                    <option>Audio</option>
                    <option>Computers</option>
                    <option>Fitness</option>
                    <option>Appliance</option>
                  </select>
                </div>
                <div class="col-sm-12 data-field-col">
                  <p>Detail Jumlah Tenant</p>
                  <hr />
                </div>
                <div class="col-sm-4 data-field-col">
                  <label for="kategori">Kategori Tenant</label>
                  <input type="text" name="kategori" class="form-control" placeholder="A" />
                </div>
                <div class="col-sm-4 data-field-col">
                  <label for="jumlah">Jumlah Tenant</label>
                  <input type="number" name="jumlah" class="form-control" placeholder="200" />
                </div>
                <div class="col-sm-3 data-field-col">
                  <label for="sewa">Harga Sewa</label>
                  <input
                    type="number"
                    name="sewa"
                    class="form-control"
                    placeholder="Rp. 100.000/bln"
                  />
                </div>
                <div class="col-sm-1 data-field-col">
                  <a>
                    <i class="fa fa-trash fa-2x danger"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
            <div class="add-data-btn">
              <button class="btn btn-primary">Simpan Tenant</button>
            </div>
            <div class="cancel-data-btn">
              <button class="btn btn-outline-danger">Batal</button>
            </div>
          </div>
        </div>
      </div>
      <!-- add new sidebar ends -->
    </section>
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
      setupD.setup();
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
