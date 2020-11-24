<template>
  <div class="location">
    <section class="users-list-wrapper">
      <div>
        <h2 class="head-text">Tenant > {{ tena.lokasi }}</h2>
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
                <h2>EDIT TENANT</h2>
                <i class="fa fa-2x fa-close" data-dismiss="modal"></i>
              </div>
              <div class="modal-body modal-nav-body">
                <form class="form mt-1 form-vertical">
                  <div class="form-body">
                    <div class="row">
                      <!-- <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              name="fname"
                              v-model="form.kode"
                              placeholder="Kode Tenant"
                              :class="{ 'is-invalid': form.errors.has('kode') }"
                            />
                            <span class="clr-blue">Kode Tenant</span>
                          </label>
                          <has-error :form="form" field="kode"></has-error>
                        </div>
                      </div>-->
                      <div class="col-4">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              name="fname"
                              v-model="form.luas"
                              @keyup="upluas"
                              placeholder="Luas tenant (m2)"
                              :class="{ 'is-invalid': form.errors.has('luas') }"
                            />
                            <span class="clr-blue">Luas Tenant m2</span>
                          </label>
                          <has-error :form="form" field="luas"></has-error>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              name="fname"
                              disabled
                              v-model="form.permeter"
                              placeholder="Harga sewa per m2"
                            />
                            <span class="clr-blue">Harga Sewa Per m2</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              disabled
                              id="swb"
                              placeholder="Sewa bulanan"
                            />
                            <span class="clr-blue">Sewa Bulanan</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              disabled
                              value="PPN 10%"
                            />
                            <span class="clr-blue">PPN</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              disabled
                              id="tsw"
                              placeholder="Total sewa /Bln"
                            />
                            <span class="clr-blue">Total Sewa</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <select
                              class="form-control"
                              v-model="form.kategori_id"
                              @change="setTarif()"
                              :class="{
                                'is-invalid': form.errors.has('kategori'),
                              }"
                            >
                              <option value="pilih">Pilih Kategori</option>
                              <option
                                v-for="kategori in kategoris.data"
                                :value="kategori.id"
                                :key="kategori.id"
                              >
                                {{ kategori.kode }}
                              </option>
                            </select>
                            <span class="clr-blue">Kategori</span>
                          </label>
                          <has-error :form="form" field="kategori"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              disabled
                              id="iuaran"
                              v-model="form.harga"
                              placeholder="Iuran Harian"
                            />
                            <span class="clr-blue">Harga Iuran</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              v-model="form.utara"
                              placeholder="Batas Utara"
                              :class="{
                                'is-invalid': form.errors.has('utara'),
                              }"
                            />
                            <span class="clr-blue">Batas Utara</span>
                          </label>
                          <has-error :form="form" field="utara"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              v-model="form.timur"
                              placeholder="Batas Timur"
                              :class="{
                                'is-invalid': form.errors.has('timur'),
                              }"
                            />
                            <span class="clr-blue">Batas Timur</span>
                          </label>
                          <has-error :form="form" field="timur"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              v-model="form.selatan"
                              placeholder="Batas Selatan"
                              :class="{
                                'is-invalid': form.errors.has('selatan'),
                              }"
                            />
                            <span class="clr-blue">Batas Selatan</span>
                          </label>
                          <has-error :form="form" field="selatan"></has-error>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="text"
                              class="form-control"
                              v-model="form.barat"
                              placeholder="Batas Barat"
                              :class="{
                                'is-invalid': form.errors.has('barat'),
                              }"
                            />
                            <span class="clr-blue">Batas Barat</span>
                          </label>
                          <has-error :form="form" field="barat"></has-error>
                        </div>
                      </div>
                      <div class="col-12 pl-2">
                        <p>Status</p>
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  v-model="form.status"
                                  name="status"
                                  checked
                                  value="true"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Aktif</span>
                              </div>
                            </fieldset>
                          </li>
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input
                                  type="radio"
                                  name="status"
                                  v-model="form.status"
                                  value="false"
                                />
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class>Tidak Aktif</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                        <has-error :form="form" field="status"></has-error>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  @click="editmode ? updateData() : createData()"
                  class="btn btn-primary"
                >
                  Ok
                </button>
                <button
                  type="button"
                  class="btn btn-outline-danger"
                  data-dismiss="modal"
                >
                  Batal
                </button>
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
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="users-list-filter">
              <form>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="location-list-status">Status</label>
                    <fieldset class="form-group">
                      <select
                        @change="(e) => filtering(e.target.value)"
                        class="form-control"
                      >
                        <option value="uvuvwu">All</option>
                        <option value="uvuvwi">Tersedia</option>
                        <option value="uvuvwe">Disewa</option>
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
                    <div class="ag-btns d-flex flex-wrap">
                      <div class="action-btns">
                        <div class="btn-dropdown">
                          <div class="btn-group dropdown actions-dropodown">
                            <button
                              type="button"
                              class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              Actions
                            </button>
                            <div class="dropdown-menu">
                              <button @click="nonAll" class="dropdown-item">
                                <i class="feather">
                                  <svg
                                    width="15"
                                    height="15"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M24 0.699301V7.06294C24 7.2484 23.9263 7.42627 23.7952 7.55742C23.664 7.68856 23.4862 7.76224 23.3007 7.76224C23.1152 7.76224 22.9374 7.68856 22.8062 7.55742C22.6751 7.42627 22.6014 7.2484 22.6014 7.06294V1.3986H17.2867C17.1012 1.3986 16.9234 1.32493 16.7922 1.19378C16.6611 1.06264 16.5874 0.884767 16.5874 0.699301C16.5874 0.513835 16.6611 0.335965 16.7922 0.20482C16.9234 0.073676 17.1012 0 17.2867 0H23.3007C23.4862 0 23.664 0.073676 23.7952 0.20482C23.9263 0.335965 24 0.513835 24 0.699301ZM0.689976 7.75758C0.875443 7.75758 1.05331 7.6839 1.18446 7.55276C1.3156 7.42161 1.38928 7.24374 1.38928 7.05827V1.3986H6.71329C6.89875 1.3986 7.07662 1.32493 7.20777 1.19378C7.33891 1.06264 7.41259 0.884767 7.41259 0.699301C7.41259 0.513835 7.33891 0.335965 7.20777 0.20482C7.07662 0.073676 6.89875 0 6.71329 0H0.699301C0.513835 0 0.335965 0.073676 0.20482 0.20482C0.073676 0.335965 0 0.513835 0 0.699301V7.06294C0 7.2484 0.073676 7.42627 0.20482 7.55742C0.335965 7.68856 0.513835 7.76224 0.699301 7.76224L0.689976 7.75758ZM23.3007 16.2378C23.1152 16.2378 22.9374 16.3114 22.8062 16.4426C22.6751 16.5737 22.6014 16.7516 22.6014 16.9371V22.6014H17.2867C17.1012 22.6014 16.9234 22.6751 16.7922 22.8062C16.6611 22.9374 16.5874 23.1152 16.5874 23.3007C16.5874 23.4862 16.6611 23.664 16.7922 23.7952C16.9234 23.9263 17.1012 24 17.2867 24H23.3007C23.4862 24 23.664 23.9263 23.7952 23.7952C23.9263 23.664 24 23.4862 24 23.3007V16.9371C24 16.7516 23.9263 16.5737 23.7952 16.4426C23.664 16.3114 23.4862 16.2378 23.3007 16.2378ZM6.71329 22.6014H1.3986V16.9371C1.3986 16.7516 1.32493 16.5737 1.19378 16.4426C1.06264 16.3114 0.884767 16.2378 0.699301 16.2378C0.513835 16.2378 0.335965 16.3114 0.20482 16.4426C0.073676 16.5737 0 16.7516 0 16.9371V23.3007C0 23.4862 0.073676 23.664 0.20482 23.7952C0.335965 23.9263 0.513835 24 0.699301 24H6.71329C6.89875 24 7.07662 23.9263 7.20777 23.7952C7.33891 23.664 7.41259 23.4862 7.41259 23.3007C7.41259 23.1152 7.33891 22.9374 7.20777 22.8062C7.07662 22.6751 6.89875 22.6014 6.71329 22.6014ZM12 13.8648C11.8145 13.8648 11.6367 13.9385 11.5055 14.0696C11.3744 14.2008 11.3007 14.3786 11.3007 14.5641V19.9254C11.3007 20.1109 11.3744 20.2887 11.5055 20.4199C11.6367 20.551 11.8145 20.6247 12 20.6247C12.1855 20.6247 12.3633 20.551 12.4945 20.4199C12.6256 20.2887 12.6993 20.1109 12.6993 19.9254V14.5455C12.6944 14.3632 12.6186 14.1901 12.488 14.063C12.3574 13.9358 12.1823 13.8647 12 13.8648ZM19.9254 11.3007H17.9441C17.7586 11.3007 17.5807 11.3744 17.4496 11.5055C17.3184 11.6367 17.2448 11.8145 17.2448 12C17.2448 12.1855 17.3184 12.3633 17.4496 12.4945C17.5807 12.6256 17.7586 12.6993 17.9441 12.6993H19.9254C20.1109 12.6993 20.2887 12.6256 20.4199 12.4945C20.551 12.3633 20.6247 12.1855 20.6247 12C20.6247 11.8145 20.551 11.6367 20.4199 11.5055C20.2887 11.3744 20.1109 11.3007 19.9254 11.3007ZM15.1748 12.6993C15.3603 12.6993 15.5382 12.6256 15.6693 12.4945C15.8004 12.3633 15.8741 12.1855 15.8741 12C15.8741 11.8145 15.8004 11.6367 15.6693 11.5055C15.5382 11.3744 15.3603 11.3007 15.1748 11.3007H14.2424C14.057 11.3007 13.8791 11.3744 13.7479 11.5055C13.6168 11.6367 13.5431 11.8145 13.5431 12C13.5431 12.1855 13.6168 12.3633 13.7479 12.4945C13.8791 12.6256 14.057 12.6993 14.2424 12.6993H15.1748ZM4.1352 3.54312H9.29138C9.47684 3.54312 9.65471 3.6168 9.78586 3.74794C9.917 3.87909 9.99068 4.05696 9.99068 4.24242V9.3986C9.99068 9.58407 9.917 9.76194 9.78586 9.89308C9.65471 10.0242 9.47684 10.0979 9.29138 10.0979H4.1352C3.94973 10.0979 3.77186 10.0242 3.64072 9.89308C3.50957 9.76194 3.4359 9.58407 3.4359 9.3986V4.24242C3.4359 4.05696 3.50957 3.87909 3.64072 3.74794C3.77186 3.6168 3.94973 3.54312 4.1352 3.54312ZM4.8345 8.6993H8.59207V4.94172H4.8345V8.6993ZM14.014 9.3986V4.24242C14.014 4.05696 14.0877 3.87909 14.2188 3.74794C14.3499 3.6168 14.5278 3.54312 14.7133 3.54312H19.8648C20.0503 3.54312 20.2281 3.6168 20.3593 3.74794C20.4904 3.87909 20.5641 4.05696 20.5641 4.24242V9.3986C20.5641 9.58407 20.4904 9.76194 20.3593 9.89308C20.2281 10.0242 20.0503 10.0979 19.8648 10.0979H14.7086C14.5232 10.0979 14.3453 10.0242 14.2141 9.89308C14.083 9.76194 14.0093 9.58407 14.0093 9.3986H14.014ZM15.4126 8.6993H19.1702V4.94172H15.4079L15.4126 8.6993ZM9.99068 14.6014V19.7576C9.99068 19.943 9.917 20.1209 9.78586 20.2521C9.65471 20.3832 9.47684 20.4569 9.29138 20.4569H4.1352C3.94973 20.4569 3.77186 20.3832 3.64072 20.2521C3.50957 20.1209 3.4359 19.943 3.4359 19.7576V14.6014C3.4359 14.4159 3.50957 14.2381 3.64072 14.1069C3.77186 13.9758 3.94973 13.9021 4.1352 13.9021H9.29138C9.47684 13.9021 9.65471 13.9758 9.78586 14.1069C9.917 14.2381 9.99068 14.4159 9.99068 14.6014ZM8.59207 15.3007H4.8345V19.0583H8.59207V15.3007ZM19.8648 20.4569H14.7086C14.5232 20.4569 14.3453 20.3832 14.2141 20.2521C14.083 20.1209 14.0093 19.943 14.0093 19.7576V14.6014C14.0093 14.4159 14.083 14.2381 14.2141 14.1069C14.3453 13.9758 14.5232 13.9021 14.7086 13.9021H19.8648C20.0503 13.9021 20.2281 13.9758 20.3593 14.1069C20.4904 14.2381 20.5641 14.4159 20.5641 14.6014V19.7576C20.5641 19.943 20.4904 20.1209 20.3593 20.2521C20.2281 20.3832 20.0503 20.4569 19.8648 20.4569ZM19.1655 15.3007H15.4079V19.0583H19.1655V15.3007ZM12 3.65035C11.8145 3.65035 11.6367 3.72403 11.5055 3.85517C11.3744 3.98631 11.3007 4.16418 11.3007 4.34965V11.3007H4.07459C3.88913 11.3007 3.71126 11.3744 3.58011 11.5055C3.44897 11.6367 3.37529 11.8145 3.37529 12C3.37529 12.1855 3.44897 12.3633 3.58011 12.4945C3.71126 12.6256 3.88913 12.6993 4.07459 12.6993H12C12.1855 12.6993 12.3633 12.6256 12.4945 12.4945C12.6256 12.3633 12.6993 12.1855 12.6993 12V4.34965C12.6993 4.16418 12.6256 3.98631 12.4945 3.85517C12.3633 3.72403 12.1855 3.65035 12 3.65035Z"
                                      fill="#606060"
                                    />
                                  </svg>
                                </i>
                                QR Code
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>
                        <input type="checkbox" id="bb" />
                      </th>
                      <th>Kode Tenant</th>
                      <th>Luas(m2)</th>
                      <th>Bulanan + PPN</th>
                      <th>Iuran Harian</th>
                      <th>Status</th>
                      <th>Penyewa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="tenant in tenants.data" :key="tenant.id">
                      <th scope="row">
                        <input
                          type="checkbox"
                          :value="tenant.disewa + ' ' + tenant.id"
                        />
                      </th>
                      <td>{{ tenant.kode }}</td>
                      <td>{{ tenant.luas }}</td>
                      <td>
                        Rp.
                        {{
                          rp(
                            tenant.luas * tenant.permeter +
                              tenant.luas * tenant.permeter * 0.1
                          )
                        }}
                      </td>
                      <td>Rp. {{ rp(tenant.harga) }}</td>
                      <td v-if="tenant.disewa === 0">
                        <div class="badge badge-pill badge-light-success">
                          Tersedia
                        </div>
                      </td>
                      <td v-if="tenant.disewa === 1">
                        <div class="badge badge-pill badge-light-warning">
                          Disewa
                        </div>
                      </td>
                      <td>
                        <!-- <select
                          :id="`tenant${tenant.id}`"
                          @change="upData(tenant.id)"
                          class="form-control before"
                        >
                          <option :value="tenant.penyewa_id">
                            {{ tenant.penyewa }}
                          </option>
                          <option
                            v-for="user in users"
                            :key="user.id"
                            :value="user.id"
                          >
                            {{ user.nama }}
                          </option>
                        </select> -->
                        <div class="row">
                          <div class="form-group">
                            <input
                              :id="tenant.id"
                              class="form-control"
                              :value="tenant.penyewa"
                              @keyup="setlist(tenant.id)"
                            />
                            <ul class="ulku" :id="tenant.id + 'l'"></ul>
                          </div>
                          <div class="ml-1">
                            <button
                              @click="upData(tenant.id)"
                              class="btn btn-small btn-primary"
                            >
                              Confirm
                            </button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <a @click="editModal(tenant)">
                          <i
                            class="users-edit-icon feather icon-edit-1 mr-50"
                          ></i>
                        </a>
                        <a
                          :href="'/qrcode/' + tenant.id"
                          onclick="window.open(this.href).print()"
                          target="_blank"
                        >
                          <i class="user-edit-icon">
                            <svg
                              width="15"
                              height="15"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M24 0.699301V7.06294C24 7.2484 23.9263 7.42627 23.7952 7.55742C23.664 7.68856 23.4862 7.76224 23.3007 7.76224C23.1152 7.76224 22.9374 7.68856 22.8062 7.55742C22.6751 7.42627 22.6014 7.2484 22.6014 7.06294V1.3986H17.2867C17.1012 1.3986 16.9234 1.32493 16.7922 1.19378C16.6611 1.06264 16.5874 0.884767 16.5874 0.699301C16.5874 0.513835 16.6611 0.335965 16.7922 0.20482C16.9234 0.073676 17.1012 0 17.2867 0H23.3007C23.4862 0 23.664 0.073676 23.7952 0.20482C23.9263 0.335965 24 0.513835 24 0.699301ZM0.689976 7.75758C0.875443 7.75758 1.05331 7.6839 1.18446 7.55276C1.3156 7.42161 1.38928 7.24374 1.38928 7.05827V1.3986H6.71329C6.89875 1.3986 7.07662 1.32493 7.20777 1.19378C7.33891 1.06264 7.41259 0.884767 7.41259 0.699301C7.41259 0.513835 7.33891 0.335965 7.20777 0.20482C7.07662 0.073676 6.89875 0 6.71329 0H0.699301C0.513835 0 0.335965 0.073676 0.20482 0.20482C0.073676 0.335965 0 0.513835 0 0.699301V7.06294C0 7.2484 0.073676 7.42627 0.20482 7.55742C0.335965 7.68856 0.513835 7.76224 0.699301 7.76224L0.689976 7.75758ZM23.3007 16.2378C23.1152 16.2378 22.9374 16.3114 22.8062 16.4426C22.6751 16.5737 22.6014 16.7516 22.6014 16.9371V22.6014H17.2867C17.1012 22.6014 16.9234 22.6751 16.7922 22.8062C16.6611 22.9374 16.5874 23.1152 16.5874 23.3007C16.5874 23.4862 16.6611 23.664 16.7922 23.7952C16.9234 23.9263 17.1012 24 17.2867 24H23.3007C23.4862 24 23.664 23.9263 23.7952 23.7952C23.9263 23.664 24 23.4862 24 23.3007V16.9371C24 16.7516 23.9263 16.5737 23.7952 16.4426C23.664 16.3114 23.4862 16.2378 23.3007 16.2378ZM6.71329 22.6014H1.3986V16.9371C1.3986 16.7516 1.32493 16.5737 1.19378 16.4426C1.06264 16.3114 0.884767 16.2378 0.699301 16.2378C0.513835 16.2378 0.335965 16.3114 0.20482 16.4426C0.073676 16.5737 0 16.7516 0 16.9371V23.3007C0 23.4862 0.073676 23.664 0.20482 23.7952C0.335965 23.9263 0.513835 24 0.699301 24H6.71329C6.89875 24 7.07662 23.9263 7.20777 23.7952C7.33891 23.664 7.41259 23.4862 7.41259 23.3007C7.41259 23.1152 7.33891 22.9374 7.20777 22.8062C7.07662 22.6751 6.89875 22.6014 6.71329 22.6014ZM12 13.8648C11.8145 13.8648 11.6367 13.9385 11.5055 14.0696C11.3744 14.2008 11.3007 14.3786 11.3007 14.5641V19.9254C11.3007 20.1109 11.3744 20.2887 11.5055 20.4199C11.6367 20.551 11.8145 20.6247 12 20.6247C12.1855 20.6247 12.3633 20.551 12.4945 20.4199C12.6256 20.2887 12.6993 20.1109 12.6993 19.9254V14.5455C12.6944 14.3632 12.6186 14.1901 12.488 14.063C12.3574 13.9358 12.1823 13.8647 12 13.8648ZM19.9254 11.3007H17.9441C17.7586 11.3007 17.5807 11.3744 17.4496 11.5055C17.3184 11.6367 17.2448 11.8145 17.2448 12C17.2448 12.1855 17.3184 12.3633 17.4496 12.4945C17.5807 12.6256 17.7586 12.6993 17.9441 12.6993H19.9254C20.1109 12.6993 20.2887 12.6256 20.4199 12.4945C20.551 12.3633 20.6247 12.1855 20.6247 12C20.6247 11.8145 20.551 11.6367 20.4199 11.5055C20.2887 11.3744 20.1109 11.3007 19.9254 11.3007ZM15.1748 12.6993C15.3603 12.6993 15.5382 12.6256 15.6693 12.4945C15.8004 12.3633 15.8741 12.1855 15.8741 12C15.8741 11.8145 15.8004 11.6367 15.6693 11.5055C15.5382 11.3744 15.3603 11.3007 15.1748 11.3007H14.2424C14.057 11.3007 13.8791 11.3744 13.7479 11.5055C13.6168 11.6367 13.5431 11.8145 13.5431 12C13.5431 12.1855 13.6168 12.3633 13.7479 12.4945C13.8791 12.6256 14.057 12.6993 14.2424 12.6993H15.1748ZM4.1352 3.54312H9.29138C9.47684 3.54312 9.65471 3.6168 9.78586 3.74794C9.917 3.87909 9.99068 4.05696 9.99068 4.24242V9.3986C9.99068 9.58407 9.917 9.76194 9.78586 9.89308C9.65471 10.0242 9.47684 10.0979 9.29138 10.0979H4.1352C3.94973 10.0979 3.77186 10.0242 3.64072 9.89308C3.50957 9.76194 3.4359 9.58407 3.4359 9.3986V4.24242C3.4359 4.05696 3.50957 3.87909 3.64072 3.74794C3.77186 3.6168 3.94973 3.54312 4.1352 3.54312ZM4.8345 8.6993H8.59207V4.94172H4.8345V8.6993ZM14.014 9.3986V4.24242C14.014 4.05696 14.0877 3.87909 14.2188 3.74794C14.3499 3.6168 14.5278 3.54312 14.7133 3.54312H19.8648C20.0503 3.54312 20.2281 3.6168 20.3593 3.74794C20.4904 3.87909 20.5641 4.05696 20.5641 4.24242V9.3986C20.5641 9.58407 20.4904 9.76194 20.3593 9.89308C20.2281 10.0242 20.0503 10.0979 19.8648 10.0979H14.7086C14.5232 10.0979 14.3453 10.0242 14.2141 9.89308C14.083 9.76194 14.0093 9.58407 14.0093 9.3986H14.014ZM15.4126 8.6993H19.1702V4.94172H15.4079L15.4126 8.6993ZM9.99068 14.6014V19.7576C9.99068 19.943 9.917 20.1209 9.78586 20.2521C9.65471 20.3832 9.47684 20.4569 9.29138 20.4569H4.1352C3.94973 20.4569 3.77186 20.3832 3.64072 20.2521C3.50957 20.1209 3.4359 19.943 3.4359 19.7576V14.6014C3.4359 14.4159 3.50957 14.2381 3.64072 14.1069C3.77186 13.9758 3.94973 13.9021 4.1352 13.9021H9.29138C9.47684 13.9021 9.65471 13.9758 9.78586 14.1069C9.917 14.2381 9.99068 14.4159 9.99068 14.6014ZM8.59207 15.3007H4.8345V19.0583H8.59207V15.3007ZM19.8648 20.4569H14.7086C14.5232 20.4569 14.3453 20.3832 14.2141 20.2521C14.083 20.1209 14.0093 19.943 14.0093 19.7576V14.6014C14.0093 14.4159 14.083 14.2381 14.2141 14.1069C14.3453 13.9758 14.5232 13.9021 14.7086 13.9021H19.8648C20.0503 13.9021 20.2281 13.9758 20.3593 14.1069C20.4904 14.2381 20.5641 14.4159 20.5641 14.6014V19.7576C20.5641 19.943 20.4904 20.1209 20.3593 20.2521C20.2281 20.3832 20.0503 20.4569 19.8648 20.4569ZM19.1655 15.3007H15.4079V19.0583H19.1655V15.3007ZM12 3.65035C11.8145 3.65035 11.6367 3.72403 11.5055 3.85517C11.3744 3.98631 11.3007 4.16418 11.3007 4.34965V11.3007H4.07459C3.88913 11.3007 3.71126 11.3744 3.58011 11.5055C3.44897 11.6367 3.37529 11.8145 3.37529 12C3.37529 12.1855 3.44897 12.3633 3.58011 12.4945C3.71126 12.6256 3.88913 12.6993 4.07459 12.6993H12C12.1855 12.6993 12.3633 12.6256 12.4945 12.4945C12.6256 12.3633 12.6993 12.1855 12.6993 12V4.34965C12.6993 4.16418 12.6256 3.98631 12.4945 3.85517C12.3633 3.72403 12.1855 3.65035 12 3.65035Z"
                                fill="#606060"
                              />
                            </svg>
                          </i>
                        </a>
                        <!-- <a @click="deleteData(tenant.id)">
                          <i class="users-delete-icon feather icon-trash-2"></i>
                        </a>-->
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination
                    :limit="5"
                    :data="tenants"
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
    <!-- users list ends -->
    <!-- <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>-->
  </div>
</template>

<script>
import num from "numeral";

export default {
  data() {
    return {
      sewa: "",
      search: "",
      kategoris: {},
      editmode: false,
      users: {},
      filter: {
        status: "",
      },
      tenants: {},
      tena: {},
      form: new Form({
        id: "",
        luas: 0,
        permeter: "",
        harga: "",
        utara: "",
        timur: "",
        selatan: "",
        barat: "",
        status: "",
      }),
    };
  },
  methods: {
    rp(n) {
      return num(n).format("0,0");
    },
    setlist: _.debounce((id) => {
      Fire.$emit("nice", id);
    }, 1000),
    setTarif() {
      axios
        .get("/api/kategori/" + this.form.kategori_id)
        .then(({ data }) => (this.form.harga = data.data.tarif));
    },
    filtering(q) {
      axios
        .get("/api/findTenan/" + this.$route.params.id + "?q=" + q)
        .then((data) => {
          this.tenants = data.data;
        })
        .catch(() => {});
    },
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateData() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("/api/tenan/" + this.form.id)
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
    deleteData(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("/api/lokasi/" + id)
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
    upData(id) {
      let getVal = document.getElementById(id);
      swal({
        title: "Anda Yakin?",
        text: "Pastikan Penyewa Benar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Okay!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form.disewa = 1;
          this.form.penyewa_id = getVal.value.charAt(0);
          this.form
            .put("/api/tenan/" + id)
            .then(() => {
              getVal.className = "form-control after";
              swal("Disewa!", "Tenant berhasil disewa.", "success");
            })
            .catch(() => {
              swal("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    },
    nonAll() {
      let data = [];
      $(":checkbox").each(function () {
        if (this.checked) {
          if (this.value == "on") return true;
          data.push(this.value.substring(2));
        }
      });
      window.open("/qrcode?data=" + data).print();
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
      document.getElementById("swb").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter);
      document.getElementById("tsw").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) +
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) * 0.1;
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    getResults(page = 1) {
      axios
        .get("/api/lokasitenan/" + this.$route.params.id + "?page=" + page)
        .then((response) => {
          this.tenants = response.data;
        });
    },
    loadData() {
      axios.get("/api/penyewa2").then(({ data }) => (this.users = data));
      axios.get("/api/kategori").then(({ data }) => (this.kategoris = data));
      axios
        .get("/api/lokasitenan/" + this.$route.params.id)
        .then(({ data }) => {
          this.tenants = data;
          this.tena = data.data[0];
        });
    },
    createData() {
      this.$Progress.start();
      this.form
        .post("/api/lokasi")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Data Created in successfully",
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
    upluas: _.debounce(() => {
      Fire.$emit("upluas");
    }, 1000),
    searchid: _.debounce((id) => {
      Fire.$emit("searchid", id);
    }, 1000),
  },
  created() {
    Fire.$on("nice", (id) => {
      let query = document.getElementById(id).value;
      let ul = document.getElementById(id + "l");
      axios
        .get("/api/findPenyewa?q=" + query)
        .then(({ data }) => {
          data.data.forEach((e) => {
            let node = document.createElement("LI"); // Create a <li> node
            let textnode = document.createTextNode(e.id + "/" + e.nama);
            node.appendChild(textnode);
            node.className = "liku";
            ul.appendChild(node);
            $("#" + id + "l").on("click", "li", function () {
              let nama_mahasiswa = $(this).text();

              $("#" + id).val(nama_mahasiswa);
              $("#" + id + "l").html("");
            });
          });
        })
        .catch(() => {});
    });
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get("/api/findTenan/" + this.$route.params.id + "?q=" + query)
        .then((data) => {
          this.tenants = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    Fire.$on("searchid", (id) => {
      let query = document.getElementById("tenant" + id);
      axios
        .get("/api/findPenyewa?q=" + query.value)
        .then(({ data }) => {
          let arr = [];
          data.data.forEach((e) => {
            arr.push(e.id + "/" + e.nama);
          });
          console.log(arr);
          this.autocomplete(arr, query);
        })
        .catch(() => {});
    });
    Fire.$on("upluas", () => {
      document.getElementById("swb").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter);
      document.getElementById("tsw").value =
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) +
        parseFloat(this.form.luas) * parseFloat(this.form.permeter) * 0.1;
    });
    this.loadData();
  },
  mounted() {
    $("#bb").click(function (event) {
      console.log("fg");
      if (this.checked) {
        // Iterate each checkbox
        $(":checkbox").each(function () {
          let data = this.value;
          if (data[0] == 1) this.checked = true;
        });
      } else {
        $(":checkbox").each(function () {
          this.checked = false;
        });
      }
    });
  },
};
</script>

<style scoped>
.before {
  background-color: #ecf3f7;
}

.after {
  background-color: #ffe2e2;
}

.ulku {
  padding: 0;
  position: absolute;
  z-index: 3;
}
</style>