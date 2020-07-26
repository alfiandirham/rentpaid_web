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
              <h2 class="text-bold-700 text-success mt-1 mb-25">92.6k</h2>
              <p class="mb-2">Pendapatan hari ini</p>
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
              <h2 class="text-bold-700 text-danger mt-1 mb-25">92.6k</h2>
              <p class="mb-2">Pembayaran menunggak hari ini</p>
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
              <h2 class="text-bold-700 mt-1 mb-25">97.5K</h2>
              <p class="mb-2">Tenant disewa</p>
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
              <h2 class="text-bold-700 mt-1 mb-25">97.5K</h2>
              <p class="mb-2">Kolektor Aktif</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row min-vw-100">
        <line-chart :styles="myStyles" :chart-data="datacollection"></line-chart>
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
    };
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: [10, 20, 30],
        datasets: [
          {
            label: "Bulan Ini",
            backgroundColor: "#f87979",
            data: [11, 21, 40],
          },
          {
            label: "Bulan Lalu",
            backgroundColor: "#f5f655",
            data: [this.getRandomInt(), this.getRandomInt()],
          },
        ],
      };
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    },
  },
  mounted() {
    this.fillData();
  },
  computed: {
    myStyles() {
      return {
        position: "relative",
        height: "50vh",
        width: "80vw",
      };
    },
  },
};
</script>
