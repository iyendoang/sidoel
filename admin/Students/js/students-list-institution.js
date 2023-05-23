$(function () {
    ('use strict');
    var dtStudentsTable = $('.students-list-table'),
        newStudentsSidebar = $('.new-students-modal'),
        newStudentsForm = $('.add-new-students'),
        select = $('.select2');
    var assetPath = 'mod_students/cruds/',
        studentsView = '?pg=students-activity&id=' + '',
        siswa_nsm = $('#siswa_nsm').val();
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        });
    });
    // Studentss List datatable
    if (dtStudentsTable.length) {
        dtStudentsTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: assetPath + 'ssp-students-institutions.php?siswa_nsm=' + siswa_nsm,
            // ajax: ({
            //     type: "GET",
            //     async: false,
            //     url: assetPath + 'ssp-students-institutions.php',
            //     data: "siswa_nsm=" + siswa_nsm,
            //     success: function (data) {
            //         console.log("success:data: " + data);
            //         out = data;
            //     }
            // }),
            columns: [
                // columns according to JSON
                { data: 'siswa_id_kota' },
                { data: '' },
                { data: 'siswa_nama' },
                { data: 'tingkat_nama' },
                { data: 'siswa_nis' },
                { data: 'siswa_nisn' },
                { data: 'siswa_gender' },
                { data: 'siswa_tempat' },
                { data: 'siswa_tgllahir' },
                { data: 'nama_ibu' },
                { data: '' },
            ],
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: 1,
                    title: 'No',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var $id_kota = full['siswa_id_kota'];
                        var delSiswa = full['delete'];
                        return (
                            '<a class="btn btn-sm btn-icon text-primary" href="' +
                            studentsView + $id_kota + '">' +
                            feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body text-primary' }) +
                            '</i></a>' +
                            '<button data-id="' + delSiswa + '" class="btn btn-sm btn-icon deleteStudents" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Hapus Siswa">' +
                            feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body text-primary' }) +
                            '</button>'
                        );
                    }
                }
            ],

            order: [[1, 'desc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            lengthMenu: [
                [25, 50, 100, 150, 200, -1],
                [25, 50, 100, 150, 200, "All"]
            ],
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // Buttons with Dropdown
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle me-2',
                    text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8] }
                        }
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
                        }, 50);
                    }
                },
                {
                    text: 'Add New Students',
                    className: 'add-new btn btn-primary',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-slide-in'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
            // For responsive popup

            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // initComplete: function () {
            //     this.api()
            //         .columns(10)
            //         .every(function () {
            //             var column = this;

            //             var label = $('<label class="form-label" for="JenjangLembaga">Jenjang</label>').appendTo('.jenjang_alias');
            //             var select = $(
            //                 '<select id="JenjangLembaga" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Jenjang </option></select>'
            //             )
            //                 .appendTo('.jenjang_alias')
            //                 .on('change', function () {
            //                     var val = $(this).val();
            //                     column.search(this.value).draw();
            //                 });

            //             // Only contains the *visible* options from the first page
            //             console.log(column.data().unique());

            //             // If I add extra data in my JSON, how do I access it here besides column.data?
            //             column.data().unique().sort().each(function (d, j) {
            //                 select.append('<option value="' + d + '">' + d + '</option>')
            //             });
            //         });
            //     this.api()
            //         .columns(11)
            //         .every(function () {
            //             var column = this;

            //             var label = $('<label class="form-label" for="StatusLembaga">Status</label>').appendTo('.lembaga_status');
            //             var select = $(
            //                 '<select id="StatusLembaga" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Status </option></select>'
            //             )
            //                 .appendTo('.lembaga_status')
            //                 .on('change', function () {
            //                     var val = $(this).val();
            //                     column.search(this.value).draw();
            //                 });

            //             // Only contains the *visible* options from the first page
            //             console.log(column.data().unique());

            //             // If I add extra data in my JSON, how do I access it here besides column.data?
            //             column.data().unique().sort().each(function (d, j) {
            //                 select.append('<option value="' + d + '">' + d + '</option>')
            //             });
            //         });
            //     this.api()
            //         .columns(12)
            //         .every(function () {
            //             var column = this;

            //             var label = $('<label class="form-label" for="KecamatanLembaga">Kecamatan</label>').appendTo('.lembaga_kec');
            //             var select = $(
            //                 '<select id="KecamatanLembaga" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Kecamatan </option></select>'
            //             )
            //                 .appendTo('.lembaga_kec')
            //                 .on('change', function () {
            //                     var val = $(this).val();
            //                     column.search(this.value).draw();
            //                 });

            //             // Only contains the *visible* options from the first page
            //             console.log(column.data().unique());

            //             // If I add extra data in my JSON, how do I access it here besides column.data?
            //             column.data().unique().sort().each(function (d, j) {
            //                 select.append('<option value="' + d + '">' + d + '</option>')
            //             });
            //         });
            //     this.api()
            //         .columns(3)
            //         .every(function () {
            //             var column = this;
            //             var label = $('<label class="form-label" for="NamaLembaga">Tingkat</label>').appendTo('.tingkat_nama');
            //             var select = $(
            //                 '<select id="NamaTingkat" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Tingkat </option></select>'
            //             )
            //                 .appendTo('.tingkat_nama')
            //                 .on('change', function () {
            //                     var val = $(this).val();
            //                     column.search(this.value).draw();
            //                 });

            //             // Only contains the *visible* options from the first page
            //             console.log(column.data().unique());

            //             // If I add extra data in my JSON, how do I access it here besides column.data?
            //             column.data().unique().sort().each(function (d, j) {
            //                 select.append('<option value="' + d + '">' + d + '</option>')
            //             });
            //         });
            // }
        });
    }
    // Form Validation
    if (newStudentsForm.length) {
        newStudentsForm.validate({
            errorClass: 'error',
            rules: {
                'students-fullname': {
                    required: true
                },
                'students-name': {
                    required: true
                },
                'students-email': {
                    required: true
                }
            }
        });
        newStudentsForm.on('submit', function (e) {
            var isValid = newStudentsForm.valid();
            e.preventDefault();
            if (isValid) {
                newStudentsSidebar.modal('hide');
            }
        });
    }
    dtStudentsTable.on('click', '.deleteStudents', function () {
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Peringatan?',
            text: "Anda Akan Menghapus Students Ini !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: 'mod_students/cruds/cruds_students.php?pg=deleteStudents',
                    method: "POST",
                    data: 'id=' + id,
                    success: function (data) {
                        const obj = JSON.parse(data);
                        if (obj.status == 200) {
                            Swal.fire({
                                title: 'Good job!',
                                text: obj.message,
                                icon: obj.icon,
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            });
                            dtStudentsTable.DataTable().ajax.reload();
                        }
                    }
                });
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });
            }
        });
    });
});