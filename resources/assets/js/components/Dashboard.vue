<template>
  <div class="dashboard">
    <section id="dashboard-analytics">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-12">
          <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
              <div class="avatar bg-rgba-success p-50 m-0">
                <div class="avatar-content">
                  <i class="fa fa-usd black font-medium-5"></i>
                </div>
              </div>
              <h2 class="text-bold-700 text-success mt-1 mb-25">Rp {{data.phari}}</h2>
              <p class="mb-2 clr-cl">Pendapatan hari ini</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12">
          <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
              <div class="avatar bg-rgba-danger p-50 m-0">
                <div class="avatar-content">
                  <i class="fa fa-usd black font-medium-5"></i>
                </div>
              </div>
              <h2 class="text-bold-700 text-danger mt-1 mb-25">Rp {{data.thari}}</h2>
              <p class="mb-2 clr-cl">Pembayaran menunggak hari ini</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12">
          <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
              <div class="avatar bg-rgba-success p-50 m-0">
                <div class="avatar-content">
                  <i class="fa fa-codepen black font-medium-5"></i>
                </div>
              </div>
              <h2 class="text-bold-700 mt-1 mb-25 clr-bl">{{data.tenant}}</h2>
              <p class="mb-2 clr-cl">Tenant disewa</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12">
          <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
              <div class="avatar bg-rgba-success p-50 m-0">
                <div class="avatar-content">
                  <i class="feather icon-users black font-medium-5"></i>
                </div>
              </div>
              <h2 class="text-bold-700 mt-1 mb-25 clr-bl">{{data.kolektor}}</h2>
              <p class="mb-2 clr-cl">Kolektor Aktif</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <line-chart :styles="myStyles" :chart-data="datacollection"></line-chart>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <h4 class="h4 mb-2 clr-bl">Pendapatan</h4>
              <div class="row">
                <div class="col">
                  <span class="clr-cl">Bulan Ini</span>
                  <h6 class="text-success mt-8">Rp 10k</h6>
                </div>
                <div class="col">
                  <span class="clr-cl">Bulan Lalu</span>
                  <h6 class="clr-bl mt-8">Rp 8k</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import LineChart from "./LineChart.js";

export default {
  components: {
    LineChart,
  },
  data() {
    return {
      datacollection: null,
      data: null,
    };
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: ["01", "05", "09", "13", "17", "21", "26", "31"],
        datasets: [
          {
            label: "Bulan Ini",
            backgroundColor: "#f87979",
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
          },
          {
            label: "Bulan Lalu",
            backgroundColor: "#f5f655",
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
          },
        ],
      };
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    },
    loadData() {
      axios.get("api/dashboard").then((data) => (this.data = data.data));
    },
  },
  mounted() {
    this.fillData();
  },
  computed: {
    myStyles() {
      return {
        position: "relative",
        width: "100%",
      };
    },
  },
  created() {
    this.loadData();
  },
};
</script>
