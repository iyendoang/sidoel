/**
 * DataTables Basic
 */

$(function () {
  "use strict";

  var dt_alumnus_table = $(".datatables-alumnus"),
    assetPath = "Students/Models/";

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_alumnus_table.length) {
    var dt_alumnus = dt_alumnus_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: assetPath + "cruds-alumnus.php?pg=dataAlumnus",
        type: "GET",
      },
      columns: [
        { data: "responsive_id" },
        { data: "siswa_id" },
        { data: "siswa_id" }, // used for sorting so will hide this column
        { data: "siswa_nama" },
        { data: "siswa_tempat" },
        { data: "siswa_tgllahir" },
        { data: "nama_ayah" },
        { data: "kelas_id" },
        { data: "" },
      ],
      columnDefs: [
        {
          // For Responsive
          className: "control",
          orderable: false,
          responsivePriority: 2,
          targets: 0,
        },
        {
          // For Checkboxes
          targets: 1,
          orderable: false,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            return (
              '<div class="form-check"> <input class="form-check-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
              data +
              '" /><label class="form-check-label" for="checkbox' +
              data +
              '"></label></div>'
            );
          },
          checkboxes: {
            selectAllRender:
              '<div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
          },
        },
        {
          targets: 2,
          visible: false,
        },
        {
          // File Ijazah image/badge, Name and siswa_nis
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $file_lulus_ijzs = full["file_lulus_ijz"],
              $name = full["siswa_nama"],
              $siswa_nis = full["siswa_nis"];
            if ($file_lulus_ijzs) {
              // For File Ijazah image
              var $output =
                '<img src="' +
                assetPath +
                "../../" +
                $file_lulus_ijzs +
                '" alt="File Ijazah" width="32" height="32">';
            } else {
              // For File Ijazah badge
              var kelas_idNum = full["kelas_id"];
              var kelas_ids = [
                "success",
                "danger",
                "warning",
                "info",
                "dark",
                "primary",
                "secondary",
              ];
              var $kelas_id = kelas_ids[kelas_idNum],
                $name = full["siswa_nama"],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (
                ($initials.shift() || "") + ($initials.pop() || "")
              ).toUpperCase();
              $output =
                '<span class="file_lulus_ijz-content">' + $initials + "</span>";
            }

            var colorClass =
              $file_lulus_ijzs === "" ? " bg-light-" + $kelas_id + " " : "";
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="file_lulus_ijz ' +
              colorClass +
              ' me-1">' +
              $output +
              "</div>" +
              '<div class="d-flex flex-column">' +
              '<span class="emp_name text-truncate fw-bold">' +
              $name +
              "</span>" +
              '<small class="emp_siswa_nis text-truncate text-muted">' +
              $siswa_nis +
              "</small>" +
              "</div>" +
              "</div>";
            return $row_output;
          },
        },
        {
          responsivePriority: 1,
          targets: 4,
        },
        {
          // Actions
          targets: -1,
          title: "Actions",
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
              "</a>" +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons["file-text"].toSvg({
                class: "font-small-4 me-50",
              }) +
              "Details</a>" +
              '<a href="javascript:;" class="dropdown-item">' +
              feather.icons["archive"].toSvg({ class: "font-small-4 me-50" }) +
              "Archive</a>" +
              '<a href="javascript:;" class="dropdown-item delete-record">' +
              feather.icons["trash-2"].toSvg({ class: "font-small-4 me-50" }) +
              "Delete</a>" +
              "</div>" +
              "</div>" +
              '<a href="javascript:;" class="item-edit">' +
              feather.icons["edit"].toSvg({ class: "font-small-4" }) +
              "</a>"
            );
          },
        },
      ],
      order: [[2, "desc"]],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: "collection",
          className: "btn btn-outline-secondary dropdown-toggle me-2",
          text:
            feather.icons["share"].toSvg({ class: "font-small-4 me-50" }) +
            "Export",
          buttons: [
            {
              extend: "print",
              text:
                feather.icons["printer"].toSvg({
                  class: "font-small-4 me-50",
                }) + "Print",
              className: "dropdown-item",
              exportOptions: { columns: [3, 4, 5, 6, 7] },
            },
            {
              extend: "csv",
              text:
                feather.icons["file-text"].toSvg({
                  class: "font-small-4 me-50",
                }) + "Csv",
              className: "dropdown-item",
              exportOptions: { columns: [3, 4, 5, 6, 7] },
            },
            {
              extend: "excel",
              text:
                feather.icons["file"].toSvg({ class: "font-small-4 me-50" }) +
                "Excel",
              className: "dropdown-item",
              exportOptions: { columns: [3, 4, 5, 6, 7] },
            },
            {
              extend: "pdf",
              text:
                feather.icons["clipboard"].toSvg({
                  class: "font-small-4 me-50",
                }) + "Pdf",
              className: "dropdown-item",
              exportOptions: { columns: [3, 4, 5, 6, 7] },
            },
            {
              extend: "copy",
              text:
                feather.icons["copy"].toSvg({ class: "font-small-4 me-50" }) +
                "Copy",
              className: "dropdown-item",
              exportOptions: { columns: [3, 4, 5, 6, 7] },
            },
          ],
          init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
            $(node).parent().removeClass("btn-group");
            setTimeout(function () {
              $(node)
                .closest(".dt-buttons")
                .removeClass("btn-group")
                .addClass("d-inline-flex");
            }, 50);
          },
        },
        {
          text:
            feather.icons["plus"].toSvg({ class: "me-50 font-small-4" }) +
            "Add New Record",
          className: "create-new btn btn-primary",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#modals-slide-in",
          },
          init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
          },
        },
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return "Details of " + data["siswa_nama"];
            },
          }),
          type: "column",
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
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
              ? $('<table class="table"/>').append(
                  "<tbody>" + data + "</tbody>"
                )
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
    });
    $("div.head-label").html('<h6 class="mb-0">DataTable with Buttons</h6>');
  }

  // Add New record
  // ? Remove/Update this code as per your requirements ?
  var count = 101;
  $(".data-submit").on("click", function () {
    var $new_name = $(".add-new-record .dt-full-name").val(),
      $new_siswa_nis = $(".add-new-record .dt-siswa_nis").val(),
      $new_siswa_tempat = $(".add-new-record .dt-siswa_tempat").val(),
      $new_date = $(".add-new-record .dt-date").val(),
      $new_nama_ayah = $(".add-new-record .dt-nama_ayah").val();

    if ($new_name != "") {
      dt_alumnus.row
        .add({
          responsive_id: null,
          id: count,
          siswa_nama: $new_name,
          siswa_nis: $new_siswa_nis,
          siswa_tempat: $new_siswa_tempat,
          siswa_tgllahir: $new_date,
          nama_ayah: "$" + $new_nama_ayah,
          kelas_id: 5,
        })
        .draw();
      count++;
      $(".modal").modal("hide");
    }
  });

  // Delete Record
  $(".datatables-alumnus tbody").on("click", ".delete-record", function () {
    dt_alumnus.row($(this).parents("tr")).remove().draw();
  });
});
