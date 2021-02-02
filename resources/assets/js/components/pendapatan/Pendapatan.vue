<template>
  <div class="user">
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Transaksi</h2>
      </div>
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
                    <label for="users-list-role">Tanggal Awal</label>
                    <fieldset class="form-group">
                      <input
                        v-model="awal"
                        type="date"
                        name="tawal"
                        class="form-control"
                      />
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Tanggal Akhir</label>
                    <fieldset class="form-group">
                      <input
                        v-model="akhir"
                        type="date"
                        name="takhir"
                        class="form-control"
                      />
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
                <div class="col-12">
                  <div
                    class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1"
                  >
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
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Tenant Bayar</th>
                      <th>Jumlah Pendepatan</th>
                      <th>Tenant Menunggak</th>
                      <th>Jumlah Menunggak</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="transaksi in transaksis.data"
                      :key="transaksi.tanggal"
                    >
                      <td>{{ transaksi.tanggal | myDate }}</td>
                      <td>{{ transaksi.t_bayar }}</td>
                      <td>{{ rp(transaksi.pendapatan) }}</td>
                      <td>{{ transaksi.t_tunggak }}</td>
                      <td>Rp. {{ rp(transaksi.tunggakan) }}</td>
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
      search: "",
      awal: false,
      akhir: false,
      transaksis: {},
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
    getResults(page = 1) {
      axios.get("api/pendapatan?page=" + page).then((response) => {
        this.transaksis = response.data;
      });
    },
    loadData() {
      axios.get("api/pendapatan").then(({ data }) => (this.transaksis = data));
    },
    searchit: _.debounce(() => {
      Fire.$emit("searching");
    }, 1000),
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get(
          "api/findTransaksi?q=" +
            query +
            "&t=" +
            this.type +
            "&a=" +
            this.awal +
            "&l=" +
            this.akhir
        )
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