<template>
  <div class="user">
    <!-- users list start -->
    <!-- <section class="users-list-wrapper" v-if="$gate.isAdminOrAuthor()"> -->
    <section class="users-list-wrapper">
      <div class="fixed">
        <h2 class="head-text">Setoran > List Setoran</h2>
      </div>
      <div class="head-title">
        <button type="button" @click="newModal" class="btn fixed-2 btn-primary">
          Tambah Setoran
        </button>
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
                <h2>{{ editmode ? "EDIT" : "TAMBAH" }} SETORAN</h2>
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
                              class="form-control"
                              type="date"
                              id="datepicker"
                              :class="{
                                'is-invalid': form.errors.has('tanggal'),
                              }"
                              v-model="form.tanggal"
                              name="tanggal"
                              placeholder="Tanggal"
                            />
                            <span class="clr-blue">Tanggal</span>
                          </label>
                          <has-error :form="form" field="tanggal"></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              id="myInput"
                              @keyup="searchid"
                              class="form-control"
                              :class="{
                                'is-invalid': form.errors.has('collector_id'),
                              }"
                              v-model="id"
                              name="collector_id"
                              placeholder="Kolektor ID"
                            />
                            <span class="clr-blue">Kolektor ID</span>
                          </label>
                          <has-error
                            :form="form"
                            field="collector_id"
                          ></has-error>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="has-float-label">
                            <input
                              type="number"
                              class="form-control"
                              :class="{
                                'is-invalid': form.errors.has('jumlah'),
                              }"
                              v-model="form.jumlah"
                              name="jumlah"
                              placeholder="Jumlah Setoran"
                            />
                            <span class="clr-blue">Setoran</span>
                          </label>
                          <has-error :form="form" field="jumlah"></has-error>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  @click="editmode ? updateUser() : createUser()"
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
      <!-- Ag Grid users list section start -->
      <div id="basic-examples">
        <div class="card mt-7">
          <div class="card-content">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
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
                <div class="col-6">
                  <div
                    class="float-right ag-grid-btns d-flex justify-content-between flex-wrap mb-1"
                  >
                    <div class="mb-1 mb-sm-0">
                      <a href="/xl-setoran" class="btn btn-success"
                        >Export Excel</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Collector</th>
                      <th>Lokasi</th>
                      <th>Jumlah Setoran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="setor in setorans.data" :key="setor.id">
                      <td>{{ setor.tanggal }}</td>
                      <td>{{ setor.collector }}</td>
                      <td>{{ setor.lokasi }}</td>
                      <td>Rp. {{ setor.jumlah }}</td>
                      <td>
                        <a @click="editModal(setor)">
                          <i class="feather icon-edit-1 mr-50"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mt-2 pl-1">
                  <pagination
                    :limit="5"
                    :data="setorans"
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
// requred("datepicker-bootstrap");
// import datepicker from "datepicker-bootstrap";

export default {
  data() {
    return {
      id: null,
      cekall: false,
      search: "",
      editmode: false,
      setorans: {},
      form: new Form({
        id: "",
        collector_id: "",
        jumlah: "",
        tanggal: "",
      }),
    };
  },
  methods: {
    autocomplete(arr, inp = document.getElementById("myInput")) {
      /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      /*execute a function when someone writes in the text field:*/
      inp.addEventListener("input", function (e) {
        var a,
          b,
          i,
          val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
          return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML =
              "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function (e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
            });
            a.appendChild(b);
          }
        }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) {
          //up
          /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
      });
      function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = x.length - 1;
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("autocomplete-active");
        }
      }
      function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
          if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
          }
        }
      }
      /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
        closeAllLists(e.target);
      });
    },
    checkall() {
      this.cekall ? (this.cekall = false) : (this.cekall = true);
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/setoran/" + this.form.id)
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
            .delete("api/setoran/" + id)
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
      axios.get("api/setoran?page=" + page).then((response) => {
        this.setorans = response.data;
      });
    },
    loadData() {
      axios.get("api/setoran").then(({ data }) => (this.setorans = data));
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/setoran")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Berhasil Menambah Setoran.",
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
    searchid: _.debounce(() => {
      Fire.$emit("searchid");
    }, 1000),
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.search;
      axios
        .get("api/findSetoran?q=" + query)
        .then((data) => {
          this.setorans = data.data;
        })
        .catch(() => {});
    });
    Fire.$on("searchid", () => {
      axios.get("api/collector/" + this.id.charAt(0)).then((data) => {
        let arr = [];
        arr.push(data.data.id + "/" + data.data.name);
        this.autocomplete(arr);
        this.form.collector_id = data.data.id;
      });
    });
    Fire.$on("AfterCreate", () => {
      this.loadData();
    });
    this.loadData();
    // $("document").ready(() => {
    //   $("#datepicker").daterangepicker({
    //     locale: {
    //       format: "YYYY-MM-DD"
    //     }
    //   });
    // });
  },
};
</script>
