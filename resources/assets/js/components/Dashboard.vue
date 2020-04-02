<template>
  <div class="dashboard">
    <section id="dashboard-analytics">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
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
        <div class="col-lg-4 col-md-4 col-12">
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
        <div class="col-lg-4 col-md-4 col-12">
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
            <div class="card-content">
              <div id="orders-received-chart"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
