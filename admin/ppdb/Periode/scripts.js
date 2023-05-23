/**
 * App user list
 */

$(function () {
    "use strict";
    function ifObjectIsEmpty(obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                return false;
            }
        }

        return JSON.stringify(obj) === JSON.stringify({});
    }
    var datatablePeriode = $(".datatables-periode"),
        select = $('.select2'),
        picker = $('.picker'),
        assetPath = "Periode/",
        dt_periode,
        editPeriodeForm = $("#editPeriodeForm"),
        createPeriodeForm = $("#createPeriodeForm");
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this
            .select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            })
            .change(function () {
                $(this).valid();
            });
    });
    if (picker.length) {
        picker.flatpickr({
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }
    // Users List datatable
    if (datatablePeriode.length) {
        dt_periode = datatablePeriode.DataTable({
            processing: true,
            ajax: assetPath + "ClassPeriode.php?pg=showperiode", // JSON file to add data
            responsive: true,
            columns: [
                { data: "" },
                { data: "" },
                { data: "tahunajaran_nama" },
                { data: "ppdbperiode_opened" },
                { data: "ppdbperiode_closed" },
                {
                    data: "total_siswa_thn",
                    render: function (data, type, full, meta) {
                        var total_siswa_thn = full["total_siswa_thn"];
                        if (total_siswa_thn > 0) {
                            return '<button class="btn btn-sm btn-icon btn-primary me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Pendaftar">' + data + "</button>";
                        } else {
                            return '<button class="btn btn-sm btn-icon btn-danger me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Pendaftar">' + data + "</button>";
                        }
                    },
                },
                {
                    data: "ppdbperiode_id",
                    render: function (data, type, full, meta) {
                        var ppdbperiode_actived = full["ppdbperiode_actived"];
                        if (ppdbperiode_actived == 1) {
                            return '<button data-id="' +
                                data +
                                '" type="button" class="btn btn-sm btn-icon btn-success me-1 dtUnactivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Unactivated">' +
                                feather.icons["check"].toSvg({ class: "font-medium-2" }) +
                                "</button>";
                        } else {
                            return '<button data-id="' +
                                data +
                                '" type="button" class="btn btn-sm btn-icon btn-warning me-1 dtActivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Activated">' +
                                feather.icons["x"].toSvg({ class: "font-medium-2" }) +
                                "</button>";
                        }
                    },
                },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    title: "No",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    targets: 7,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var ppdbperiode_id = full["ppdbperiode_id"],
                            periodetrue_id = full["periodetrue_id"],
                            tahunajaran_id = full["tahunajaran_id"];
                        return (
                            '<button type="button" data-id="' +
                            periodetrue_id +
                            '" class="btn btn-sm btn-icon me-25 btn-primary btn-edit-periode" >' +
                            feather.icons["edit"].toSvg({ class: "font-medium-2" }) +
                            "</button>" +
                            '<button type="button" data-id="' +
                            tahunajaran_id +
                            '" class="btn btn-sm btn-icon me-25 btn-danger deletePeriode" >' +
                            feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                            "</button>"
                        );
                    },
                },
            ],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f>B>>' +
                '><"text-nowrap" t>' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
            },
            // Buttons with Dropdown
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of Periode";
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                "<td>" +
                                col.title +
                                ":" +
                                "</td> " +
                                "<td>" +
                                col.data +
                                "</td>" +
                                "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            buttons: [
                {
                    text: "Add Periode",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#createPeriode",
                    },
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                },
            ],
        });
    }
    // jQuery Validation
    // --------------------------------------------------------------------
    if (createPeriodeForm.length) {
        createPeriodeForm.validate({
            rules: {
                tahunajaran_id: {
                    required: true,
                },
                ppdbperiode_opened: {
                    required: true,
                },
                ppdbperiode_closed: {
                    required: true,
                },
            },
        });
    }

    if (createPeriodeForm) {
        createPeriodeForm.on("submit", function (e) {
            var isValid = createPeriodeForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: "Periode/ClassPeriode.php?pg=storePeriode",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        var json = $.parseJSON(data);
                        if (json.status == 200) {
                            Swal.fire({
                                title: "Maaf",
                                text: json.message,
                                icon: "success",
                                customClass: {
                                    confirmButton: "btn btn-success",
                                },
                            });
                            createPeriodeForm[0].reset();
                            $("#createPeriode").modal("hide");
                            datatablePeriode.DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: "Maaf",
                                text: json.message,
                                icon: "error",
                                customClass: {
                                    confirmButton: "btn btn-danger",
                                },
                            });
                        }
                    },
                });
            }
        });
    }
    // Delete Record
    $(".datatables-periode tbody").on(
        "click",
        ".deletePeriode",
        function () {
            var id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: "Peringatan?",
                text: "Anda Akan Menghapus Siswa Ini Akan Menghapus Juga Data Siswa DI RDM !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger ms-1",
                },
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: assetPath + "ClassPeriode.php?pg=deletePeriode", // JSON file to add data
                        method: "POST",
                        data: "id=" + id,
                        success: function (data) {
                            var json = $.parseJSON(data);
                            if (json.status == 200) {
                                Swal.fire({
                                    title: "Good job!",
                                    text: json.message,
                                    icon: json.icon,
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                    buttonsStyling: false,
                                });
                                datatablePeriode.DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    title: "Maaf",
                                    text: json.message,
                                    icon: json.icon,
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                    buttonsStyling: false,
                                });
                            }
                        },
                    });
                } else {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error",
                        customClass: {
                            confirmButton: "btn btn-success",
                        },
                    });
                }
            });
        }
    );
    datatablePeriode.on("click", ".dtUnactivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassPeriode.php?pg=dtUnactivated", // JSON file to add data
            method: "POST",
            data: "id=" + id,
            success: function (data) {
                const obj = JSON.parse(data);
                if (obj.status == 200) {
                    Swal.fire({
                        title: "Good job!",
                        text: obj.message,
                        icon: obj.icon,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        buttonsStyling: false,
                    });
                    datatablePeriode.DataTable().ajax.reload();
                }
            },
        });
    });
    datatablePeriode.on("click", ".dtActivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassPeriode.php?pg=dtActivated", // JSON file to add data
            method: "POST",
            data: "id=" + id,
            success: function (data) {
                const obj = JSON.parse(data);
                if (obj.status == 200) {
                    Swal.fire({
                        title: "Good job!",
                        text: obj.message,
                        icon: obj.icon,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        buttonsStyling: false,
                    });
                    datatablePeriode.DataTable().ajax.reload();
                }
            },
        });
    });
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "Periode/ClassPeriode.php?pg=showSelectTahunajaran",
            cache: false,
            success: function (msg) {
                $("#tahunajaran_id").html(msg);
                $("#edit_tahunajaran_id").html(msg);
            },
        });
    });
    $(document).on('click', '.btn-edit-periode', function () {
        var ppdbperiode_id = $(this).data('id');
        // alert(ppdbperiode_id)
        $.ajax({
            url: 'Periode/ClassPeriode.php?pg=showbyidperiode',
            type: 'GET',
            data: { ppdbperiode_id: ppdbperiode_id },
            dataType: 'json',
            success: function (response) {
                $('#edit_tahunajaran_nama').val(response.tahunajaran_nama);
                $('#edit_ppdbperiode_id').val(response.ppdbperiode_id);
                // $('#edit_tahunajaran_id').val($(response.tahunajaran_id).select2('val')).trigger('change').attr("readonly", "readonly");
                $('#edit_tahunajaran_id').val(response.tahunajaran_id).trigger('change').attr("disabled", "disabled");
                $('#edit_ppdbperiode_opened').val(response.ppdbperiode_opened);
                $('#edit_ppdbperiode_closed').val(response.ppdbperiode_closed);
                $('#editPeriodeModal').modal('show');
            },
            error: function () {
                Swal.fire("Gagal", "Terjadi kesalahan saat mengambil data surat masuk", "error");
            }
        });
    });
    if (editPeriodeForm.length) {
        editPeriodeForm.validate({
            rules: {
                ppdbperiode_id: {
                    required: true,
                },
                tahunajaran_id: {
                    required: true,
                },
                ppdbperiode_opened: {
                    required: true,
                },
                ppdbperiode_closed: {
                    required: true,
                },
            },
        });
    }

    if (editPeriodeForm) {
        editPeriodeForm.on("submit", function (e) {
            var isValid = editPeriodeForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: "Periode/ClassPeriode.php?pg=editperiode",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        var json = $.parseJSON(data);
                        if (json.status == 200) {
                            Swal.fire({
                                title: "Maaf",
                                text: json.message,
                                icon: "success",
                                customClass: {
                                    confirmButton: "btn btn-success",
                                },
                            });
                            $("#editPeriodeModal").modal("hide");
                            datatablePeriode.DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: "Maaf",
                                text: json.message,
                                icon: "error",
                                customClass: {
                                    confirmButton: "btn btn-danger",
                                },
                            });
                        }
                    },
                });
            }
        });
    }
});
