$(function () {
    ('use strict');
    var dtUserTable = $('.user-list-table'),
        // assetPath = '../app-assets/',
        assetPath = "Students/Models/",
        userView = 'app-user-view-account.html';

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + 'data/user-list.json', // JSON file to add data
            processing: true,
            serverSide: true,
            ajax: {
                url: assetPath + "fetch-masters-students.php",
                type: "GET",
            },
            columns: [
                // columns according to JSON
                //   { data: '' },
                { data: 'siswa_avatar' },
                { data: 'siswa_nama_bold' },
                { data: '' }
            ],
            columnDefs: [
              

                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<a href="' +
                            userView +
                            '" class="btn btn-sm btn-icon">' +
                            feather.icons['eye'].toSvg({ class: 'font-medium-3 text-body' }) +
                            '</a>'
                        );
                    }
                }
            ],
            order: [[1, 'desc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-50 mb-1"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-1"f><"user_role mt-50 width-200">>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // For responsive popup

            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },

        });
    }

    // On edit role click, update text
    var roleEdit = $('.role-edit-modal'),
        roleAdd = $('.add-new-role'),
        roleTitle = $('.role-title');

    roleAdd.on('click', function () {
        roleTitle.text('Add New Role'); // reset text
    });
    roleEdit.on('click', function () {
        roleTitle.text('Edit Role');
    });
});