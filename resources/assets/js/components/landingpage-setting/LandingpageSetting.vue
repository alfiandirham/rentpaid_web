<template>
    <div class="user">
        <!-- users list start -->
        <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
        <section class="users-list-wrapper">
            <!-- users filter start -->
            <div>
                <h2 class="head-text">Landing Page Setting</h2>
            </div>
            <!-- users filter end -->
            <!-- Ag Grid users list section start -->
            <div id="basic-examples">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="head-text">Main Section</h2>
                                    <div class="form-group">
                                        <label for="fname" class="label mb-1">Link Button Login</label>
                                        <input
                                            type="text"
                                            name="link_button_login"
                                            v-model="form.link_button_login"
                                            placeholder="Link Button Login"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('link_button_login') }"
                                        />
                                        <has-error :form="form" field="link_button_login"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="label mb-1">Link Dapatkan Penawaran</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('link_dapatkan_penawaran') }"
                                            v-model="form.link_dapatkan_penawaran"
                                            name="link_dapatkan_penawaran"
                                            placeholder="Link Dapatkan Penawaran"
                                        />
                                        <has-error :form="form" field="link_dapatkan_penawaran"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Link Pelajari Selengkapnya</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('link_pelajari_selengkapnya') }"
                                            v-model="form.link_pelajari_selengkapnya"
                                            name="link_pelajari_selengkapnya"
                                            placeholder="Link Pelajari Selengkapnya"
                                        />
                                        <has-error :form="form" field="link_pelajari_selengkapnya"></has-error>
                                    </div>
                                    <h2 class="head-text">Address Section</h2>
                                    <div class="form-group">
                                        <label for="fname" class="label mb-1">Head Office Makassar</label>
                                        <textarea
                                            name="address_head_office_makassar"
                                            v-model="form.address_head_office_makassar"
                                            placeholder="Head Office Makassar"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('address_head_office_makassar') }"
                                        ></textarea>
                                        <has-error :form="form" field="address_head_office_makassar"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="label mb-1">Head Office Makassar 2</label>
                                        <textarea
                                            name="address_head_office_makassar2"
                                            v-model="form.address_head_office_makassar2"
                                            placeholder="Head Office Makassar 2"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('address_head_office_makassar2') }"
                                        ></textarea>
                                        <has-error :form="form" field="address_head_office_makassar2"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="head-text">Footer Section</h2>
                                    <div class="form-group">
                                        <label for class="label mb-1">Facebook</label>
                                        <input
                                            v-model="form.facebook"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('facebook') }"
                                            class="form-control"
                                            name="facebook"
                                            placeholder="Facebook"
                                        />
                                        <has-error :form="form" field="facebook"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Whatsapp</label>
                                        <input
                                            v-model="form.whatsapp"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('whatsapp') }"
                                            class="form-control"
                                            name="whatsapp"
                                            placeholder="Whatsapp"
                                        />
                                        <has-error :form="form" field="whatsapp"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Instagram</label>
                                        <input
                                            v-model="form.instagram"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('instagram') }"
                                            class="form-control"
                                            name="instagram"
                                            placeholder="Instagram"
                                        />
                                        <has-error :form="form" field="instagram"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Link Tentang Kami</label>
                                        <input
                                            v-model="form.link_tentang_kami"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('link_tentang_kami') }"
                                            class="form-control"
                                            name="link_tentang_kami"
                                            placeholder="Link Tentang Kami"
                                        />
                                        <has-error :form="form" field="link_tentang_kami"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Link Karir</label>
                                        <input
                                            v-model="form.link_karir"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('link_karir') }"
                                            class="form-control"
                                            name="link_karir"
                                            placeholder="Link Karir"
                                        />
                                        <has-error :form="form" field="link_karir"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for class="label mb-1">Link Syarat & Ketentuan</label>
                                        <input
                                            v-model="form.link_syarat_ketentuan"
                                            type="text"
                                            :class="{ 'is-invalid': form.errors.has('link_syarat_ketentuan') }"
                                            class="form-control"
                                            name="link_syarat_ketentuan"
                                            placeholder="Link Syarat Ketentuan"
                                        />
                                        <has-error :form="form" field="link_syarat_ketentuan"></has-error>
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
            form: new Form({
                link_button_login: "",
                link_dapatkan_penawaran: "",
                link_pelajari_selengkapnya: "",
                address_head_office_makassar: "",
                address_head_office_makassar2: "",
                facebook: "",
                whatsapp: "",
                instagram: "",
                link_tentang_kami: "",
                link_karir: "",
                link_syarat_ketentuan: "",
            }),
        };
    },
    methods: {
        loadData() {
            axios.get("api/landingpage-setting").then(({ data }) => {
                this.form.fill(data);
            });
        },
        updateInfo() {
            this.$Progress.start();
            this.form
                .post("api/landingpage-setting")
                .then(() => {
                    swal("Updated!", "Information has been updated.", "success");
                    Fire.$emit("AfterCreate");
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
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
