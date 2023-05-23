$(function () {
  ("use strict");
  var dtStudentsTable = $(".students-mutations-table"),
    assetPath = "Students/Models/",
    addMutationForm = $('#addMutationForm'),
    editMutation = $('#editMutation'),
    detailStudent = "?pg=student-activity&id=",
    mutationDetails = "?pg=student-mutation&id=";

  // Users List datatable
  if (dtStudentsTable.length) {
    dtStudentsTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: assetPath + "cruds-mutations.php?pg=dataMutasi",
        type: "GET",
      },
      columns: [
        // columns according to JSON
        { data: "" },
        { data: "siswa_nama" },
        { data: "tingkat_nama" },
        { data: "siswa_tempat" },
        { data: "kelas_nama" },
        { data: "tahunajaran_nama" },
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
          // User full name and username
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $siswa_nama = full["siswa_nama"],
              $siswa_nis = full["siswa_nis"],
              $siswa_nisn = full["siswa_nisn"],
              $siswa_id = full["siswa_id"];
            var $siswa_nama = full["siswa_nama"],
              $initials = $siswa_nama.match(/\b\w/g) || [];
            $initials = (
              ($initials.shift() || "") + ($initials.pop() || "")
            ).toUpperCase();
            $output = '<span class="avatar-content">' + $initials + "</span>";
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar bg-danger me-1">' +
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
          // User Role
          targets: 2,
          render: function (data, type, full, meta) {
            var $tingkat_nama = full["tingkat_nama"],
              $kelas_nama = full["kelas_nama"];
            $jurusan_nama = full["jurusan_nama"];
            var $roleBadgeObj = {
              I: "success",
              II: "secondary",
              III: "warning",
              IV: "info",
              V: "primary",
              VI: "danger",
              VII: "primary",
              VIII: "warning",
              IX: "danger",
              X: "warning",
              XI: "secondary",
              XII: "success",
            };
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar bg-light-' +
              $roleBadgeObj[$tingkat_nama] +
              ' me-1">' +
              '<span class="avatar-content">' +
              $tingkat_nama +
              $kelas_nama +
              "</span>" +
              "</div>" +
              "</div>" +
              '<div class="d-flex flex-column">' +
              '<span class="fw-muted">' +
              $jurusan_nama +
              "</span>" +
              "</div>" +
              "</div>";
            return $row_output;
          },
        },
        {
          // User full name and username
          targets: 3,
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
          targets: 4,
          render: function (data, type, full, meta) {
            var $tahunajaran_nama = full["tahunajaran_nama"],
              $semester_nama = full["semester_nama"];
            return (
              '<span class="text-uppercase">' +
              $tahunajaran_nama +
              "-" +
              $semester_nama +
              "</span>"
            );
          },
        },
        {
          targets: 5,
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
          render: function (data, type, full, meta) {
            var delSiswa = full["siswa_id"];
            return (
              '<a href="' +
              mutationDetails +
              delSiswa +
              '" class="btn btn-sm btn-icon btn-primary me-1">' +
              feather.icons["edit"].toSvg({ class: "font-medium-2" }) +
              "</a>" +
              '<a href="' +
              detailStudent +
              delSiswa +
              '" class="btn btn-sm btn-icon btn-success me-1">' +
              feather.icons["edit"].toSvg({ class: "font-medium-2" }) +
              "</a>" +
              '<button data-id="' +
              delSiswa +
              '" class="btn btn-sm btn-icon btn-danger cancelMutation">' +
              feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
              "</button>"
            );
          },
        },
      ],
      order: [[1, "desc"]],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"tahunajaran_nama mt-50 width-200 me-1">B>>' +
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
          text: "Add Mutation",
          className: "add-new btn btn-primary mt-50",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#addMutationModal",
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
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(2)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="tingkat_nama" class="form-control select2 text-capitalize"><option value=""> Pilih Tingkat </option></select>'
            )
              .appendTo(".tingkat_nama")
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
        this.api()
          .columns(5)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="tahunajaran_nama" class="form-control select2 text-capitalize"><option value=""> Pilih Tahun </option></select>'
            )
              .appendTo(".tahunajaran_nama")
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

  dtStudentsTable.on("click", ".cancelMutation", function () {
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
          url: "Students/Models/cruds-mutations.php?pg=cancelMutation",
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
  if (addMutationForm.length) {
    addMutationForm.validate({
      rules: {
        siswa_mutasi_kelaslama: {
          required: true,
        },
        siswa_id: {
          required: true,
        },
        siswa_mutasi_tgl: {
          required: true,
        },
        siswa_mutasi_alasan: {
          required: true,
        },
        siswa_mutasi_npsnsekolah: {
          number: true,
          minlength: 8,
          maxlength: 8,
        }
      },
    });
  }

  if (addMutationForm) {
    addMutationForm.on("submit", function (e) {
      var isValid = addMutationForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Students/Models/cruds-mutations.php?pg=addMutation",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            $("#addMutationModal").modal("hide");
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
              dtStudentsTable.DataTable().ajax.reload();
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
  if (editMutation.length) {
    editMutation.validate({
      rules: {
        siswa_mutasi_tgl: {
          required: true,
        },
        siswa_mutasi_alasan: {
          required: true,
        },
        siswa_mutasi_npsnsekolah: {
          number: true,
          minlength: 8,
          maxlength: 8,
        }
      },
    });
  }

  if (editMutation) {
    editMutation.on("submit", function (e) {
      var isValid = editMutation.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Students/Models/cruds-mutations.php?pg=editMutation",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
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
              dtStudentsTable.DataTable().ajax.reload();
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
