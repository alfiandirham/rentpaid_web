<template>
  <div class="user">
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">
          Pendapatan Bulan {{ parseInt(this.$route.params.id) | myMonth }}
        </h2>
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
            class="
              modal-dialog
              float-right
              modal-dialog-scrollable modal-nav-dialog
            "
            role="document"
          >
            <div class="modal-nav">
              <div class="modal-header modal-nav-header">
                <h2>{{ editmode ? "DETAIL" : "TAMBAH" }} TRANSAKSI</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-4">
                            <label class="mb-2 labelin">ID Transaksi</label>
                            <p class="teksin">{{ form.id }}</p>
                          </div>
                          <div class="col-6">
                            <label class="mb-2 labelin">Tanggal</label>
                            <p class="teksin">{{ form.tanggal | myDate }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="row">
                          <div class="col-4">
                            <label class="mb-2 labelin">Nama Penyewa</label>
                            <p class="teksin">{{ form.penyewa }}</p>
                          </div>
                          <div class="col-6">
                            <label class="mb-2 labelin">Detail Lokasi</label>
                            <p class="teksin">{{ form.lokasi }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="row">
                          <div class="col-4">
                            <label class="mb-2 labelin"
                              >Detail Pembayaran</label
                            >
                            <p
                              v-for="v in Object.keys(form.detail)"
                              :key="v"
                              class="teksin text-capitalize"
                            >
                              {{ v }}
                            </p>
                          </div>
                          <div class="col-6">
                            <label class="mb-2 labelin">&nbsp;</label>
                            <p v-for="v in form.detail" :key="v" class="teksin">
                              Rp. {{ v }}
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="row">
                          <div class="col-4">
                            <p
                              :class="
                                form.status === 'menunggak' ? 'text-danger' : ''
                              "
                              class="teksin-bold"
                            >
                              Total
                            </p>
                          </div>
                          <div class="col-6">
                            <p
                              :class="
                                form.status === 'menunggak' ? 'text-danger' : ''
                              "
                              class="teksin-bold"
                            >
                              Rp.
                              {{
                                form.status === "menunggak"
                                  ? form.tunggakan
                                  : form.setoran
                              }}
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="row">
                          <div class="col-4">
                            <label class="mb-2 labelin">Nama Kolektor</label>
                            <p class="teksin">{{ form.collector }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <!-- <div class="row">
                <div class="col-6">
                  <div class="ag-grid-btns d-flex flex-wrap mb-1">
                    <div class="mb-1 mb-sm-0 mr-1">
                      <fieldset class="form-group">
                        <select v-model="type" class="form-control">
                          <option value="penyewa">Penyewa</option>
                          <option value="lokasi">Lokasi</option>
                          <option value="collector">Collector</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="mb-1 mr-1 mb-sm-0">
                      <input
                        type="search"
                        v-model="search"
                        class="
                          ag-grid-filter
                          form-control
                          w-100
                          mr-1
                          mb-1 mb-sm-0
                        "
                        id="filter-text-box"
                        placeholder="Search...."
                      />
                    </div>
                    <div class="mb-1 mb-sm-0">
                      <button
                        type="button"
                        @click="searchit"
                        class="btn btn-warning"
                      >
                        Cari
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div
                    class="
                      float-right
                      ag-grid-btns
                      d-flex
                      justify-content-between
                      flex-wrap
                      mb-1
                    "
                  >
                    <div class="mb-1 mb-sm-0">
                      <a href="/xl-transaksi" class="btn btn-success"
                        >Export Excel</a
                      >
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col-6">
                  <div class="cardc">
                    <h6>Transaksi Keseluruhan</h6>
                    <div class="row">
                      <div class="col-6">
                        <h5>Pendepatan</h5>
                        <p>Rp {{ rp(info.totalp) }}</p>
                      </div>
                      <div class="col-6">
                        <h5>Tunggakan</h5>
                        <p>Rp {{ rp(info.totalt) }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="cardct">
                    <h6>Transaksi Hari Ini</h6>
                    <div class="row">
                      <div class="col-6">
                        <h5>Pendepatan</h5>
                        <p>Rp {{ rp(info.phari) }}</p>
                      </div>
                      <div class="col-6">
                        <h5>Tunggakan</h5>
                        <p>Rp {{ rp(info.thari) }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah Tagihan</th>
                      <th>Jumlah Dibayar</th>
                      <th>Jumlah Tunggakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="transaksi in transaksis.data"
                      :key="transaksi.id"
                    >
                      <td>
                        <router-link
                          :to="'/transaksi/detail/' + transaksi.penyewa_id"
                          >{{ transaksi.nama }}</router-link
                        >
                      </td>
                      <td>
                        Rp.
                        {{
                          rp(
                            (transaksi.dibayar
                              ? parseFloat(transaksi.dibayar)
                              : 0) +
                              (transaksi.sisa ? parseFloat(transaksi.sisa) : 0)
                          )
                        }}
                      </td>
                      <td>
                        Rp.
                        {{ transaksi.dibayar ? rp(transaksi.dibayar) : 0 }}
                      </td>
                      <td>
                        Rp.
                        {{ transaksi.sisa ? rp(transaksi.sisa) : 0 }}
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination
                    :limit="5"
                    :data="transaksis"
                    @pagination-change-page="getResults"
                  ></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section end -->
    </section>
  </div>
</template>

<script>
import num from "numeral";

export default {
  data() {
    return {
      cekall: false,
      search: "",
      awal: false,
      info: {},
      akhir: false,
      type: "penyewa",
      editmode: false,
      transaksis: {},
      lokasi: {},
      penyewa: {},
      collector: {},
      form: new Form({
        id: "",
        penyewa: "",
        setoran: "",
        tanggal: "",
        lokasi: "",
        collector: "",
        detail: "",
        status: "",
        tunggakan: "",
      }),
    };
  },
  methods: {
    rp(n) {
      return num(n).format("0,0");
    },
    filtering(q) {
      axios
        .get("/api/transaksi-month?q=" + q)
        .then((data) => {
          this.transaksis = data.data;
        })
        .catch(() => {});
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("/api/transaksi/" + this.form.id)
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
            .delete("/api/transaksi/" + id)
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
      axios.get("/api/transaksi?page=" + page).then((response) => {
        this.transaksis = response.data;
      });
    },
    loadData() {
      axios
        .get("/api/transaksi-month/" + this.$route.params.id)
        .then(({ data }) => (this.transaksis = data));
      axios.get("/api/lokasi").then(({ data }) => (this.lokasi = data));
      axios.get("/api/penyewa").then(({ data }) => (this.penyewa = data));
      axios.get("/api/kolektor").then(({ data }) => (this.collector = data));
      axios.get("/api/infotr").then(({ data }) => (this.info = data));
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("/api/transaksi")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Berhasil Menambah transaksi.",
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
        .get("/api/transaction-month/" + this.$route.params.id + "?q=" + query)
        .then((data) => {
          this.transaksis = data.data;
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

<style scoped>
.blue-underline {
  font-style: normal !important;
  font-weight: 600 !important;
  font-size: 16px !important;
  line-height: 17px !important;
  text-decoration-line: underline !important;

  color: #3895cc !important;
}

.labelin {
  font-style: normal;
  font-weight: normal;
  font-size: 12px;
  line-height: 17px;
  color: #8f979b;
}

.teksin {
  font-style: normal;
  font-weight: 600;
  font-size: 16px;
  line-height: 17px;
  color: #606060;
  padding-left: 5px;
}

.teksin-bold {
  font-style: normal;
  font-weight: 800;
  font-size: 16px;
  line-height: 17px;
  padding-left: 5px;
  color: #174865;
}

.cardc {
  background: aliceblue;
  padding: 1rem;
  border-radius: 5px;
  margin-bottom: 1.25rem;
}
.cardc h6 {
  color: darkgray;
  font-weight: bold;
}
.cardc h5 {
  font-size: small;
  color: #3895cc;
}
.cardc p {
  color: #3895cc;
}

.cardct {
  background: #d7ffe7;
  padding: 1rem;
  border-radius: 5px;
  margin-bottom: 1.25rem;
}
.cardct h6 {
  color: darkgray;
  font-weight: bold;
}
.cardct h5 {
  font-size: small;
  color: #3895cc;
}
.cardct p {
  color: #3895cc;
}
</style>