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
    $.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf(" ") == -1;
    }, "Input tidak boleh mengandung spasi.");
    var datatableMajors = $(".datatables-jurusan"),
        assetPath = "Majors/",
        dt_jurusan,
        createMajorsForm = $("#createMajorsForm"),
        editMajorsForm = $("#editMajorsForm");

    // Users List datatable
    if (datatableMajors.length) {
        dt_jurusan = datatableMajors.DataTable({
            processing: true,
            ajax: assetPath + "ClassMajors.php?pg=showjurusan", // JSON file to add data
            responsive: true,
            columns: [
                { data: "" },
                { data: "" },
                { data: "ppdbjurusan_alias" },
                { data: "ppdbjurusan_name" },
                { data: "ppdbjurusan_desc" },
                {
                    data: "total_siswa_jurusan",
                    render: function (data, type, full, meta) {
                        var total_siswa_jurusan = full["total_siswa_jurusan"],
                            ppdbjurusan_kuota = full["ppdbjurusan_kuota"];
                        if (total_siswa_jurusan < ppdbjurusan_kuota) {
                            return '<button class="btn btn-sm btn-icon btn-warning me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Kuota Gelombang">' + ppdbjurusan_kuota + "</button>" +
                                '<button class="btn btn-sm btn-icon btn-warning me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Pendaftar Gelombang">' + data + "</button>";
                        } else if (total_siswa_jurusan === ppdbjurusan_kuota) {
                            return '<button class="btn btn-sm btn-icon btn-success me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Kuota Penuh">' + ppdbjurusan_kuota + "</button>" +
                                '<button class="btn btn-sm btn-icon btn-success me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Pendaftar Gelombang">' + data + "</button>";
                        } else {
                            return '<button class="btn btn-sm btn-icon btn-danger me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Kuota Melebihi">' + ppdbjurusan_kuota + "</button>" +
                                '<button class="btn btn-sm btn-icon btn-danger me-1 " data-bs-toggle="tooltip" data-bs-placement="top" title="Total Pendaftar Melebihi Kuota">' + data + "</button>";
                        }
                    },
                },
                {
                    data: "ppdbjurusan_id",
                    render: function (data, type, full, meta) {
                        var ppdbjurusan_actived = full["ppdbjurusan_actived"];

                        if (ppdbjurusan_actived == 1) {
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
                        var ppdbjurusan_id = full["ppdbjurusan_id"];
                        return (
                            '<button type="button" data-id="' +
                            ppdbjurusan_id +
                            '" class="btn btn-sm btn-icon me-25 btn-primary btn-edit-majors" >' +
                            feather.icons["edit"].toSvg({ class: "font-medium-2" }) +
                            "</button>" +
                            '<button type="button" data-id="' +
                            ppdbjurusan_id +
                            '" class="btn btn-sm btn-icon me-25 btn-danger deleteMajors" >' +
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
                            return "Details of Majors";
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
                    text: "Add Majors",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#createMajors",
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
    if (createMajorsForm.length) {
        createMajorsForm.validate({
            rules: {
                ppdbjurusan_id: {
                    required: true,
                },
                ppdbjurusan_name: {
                    required: true,
                },
                ppdbjurusan_alias: {
                    required: true,
                    noSpace: true,
                },
                ppdbjurusan_kuota: {
                    required: true,
                    number: true,
                    maxlength: 3,
                },
            },
        });
    }

    if (createMajorsForm) {
        createMajorsForm.on("submit", function (e) {
            var isValid = createMajorsForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: "Majors/ClassMajors.php?pg=storeMajors",
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
                            createMajorsForm[0].reset();
                            $("#createMajors").modal("hide");
                            datatableMajors.DataTable().ajax.reload();
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
    $(".datatables-jurusan tbody").on("click", ".deleteMajors",
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
                        url: assetPath + "ClassMajors.php?pg=deleteMajors", // JSON file to add data
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
                                datatableMajors.DataTable().ajax.reload();
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
    datatableMajors.on("click", ".dtUnactivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassMajors.php?pg=dtUnactivated", // JSON file to add data
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
                    datatableMajors.DataTable().ajax.reload();
                }
            },
        });
    });
    datatableMajors.on("click", ".dtActivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassMajors.php?pg=dtActivated", // JSON file to add data
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
                    datatableMajors.DataTable().ajax.reload();
                }
            },
        });
    });
    $(document).on('click', '.btn-edit-majors', function () {
        var ppdbjurusan_id = $(this).data('id');
        $.ajax({
            url: 'Majors/ClassMajors.php?pg=showbyidmajors',
            type: 'GET',
            data: { ppdbjurusan_id: ppdbjurusan_id },
            dataType: 'json',
            success: function (response) {
                $('#edit_ppdbjurusan_id').val(response.ppdbjurusan_id);
                $('#edit_ppdbjurusan_alias').val(response.ppdbjurusan_alias).attr("disabled", "disabled");
                $('#edit_ppdbjurusan_kuota').val(response.ppdbjurusan_kuota);
                $('#edit_ppdbjurusan_name').val(response.ppdbjurusan_name);
                $('#edit_ppdbjurusan_desc').val(response.ppdbjurusan_desc);
                $('#editMajorsModal').modal('show');
            },
            error: function () {
                Swal.fire("Gagal", "Terjadi kesalahan saat mengambil data surat masuk", "error");
            }
        });
    });
    if (editMajorsForm.length) {
        editMajorsForm.validate({
            rules: {
                ppdbjurusan_id: {
                    required: true,
                },
                ppdbjurusan_name: {
                    required: true,
                },
                ppdbjurusan_kuota: {
                    required: true,
                    number: true,
                    maxlength: 3,
                },
                ppdbjurusan_alias: {
                    required: true,
                    noSpace: true,
                },
            },
        });
    }

    if (editMajorsForm) {
        editMajorsForm.on("submit", function (e) {
            var isValid = editMajorsForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: "Majors/ClassMajors.php?pg=editMajors",
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
                            $("#editMajorsModal").modal("hide");
                            datatableMajors.DataTable().ajax.reload();
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
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
