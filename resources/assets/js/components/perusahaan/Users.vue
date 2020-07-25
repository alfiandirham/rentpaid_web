<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <!-- users filter start -->
      <div>
        <h2 class="head-text">Info Perusahaan</h2>
      </div>
      <!-- users filter end -->
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fname" class="label mb-1">Nama Perusahaan</label>
                    <input
                      type="text"
                      name="fname"
                      v-model="form.name"
                      placeholder="Nama Perusahaan"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="label mb-1">Alamat</label>
                    <input
                      type="text"
                      name="alamat"
                      v-model="form.alamat"
                      placeholder="Alamat"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('alamat') }"
                    />
                    <has-error :form="form" field="alamat"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="gambar" class="label mb-1">Logo Perusahaan</label>
                    <div class="row m-2p">
                      <input
                        type="file"
                        @change="updateGambar"
                        name="gambar"
                        class="form-control fileup"
                      />
                      <img
                        alt="Logo"
                        class="round mx-2"
                        :src="getProfilePhoto()"
                        height="60"
                        width="60"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" type="button" @click="updateUser()">Simpan Perubahan</button>
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
        alamat: "",
        name: "",
        photo: "",
      }),
    };
  },
  methods: {
    loadData() {
      axios.get("/api/company").then(({ data }) => {
        this.form.fill(data);
        this.user = data;
      });
    },
    updateUser() {
      this.$Progress.start();
      this.form
        .post("/api/company/" + this.form.id)
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
          text: "You are uploading a large file",
        });
        return false;
      }

      reader.onloadend = (file) => {
        this.form.photo = reader.result;
      };
      reader.readAsDataURL(file);
    },
  },
  created() {
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
  },
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