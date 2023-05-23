$(function () {
  ("use strict");
  var dtStudentsTable = $(".user-list-table"),
    assetPath = "Students/Models/",
    detailStudent = "?pg=student-activity&id=";

  // Students List datatable
  if (dtStudentsTable.length) {
    dtStudentsTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: assetPath + "M_SSP_Students.php",
        type: "GET",
      },
      columns: [
        // columns according to JSON

        { data: "siswa_nisn" },
        { data: "siswa_nis" },
        { data: "siswa_nama" },
        { data: "alias_tingkat_nama" },
        { data: "siswa_tempat" },
        { data: "nama_ayah" },
        { data: "nama_ibu" },
        { data: "siswa_telpon" },
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
            title: "#",
            orderable: true,
            render: function (data, type, full, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
          // User full name and username
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $siswa_nama = full["siswa_nama"],
              $siswa_nis = full["siswa_nis"],
              $siswa_nisn = full["siswa_nisn"],
              $siswa_id = full["siswa_id"];
            var $siswa_nama = full["siswa_nama"],
              $initials = $siswa_nama.match(/\b\w/g) || [];
            var $tingkat_nama = full["tingkat_nama"];
            var $tingkatObj = {
              I: "success",
              II: "secondary",
              III: "warning",
              IV: "info",
              V: "primary",
              VI: "danger",
              VII: "success",
              VIII: "primary",
              IX: "danger",
              X: "secondary",
              XI: "warning",
              XII: "danger",
            };
            $initials = (
              ($initials.shift() || "") + ($initials.pop() || "")
            ).toUpperCase();
            $output = '<span class="avatar-content">' + $initials + "</span>";
            var colorClass = "bg-" + $tingkatObj[$tingkat_nama];
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar ' +
              colorClass +
              ' me-25">' +
              $output +
              "</div>" +
              "</div>" +
              '<div class="d-flex flex-column">' +
              '<a href="' +
              detailStudent +
              $siswa_id +
              '" class="user_name text-truncated text-body"><span class="fw-bolder">' +
              $siswa_nama +
              "</span></a>" +
              '<small class="emp_post">' +
              $siswa_nis +
              " / " +
              $siswa_nisn +
              "</small>" +
              "</div>" +
              "</div>";
            return $row_output;
          },
        },
        {
          // User full name and username
          targets: 4,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $siswa_tempat = full["siswa_tempat"],
              $siswa_tgllahir = full["siswa_tgllahir"];
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="d-flex flex-column">' +
              '<span class="fw-truncated">' +
              $siswa_tempat +
              "</span></a>" +
              '<small class="emp_post text-nowrap fw-bolder">' +
              $siswa_tgllahir +
              "</small>" +
              "</div>" +
              "</div>";
            return $row_output;
          },
        },

        {
          targets: 7,
          render: function (data, type, full, meta) {
            var $siswa_telpon = full["siswa_telpon"];
            return (
              '<a target="_blank" href="' +
              "https://wa.me/" +
              $siswa_telpon +
              '" class="me-50"><span class="badge rounded-pill badge-light-success">' +
              $siswa_telpon +
              "</span></a>"
            );
          },
        },
        {
          // Actions
          targets: -1,
          title: "Actions",
          orderable: false,
          responsivePriority: -1,
          render: function (data, type, full, meta) {
            var delSiswa = full["siswa_id"];
            return (
              '<a href="' +
              detailStudent +
              delSiswa +
              '" class="btn btn-sm btn-icon btn-success me-25">' +
              feather.icons["edit"].toSvg({ class: "font-medium-2" }) +
              "</a>" +
              '<button data-id="' +
              delSiswa +
              '" class="btn btn-sm btn-icon btn-danger deleteStudents">' +
              feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
              "</button>"
            );
          },
        },
      ],
      order: [[2, "desc"]],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-50 mb-1"' +
        '<"col-sm-12 col-md-4 col-lg-4" l>' +
        // '<"col-sm-12 col-md-8 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-25"f><"tingkat_nama mt-50 width-200"><"me-25"><"kelas_nama mt-50 width-200">>>' +
        '<"col-sm-12 col-md-8 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-25"f>>>' +
        ">t" +
        '<"d-flex justify-content-between mx-2 row"' +
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
              return "Aktivitas " + data["siswa_nama"];
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
      lengthMenu: [
        [10, 50, 100, 150, 200, -1],
        [10, 50, 100, 150, 200, "All"],
      ],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: "&nbsp;",
          next: "&nbsp;",
        },
      },
    });
  }

  dtStudentsTable.on("click", ".deleteStudents", function () {
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
          url: "Students/Models/M_Students.php?pg=deleteStudents",
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
              dtStudentsTable.DataTable().ajax.reload();
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
  });
});
