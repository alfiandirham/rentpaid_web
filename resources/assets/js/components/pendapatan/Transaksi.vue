<template>
  <div class="user">
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Pendapatan</h2>
      </div>
      <div class="head-title"></div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Filters</h4>
          <a class="heading-elements-toggle">
            <i class="fa fa-ellipsis-v font-medium-3"></i>
          </a>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="users-list-filter">
              <form>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Pilih Tahun</label>
                    <fieldset class="form-group">
                      <select
                        v-model="awal"
                        type="text"
                        name="tawal"
                        class="form-control"
                      >
                        <option v-for="y in year" :key="y.year" :value="y.year">
                          {{ y.year }}
                        </option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <button
                      type="button"
                      @click="searchit"
                      class="btn btn-primary mt-2 btn-small"
                    >
                      Tampilkan Data
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-6"></div>
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
                      <a href="/xl-penyear" class="btn btn-success"
                        >Export Excel</a
                      >
                    </div>
                  </div>
                </div>
              </div>
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
                    <h6>Transaksi Bulan Ini</h6>
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
                      <th>Bulan</th>
                      <th>Jumlah Pendapatan</th>
                      <th>Jumlah Tunggakan</th>
                      <th>Jumlah Tenant Disewakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="transaksi in transaksis.data"
                      :key="transaksi.id"
                    >
                      <td>
                        <router-link
                          :to="
                            '/pendapatan/' +
                            transaksi.month +
                            '/' +
                            transaksi.year
                          "
                          >{{ transaksi.month | myMonth }}/{{
                            transaksi.year
                          }}</router-link
                        >
                      </td>
                      <td>
                        Rp.
                        {{
                          transaksi.totalbayar ? rp(transaksi.totalbayar) : 0
                        }}
                      </td>
                      <td>
                        Rp.
                        {{
                          transaksi.totaltunggak
                            ? rp(transaksi.totaltunggak)
                            : 0
                        }}
                      </td>
                      <td>
                        {{
                          transaksi.totaltenan ? rp(transaksi.totaltenan) : 0
                        }}
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
      year: {},
      type: "penyewa",
      editmode: false,
      transaksis: {},
      lokasi: {},
      penyewa: {},
      collector: {},
      filterki: false,
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
        .get("api/findTransaksi?q=" + q)
        .then((data) => {
          this.transaksis = data.data;
        })
        .catch(() => {});
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/transaksi/" + this.form.id)
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
            .delete("api/transaksi/" + id)
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
      axios
        .get(
          this.filterki
            ? "api/transaksi-year?q=" + this.awal + "&page=" + page
            : "api/transaksi-year?page=" + page
        )
        .then((response) => {
          this.transaksis = response.data;
        });
    },
    loadData() {
      axios
        .get("api/transaksi-year")
        .then(({ data }) => (this.transaksis = data));
      axios.get("api/lokasi").then(({ data }) => (this.lokasi = data));
      axios.get("/api/penyewa").then(({ data }) => (this.penyewa = data));
      axios.get("/api/kolektor").then(({ data }) => (this.collector = data));
      axios.get("/api/infotr?q=bulan").then(({ data }) => (this.info = data));
      axios.get("/api/year").then(({ data }) => (this.year = data));
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/transaksi")
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
      this.filterki = true;
      axios
        .get("api/transaksi-year?q=" + this.awal)
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
  mounted() {
    $(function () {
      $("#datepicker").datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: "yy",
        onClose: function (dateText, inst) {
          var year = $(
            "#ui-datepicker-div .ui-datepicker-year :selected"
          ).val();
          $(this).datepicker("setDate", new Date(year, 1));
        },
      });

      $("#datepicker").focus(function () {
        $(".ui-datepicker-month").hide();
        $(".ui-datepicker-calendar").hide();
      });
    });
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