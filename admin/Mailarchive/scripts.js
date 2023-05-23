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
    var datatableMailarchive = $(".datatables-jurusan"),
        assetPath = "Mailarchive/",
        dt_jurusan,
        createMailarchiveForm = $("#createMailarchiveForm");

    // Users List datatable
    if (datatableMailarchive.length) {
        dt_jurusan = datatableMailarchive.DataTable({
            processing: true,
            ajax: assetPath + "ClassMailarchive.php?pg=showjurusan", // JSON file to add data
            responsive: true,
            columns: [
                { data: "" },
                { data: "" },
                { data: "ppdbjurusan_alias" },
                { data: "ppdbjurusan_name" },
                { data: "ppdbjurusan_desc" },
                {
                    render: function (data, type, full, meta) {
                        var data = full["ppdbjurusan_actived"];
                        if (data == 1) {
                            return '<button type="button" class="btn btn-icon btn-success me-25 dtUnactivated" data-id="' + data + '">' + feather.icons["check"].toSvg({ class: "font-medium-2" }) + '</button>';
                        } else {
                            return '<button type="button" class="btn btn-icon btn-warning me-25 dtActivated" data-id="' + data + '">' + feather.icons["x"].toSvg({ class: "font-medium-2" }) + '</button>';
                        }
                    },
                },
                {
                    data: "ppdbjurusan_id",
                    "render": function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-icon btn-warning me-25 btn-edit-suratmasuk" data-id="' + data + '">' + feather.icons["trash"].toSvg({ class: "font-medium-2" }) + '</button>' +
                            '<button type="button" class="btn btn-icon btn-warning me-25 btn-edit-suratmasuk" data-id="' + data + '">' + feather.icons["trash"].toSvg({ class: "font-medium-2" }) + '</button>' +
                            '<button type="button" class="btn btn-icon btn-warning me-25 btn-edit-suratmasuk" data-id="' + data + '">' + feather.icons["trash"].toSvg({ class: "font-medium-2" }) + '</button>';
                    }
                }
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

                // {
                //     targets: 6,
                //     orderable: true,
                //     render: function (data, type, full, meta) {
                //         var ppdbjurusan_actived = full["ppdbjurusan_actived"],
                //             ppdbjurusan_id = full["ppdbjurusan_id"];
                //         if (ppdbjurusan_actived == 1) {
                //             return (
                //                 '<button data-id="' +
                //                 ppdbjurusan_id +
                //                 '" type="button" class="btn btn-sm btn-icon btn-success me-1 dtUnactivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Unactivated">' +
                //                 feather.icons["check"].toSvg({ class: "font-medium-2" }) +
                //                 "</button>" +
                //                 '<button type="button" data-id="' +
                //                 ppdbjurusan_id +
                //                 '" class="btn btn-sm btn-icon btn-danger deleteMailarchive" >' +
                //                 feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                //                 "</button>"
                //             );
                //         } else {
                //             return (
                //                 '<button data-id="' +
                //                 ppdbjurusan_id +
                //                 '" type="button" class="btn btn-sm btn-icon btn-warning me-1 dtActivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Activated">' +
                //                 feather.icons["x"].toSvg({ class: "font-medium-2" }) +
                //                 "</button>" +
                //                 '<button type="button" data-id="' +
                //                 ppdbjurusan_id +
                //                 '" class="btn btn-sm btn-icon btn-danger deleteMailarchive">' +
                //                 feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                //                 "</button>"
                //             );
                //         }
                //     },
                // },
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
                            return "Details of Mailarchive";
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
                    text: "Add Mailarchive",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#createMailarchive",
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
    if (createMailarchiveForm.length) {
        createMailarchiveForm.validate({
            rules: {
                ppdbjurusan_id: {
                    required: true,
                },
                ppdbjurusan_name: {
                    required: true,
                },
                ppdbjurusan_alias: {
                    required: true,
                },
            },
        });
    }

    if (createMailarchiveForm) {
        createMailarchiveForm.on("submit", function (e) {
            var isValid = createMailarchiveForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: "Mailarchive/ClassMailarchive.php?pg=storeMailarchive",
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
                            createMailarchiveForm[0].reset();
                            $("#createMailarchive").modal("hide");
                            datatableMailarchive.DataTable().ajax.reload();
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
    $(".datatables-jurusan tbody").on(
        "click",
        ".deleteMailarchive",
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
                        url: assetPath + "ClassMailarchive.php?pg=deleteMailarchive", // JSON file to add data
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
                                datatableMailarchive.DataTable().ajax.reload();
                                // setTimeout(function () {
                                //     window.location.reload();
                                // }, 1500);
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
    datatableMailarchive.on("click", ".dtUnactivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassMailarchive.php?pg=dtUnactivated", // JSON file to add data
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
                    datatableMailarchive.DataTable().ajax.reload();
                }
            },
        });
    });
    datatableMailarchive.on("click", ".dtActivated", function () {
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
            url: assetPath + "ClassMailarchive.php?pg=dtActivated", // JSON file to add data
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
                    datatableMailarchive.DataTable().ajax.reload();
                }
            },
        });
    });
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
    $(document).on('click', '.btn-edit-suratmasuk', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'Correspondence/ClassCorrespondence.php?pg=showbyidsuratmasuk',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                $('#id').val(response.id_suratmasuk);
                $('#suratmasuk_nomor').val(response.suratmasuk_nomor);
                $('#suratmasuk_tgl').val(response.suratmasuk_tgl);
                $('#editModal').modal('show');
            },
            error: function () {
                Swal.fire("Gagal", "Terjadi kesalahan saat mengambil data surat masuk", "error");
            }
        });
    });
});
