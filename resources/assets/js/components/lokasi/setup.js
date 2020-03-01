const setup = (url) => {
    $(document).ready(function () {
        var isRtl;
        if ($("html").attr("data-textdirection") == "rtl") {
            isRtl = true;
        } else {
            isRtl = false;
        }

        //  Rendering badge in status column
        var customBadgeHTML = function (params) {
            var color = "";
            if (params.value == "1") {
                color = "success";
                return (
                    "<div class='badge badge-pill badge-light-" +
                    color +
                    "' >" +
                    "Active" +
                    "</div>"
                );
            } else if (params.value == "0") {
                color = "warning";
                return (
                    "<div class='badge badge-pill badge-light-" +
                    color +
                    "' >" +
                    "Non Active" +
                    "</div>"
                );
            }
        };

        //  Rendering bullet in verified column
        var customBulletHTML = function (params) {
            var color = "";
            if (params.value == true) {
                color = "success";
                return (
                    "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
                );
            } else if (params.value == false) {
                color = "secondary";
                return (
                    "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
                );
            }
        };

        // Renering Icons in Actions column
        var customIconsHTML = function (params) {
            var usersIcons = document.createElement("span");
            var editIconHTML =
                "<a href='app-user-edit.html'><i class= 'users-edit-icon feather icon-edit-1 mr-50'></i></a>";
            var deleteIconHTML = document.createElement("i");
            var attr = document.createAttribute("class");
            attr.value = "users-delete-icon feather icon-trash-2";
            deleteIconHTML.setAttributeNode(attr);
            // selected row delete functionality
            deleteIconHTML.addEventListener("click", function () {
                deleteArr = [params.data];
                // var selectedData = gridOptions.api.getSelectedRows();
                gridOptions.api.updateRowData({
                    remove: deleteArr
                });
            });
            usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
            usersIcons.appendChild(deleteIconHTML);
            return usersIcons;
        };

        // ag-grid
        /*** COLUMN DEFINE ***/

        var columnDefs = [{
                headerName: "Id",
                field: "id",
                checkboxSelection: true,
                headerCheckboxSelectionFilteredOnly: true,
                headerCheckboxSelection: true,
                width: 200
            },
            {
                headerName: "Nama Lokasi",
                field: "lokasi",
                width: 225
            },
            {
                headerName: "Alamat",
                field: "alamat",
                width: 150
            },
            {
                headerName: "Status",
                field: "status",
                width: 150
            },
            {
                headerName: "Owner",
                field: "owner_id",
                width: 150,
                cellRenderer: customBadgeHTML,
                cellStyle: {
                    "text-align": "center"
                }
            },
        ];

        /*** GRID OPTIONS ***/
        var gridOptions = {
            defaultColDef: {
                sortable: true
            },
            enableRtl: isRtl,
            columnDefs: columnDefs,
            rowSelection: "multiple",
            filter: true,
            pagination: true,
            paginationPageSize: 20,
            pivotPanelShow: "always",
            colResizeDefault: "shift",
            animateRows: true,
            resizable: true
        };
        if (document.getElementById("myGrid")) {
            /*** DEFINED TABLE VARIABLE ***/
            var gridTable = document.getElementById("myGrid");

            axios.get(url).then(({
                data
            }) => {
                gridOptions.api.setRowData(data.data);
            });

            /*** FILTER TABLE ***/
            function updateSearchQuery(val) {
                gridOptions.api.setQuickFilter(val);
            }

            $(".ag-grid-filter").on("keyup", function () {
                updateSearchQuery($(this).val());
            });

            /*** CHANGE DATA PER PAGE ***/
            function changePageSize(value) {
                gridOptions.api.paginationSetPageSize(Number(value));
            }

            $(".sort-dropdown .dropdown-item").on("click", function () {
                var $this = $(this);
                changePageSize($this.text());
                $(".filter-btn").text("1 - " + $this.text() + " of 50");
            });

            /*** EXPORT AS CSV BTN ***/
            $(".ag-grid-export-btn").on("click", function (params) {
                gridOptions.api.exportDataAsCsv();
            });

            //  filter data function
            var filterData = function agSetColumnFilter(column, val) {
                var filter = gridOptions.api.getFilterInstance(column);
                var modelObj = null;
                if (val !== "all") {
                    modelObj = {
                        type: "equals",
                        filter: val
                    };
                }
                filter.setModel(modelObj);
                gridOptions.api.onFilterChanged();
            };
            //  filter inside role
            $("#location-list-owner").on("change", function () {
                var locationListOwner = $("#location-list-owner").val();
                filterData("owner_id", locationListOwner);
            });
            //  filter inside status
            $("#location-list-status").on("change", function () {
                var locationListStatus = $("#location-list-status").val();
                filterData("status", locationListStatus);
            });
            // filter reset
            $(".users-data-filter").click(function () {
                $("#users-list-role").prop("selectedIndex", 0);
                $("#users-list-role").change();
                $("#users-list-status").prop("selectedIndex", 0);
                $("#users-list-status").change();
                $("#users-list-verified").prop("selectedIndex", 0);
                $("#users-list-verified").change();
                $("#users-list-department").prop("selectedIndex", 0);
                $("#users-list-department").change();
            });

            /*** INIT TABLE ***/
            new agGrid.Grid(gridTable, gridOptions);
        }
        // users language select
        if ($("#users-language-select2").length > 0) {
            $("#users-language-select2").select2({
                dropdownAutoWidth: true,
                width: "100%"
            });
        }
        // users music select
        if ($("#users-music-select2").length > 0) {
            $("#users-music-select2").select2({
                dropdownAutoWidth: true,
                width: "100%"
            });
        }
        // users movies select
        if ($("#users-movies-select2").length > 0) {
            $("#users-movies-select2").select2({
                dropdownAutoWidth: true,
                width: "100%"
            });
        }
        // users birthdate date
        if ($(".birthdate-picker").length > 0) {
            $(".birthdate-picker").pickadate({
                format: "mmmm, d, yyyy"
            });
        }
        // Input, Select, Textarea validations except submit button validation initialization
        if ($(".users-edit").length > 0) {
            $("input,select,textarea")
                .not("[type=submit]")
                .jqBootstrapValidation();
        }
    });
}

module.exports = {
    setup
}
