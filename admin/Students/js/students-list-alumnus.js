$(function () {
  ("use strict");
  var dtStudentsAlumnus = $(".studentsAlumnus-list-table"),
    assetPath = "Students/Models/";
  // Users List datatable
  if (dtStudentsAlumnus.length) {
    dtStudentsAlumnus.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: assetPath + "fetch-alumnus.php",
        type: "GET",
      },
      columns: [
        // columns according to JSON
        {
          targets: 0,
          title: "No",
          orderable: true,
          render: function (data, type, full, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
        },
        {
          targets: 1,
          orderable: false,
          render: function (data, type, full, meta) {
            return full["check_siswa_id"];
          },
        },
        // { data: "check_siswa_id" },
        { data: "siswa_nama_bold" },
        { data: "siswa_nisn" },
        { data: "alias_siswa_gender" },
        { data: "tahunajaran_nama" },
        { data: "siswa_lulus_noseri" },
        { data: "siswa_lulus_ke" },
        { data: "file_lulus_ijz" },
        { data: "btn_siswa_id" },
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: "&nbsp;",
          next: "&nbsp;",
        },
      },
      lengthMenu: [
        [10, 50, 100, 150, 200, -1],
        [10, 50, 100, 150, 200, "All"],
      ],
    });
  }
  $(document).ready(function () {
    $("#btnUpdateYears").click(function () {
      var id = [];
      $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
      });
      if (id.length === 0) {
        Swal.fire({
          title: "Warning!",
          text: "Pilih minimal satu data alumni",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
          buttonsStyling: false,
        });
        return false;
      } else {
        $("#yearsModal").modal("show");
        if ($("#editYearAlumnus").length) {
          $("#editYearAlumnus").validate({
            rules: {
              siswa_lulus_tahunajaran_id: {
                required: true,
              },
            },
          });
        }
        $("#editYearAlumnus").submit(function () {
          if ($("#editYearAlumnus").valid())
            $.ajax({
              type: "POST",
              url: "Students/Models/cruds-alumnus.php?pg=edit_tahunalumni",
              data: $(this).serialize(),
              success: function (data) {
                $("#yearsModal").modal("hide");
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
                  dtStudentsAlumnus.DataTable().ajax.reload();
                }
              },
            });
          else
            Swal.fire({
              title: "Warning!",
              text: "Kolom Input Isian Belum Lengkap",
              icon: "info",
              customClass: {
                confirmButton: "btn btn-info",
              },
              buttonsStyling: false,
            });
          return false;
        });
      }
    });
    $(".checkBoxAll").click(function () {
      $(".ckeckBoxId").prop("checked", this.checked);
      if ($(this).is(":checked")) {
        $(".check").addClass("removeRow");
      } else {
        $(".check").removeClass("removeRow");
      }
    });
  });
});
