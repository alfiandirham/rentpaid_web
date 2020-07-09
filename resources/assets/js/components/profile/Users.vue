<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Profile</h2>
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
                <h2>{{editmode ? 'EDIT' : ''}} PASSWORD</h2>
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
                              type="password"
                              v-model="form.password"
                              :class="{ 'is-invalid': form.errors.has('password') }"
                              class="form-control"
                              name="contact"
                              placeholder="Password"
                            />
                            <span class="clr-blue">Password Baru</span>
                          </label>
                          <has-error :form="form" field="password"></has-error>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" @click="updateUser()" class="btn btn-primary">Ubah Password</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
              </div>
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
                <div class="col-md-6">
                  <h2 class="head-text">Data Pengguna</h2>
                  <div class="form-group">
                    <label for="fname" class="label mb-1">Nama Lengkap</label>
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
                  <div class="form-group">
                    <label for="fname" class="label mb-1">No. KTP</label>
                    <input
                      type="number"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('ktp') }"
                      v-model="form.ktp"
                      name="ktp"
                      placeholder="No. KTP"
                    />
                    <has-error :form="form" field="ktp"></has-error>
                  </div>
                  <div class="form-group">
                    <label for class="label mb-1">No. HP</label>
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
                  <div class="form-group">
                    <label for="gambar" class="label mb-1">Gambar</label>
                    <div class="row m-2p">
                      <input
                        type="file"
                        @change="updateGambar"
                        name="gambar"
                        class="form-control fileup"
                      />
                      <img
                        class="round mx-2"
                        :src="getProfilePhoto()"
                        alt="User Avatar"
                        height="60"
                        width="60"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h2 class="head-text">Akun Login</h2>
                  <div class="form-group">
                    <label for class="label mb-1">Email</label>
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
                  <div class="form-group">
                    <p>Tipe User</p>
                    <ul class="list-unstyled mb-0">
                      <li class="d-inline-block mr-2">
                        <fieldset>
                          <div class="vs-radio-con">
                            <input
                              type="radio"
                              v-model="form.type"
                              name="type"
                              @change="showLocat()"
                              value="superuser"
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
                            <input
                              type="radio"
                              v-model="form.type"
                              @change="showLocat()"
                              name="type"
                              value="admin"
                            />
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
                              @change="showLocation()"
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
                      <li class="d-inline-block mr-2">
                        <fieldset>
                          <div class="vs-radio-con">
                            <input
                              type="radio"
                              v-model="form.type"
                              @change="showLocat()"
                              name="type"
                              value="owner"
                            />
                            <span class="vs-radio">
                              <span class="vs-radio--border"></span>
                              <span class="vs-radio--circle"></span>
                            </span>
                            <span class>Owner</span>
                          </div>
                        </fieldset>
                      </li>
                    </ul>
                    <has-error :form="form" field="type"></has-error>
                  </div>
                  <div class="form-group">
                    <button @click="editModal(user)" class="btn btn-primary bg-teal">Ganti Password</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" type="button" @click="updateInfo()">Simpan Perubahan</button>
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
      editmode: false,
      user: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        nohp: "",
        photo: "",
        status: "",
        ktp: "",
        photo: "",
        lokasi_id: ""
      })
    };
  },
  methods: {
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/auth").then(({ data }) => {
          this.form.fill(data);
          this.user = data;
        });
      }
    },
    updateUser() {
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .post("api/photo/" + this.form.id)
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
    updateInfo() {
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .post("api/profile")
        .then(() => {
          swal("Updated!", "Information has been updated.", "success");
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    getProfilePhoto() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "img/profile/" + this.form.photo;
      return photo;
    },
    updateGambar(e) {
      let file = e.target.files[0];
      let reader = new FileReader();

      let limit = 1024 * 1024 * 2;
      if (file["size"] > limit) {
        swal({
          type: "error",
          title: "Oops...",
          text: "You are uploading a large file"
        });
        return false;
      }

      reader.onloadend = file => {
        this.form.photo = reader.result;
      };
      reader.readAsDataURL(file);
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
    }
  },
  created() {
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
  }
};
</script>

<style scoped>
.fileup {
  height: 5em;
  padding-top: 1.5rem;
  width: fit-content;
}
.m-2p {
  margin-left: 5px;
}

.bg-teal {
  background: #ecf3f7 !important;
  color: #000;
}

.bg-teal:hover {
  color: #000 !important;
}

.label {
  font-style: normal;
  font-weight: normal;
  font-size: 12px;
  line-height: 100%;
  text-transform: capitalize;
  color: #8f979b;
}
</style>