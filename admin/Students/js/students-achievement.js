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
  var dataTableAchievements = $(".datatables-achievements"),
    assetPath = "Students/Models/",
    dt_achievement,
    addAchievementForm = $("#addAchievementForm");

  // Users List datatable
  if (dataTableAchievements.length) {
    dt_achievement = dataTableAchievements.DataTable({
      processing: true,
      ajax: assetPath + "cruds-achievement.php?pg=dataPrestasi", // JSON file to add data
      responsive: true,
      columns: [
        { data: "" },
        { data: "siswa_id" },
        { data: "" },
        { data: "siswa_nama" },
        { data: "kelas_nama" },
        { data: "tahunajaran_nama" },
        { data: "prestasi_nama" },
        { data: "prestasi_keterangan" },
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
          visible: false,
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $tingkat_nama = full["tingkat_nama"] + "-",
              $kelas_nama = full["kelas_nama"] + "-",
              $jurusan_nama = full["jurusan_nama"];

            return (
              '<span class="text-nowrap">' +
              $tingkat_nama +
              $kelas_nama +
              $jurusan_nama +
              "</span>"
            );
          },
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            var $tahunajaran_nama = full["tahunajaran_nama"] + "-",
              $semester_nama = full["semester_nama"];

            return (
              '<span class="text-nowrap">' +
              $tahunajaran_nama +
              $semester_nama +
              "</span>"
            );
          },
        },
        {
          // Actions
          targets: 2,
          title: "Actions",
          orderable: false,
          render: function (data, type, full, meta) {
            var $prestasi_id = full["prestasi_id"];
            return (
              '<button  data-id="' +
              $prestasi_id +
              '" class="btn btn-sm btn-icon deleteAchievement">' +
              feather.icons["trash"].toSvg({
                class: "font-medium-2 text-body",
              }) +
              "</button>"
            );
          },
        },
      ],
      order: [[1, "asc"]],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"kelas_nama mt-50 width-200 me-1">B>>' +
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
      buttons: [
        {
          text: "Add Achievement",
          className: "add-new btn btn-primary mt-50",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#addAchievementModal",
          },
          init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
          },
        },
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return "Details of Achievement";
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
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(4)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="kelas_nama" class="form-control select2 text-capitalize"><option value=""> Pilih Rombel </option></select>'
            )
              .appendTo(".kelas_nama")
              .on("change", function () {
                var val = $(this).val();
                column.search(this.value).draw();
              });

            // Only contains the *visible* options from the first page
            console.log(column.data().unique());

            // If I add extra data in my JSON, how do I access it here besides column.data?
            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '">' + d + "</option>");
              });
          });
      },
    });
  }
  // jQuery Validation
  // --------------------------------------------------------------------
  if (addAchievementForm.length) {
    addAchievementForm.validate({
      rules: {
        kelas_id: {
          required: true,
        },
        siswa_id: {
          required: true,
        },
        prestasi_nama: {
          required: true,
        },
        prestasi_keterangan: {
          required: true,
        },
      },
    });
  }

  if (addAchievementForm) {
    addAchievementForm.on("submit", function (e) {
      var isValid = addAchievementForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Students/Models/cruds-achievement.php?pg=addAchievementStudent",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            addAchievementForm[0].reset();
            $("#addAchievementModal").modal("hide");
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
              dataTableAchievements.DataTable().ajax.reload();
              // setTimeout(function () {
              //     window.location.reload();
              // }, 1500);
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
  $(".datatables-achievements tbody").on(
    "click",
    ".deleteAchievement",
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
            url: assetPath + "cruds-achievement.php?pg=dataPrestasiDeleted", // JSON file to add data
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
                dataTableAchievements.DataTable().ajax.reload();
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
  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "Students/Models/cruds-achievement.php?pg=selectKelasId",
      cache: false,
      success: function (msg) {
        $("#kelas_id").html(msg);
      },
    });

    $("#kelas_id").change(function () {
      var kelas_id = $("#kelas_id").val();
      $.ajax({
        type: "POST",
        url: "Students/Models/cruds-achievement.php?pg=selectSiswaId",
        data: {
          kelas_id: kelas_id,
        },
        cache: false,
        success: function (msg) {
          $("#siswa_id").html(msg);
        },
      });
    });
  });
});
