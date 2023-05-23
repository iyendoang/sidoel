$(function () {
  ("use strict");
  var dtStudentsAlumnus = $(".studentsAlumnus-list-table"),
    userView = "Students/Models/",
    assetPath = "Students/Models/";
  // Users List datatable
  if (dtStudentsAlumnus.length) {
    dtStudentsAlumnus.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: assetPath + "fetch-masters-students.php",
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
        { data: "siswa_nama" },
        { data: "siswa_nis" },
        { data: "siswa_gender" },
        { data: "tingkat_nama" },
        { data: "siswa_nisn" },

      ],
      columnDefs: [
        {
          targets: 1,
          orderable: false,
          render: function (data, type, full, meta) {
            return full["check_siswa_id"];
          },
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $siswa_nama_bold = full["siswa_nama_bold"],
              $siswa_avatar = full["siswa_avatar"],
              $siswa_nisn = full["siswa_nisn"],
              $siswa_nis = full["siswa_nis"],
              $row_output =
                '<div class="d-flex justify-content-left align-items-center">' +
                '<div class="avatar-wrapper">' +
                '<div class="avatar bg-danger' +
                ' me-1">' +
                $siswa_avatar +
                '</div>' +
                '</div>' +
                '<div class="d-flex flex-column">' +
                '<a href="' +
                userView +
                '" class="user_name text-body text-truncate"><span class="fw-bolder">' +
                $siswa_nama_bold +
                '</span></a>' +
                '<small class="emp_post text-muted">' +
                $siswa_nis + '/' + $siswa_nisn
            '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          targets: 4,
          orderable: true,
          render: function (data, type, full, meta) {
            var kelas_id = full["kelas_id"],
              mutat = full["siswa_alasan_mutasi"],
              tingkat_nama = full["tingkat_nama"],
              kelas_nama = full["kelas_nama"];
            if (kelas_id > 1 && mutat == null) {
              return (
                '<a href="#" class="btn btn-sm btn-primary btn-block">' +
                tingkat_nama +
                "-" +
                kelas_nama +
                "</a>"
              );
            } else if (kelas_id > 1 && mutat != null) {
              return '<a href="#" class="btn btn-sm btn-danger btn-block">Mutasi</a>';
            } else {
              return '<a href="#" class="btn btn-sm btn-success btn-block">Alumni</a>';
            }
          },
        },
        {
          targets: 5,
          orderable: true,
          render: function (data, type, full, meta) {
            var siswa_edit_status = full["siswa_edit_status"],
              siswa_id = full["siswa_id"];
            if (siswa_edit_status == 1) {
              return (
                '<button data-id="' +
                siswa_id +
                '" type="button" class="btn btn-sm btn-icon btn-success me-1 writeStudents" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Unactivated">' +
                feather.icons["check"].toSvg({ class: "font-medium-2" }) +
                "</button>" +
                '<button type="button" data-id="' +
                siswa_id +
                '" class="btn btn-sm btn-icon btn-danger deleteStudents" >' +
                feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                "</button>"
              );
            } else {
              return (
                '<button data-id="' +
                siswa_id +
                '" type="button" class="btn btn-sm btn-icon btn-warning me-1 readStudents" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Activated">' +
                feather.icons["x"].toSvg({ class: "font-medium-2" }) +
                "</button>" +
                '<button type="button" data-id="' +
                siswa_id +
                '" class="btn btn-sm btn-icon btn-danger deleteStudents">' +
                feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                "</button>"
              );
            }
          },
        },
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
    $("#btnstudentsCardPrint").click(function () {
      var id = [];
      $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
      });
      if (id.length === 0) {
        Swal.fire({
          title: "Warning!",
          text: "Pilih minimal satu data",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
          buttonsStyling: false,
        });
        return false;
      } else {
        return true;
      }
    });
    $("#btnstudentsDetailPrint").click(function () {
      var id = [];
      $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
      });
      if (id.length === 0) {
        Swal.fire({
          title: "Warning!",
          text: "Pilih minimal satu data",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
          buttonsStyling: false,
        });
        return false;
      } else {
        return true;
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
    dtStudentsAlumnus.on("click", ".writeStudents", function () {
      var id = $(this).data("id");
      // console.log(id);
      $.ajax({
        url: "Students/Models/cruds-students-masters.php?pg=writeStudents",
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
            dtStudentsAlumnus.DataTable().ajax.reload();
          }
        },
      });
    });
    dtStudentsAlumnus.on("click", ".readStudents", function () {
      var id = $(this).data("id");
      // console.log(id);
      $.ajax({
        url: "Students/Models/cruds-students-masters.php?pg=readStudents",
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
            dtStudentsAlumnus.DataTable().ajax.reload();
          }
        },
      });
    });
    dtStudentsAlumnus.on("click", ".deleteStudents", function () {
      var id = $(this).data("id");
      // console.log(id);
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
                dtStudentsAlumnus.DataTable().ajax.reload();
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
  var uploadField = document.getElementById("lembaga_filettdkamad");
  var lembaga_filettdkamadFIle = $("#lembaga_filettdkamadImg");
  var lembaga_filettdkamadText = document.getElementById(
    "lembaga_filettdkamad-text"
  );
  var lembaga_filettdkamad = $("#lembaga_filettdkamad");
  if (lembaga_filettdkamad.length) {
    $(lembaga_filettdkamad).on("change", function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (lembaga_filettdkamadFIle.length) {
          lembaga_filettdkamadFIle.attr("src", reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
      lembaga_filettdkamadText.innerHTML = lembaga_filettdkamad.val();
    });
  }
  $(document).ready(function () {
    $("#form-lembaga_filettdkamad").on("submit", function (event) {
      event.preventDefault();
      var submitButton = $("#lembaga_filettdkamadBtn");
      $.ajax({
        url: "Institution/M_Institution_files.php?pg=Editlembaga_filettdkamad",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          submitButton.attr("disabled", true);
          if ($(submitButton).has(".fa-spinner").length === 0) {
            $(submitButton).prepend(
              '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>'
            );
          }
        },
        success: function (data) {
          var json = $.parseJSON(data);
          if (json == "ok") {
            Swal.fire({
              title: "Gambar Sedang Di Upload..!",
              html: "Harap Bersabar <b>Upload File</b> dalam Proses.",
              timer: 3000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getHtmlContainer();
                  if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 3000);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log("Proses Generate Berhasil");
              }
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else {
            Swal.fire({
              title: "Maaf",
              text: json,
              icon: "error",
              customClass: {
                confirmButton: "btn btn-danger",
              },
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          }
        },
      });
    });
  });
  var uploadField = document.getElementById("lembaga_filestempel");
  var lembaga_filestempelFIle = $("#lembaga_filestempelImg");
  var lembaga_filestempelText = document.getElementById(
    "lembaga_filestempel-text"
  );
  var lembaga_filestempel = $("#lembaga_filestempel");
  if (lembaga_filestempel.length) {
    $(lembaga_filestempel).on("change", function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (lembaga_filestempelFIle.length) {
          lembaga_filestempelFIle.attr("src", reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
      lembaga_filestempelText.innerHTML = lembaga_filestempel.val();
    });
  }
  $(document).ready(function () {
    $("#form-lembaga_filestempel").on("submit", function (event) {
      event.preventDefault();
      var submitButton = $("#lembaga_filestempelBtn");
      $.ajax({
        url: "Institution/M_Institution_files.php?pg=Editlembaga_filestempel",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          submitButton.attr("disabled", true);
          if ($(submitButton).has(".fa-spinner").length === 0) {
            $(submitButton).prepend(
              '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>'
            );
          }
        },
        success: function (data) {
          var json = $.parseJSON(data);
          if (json == "ok") {
            Swal.fire({
              title: "Gambar Sedang Di Upload..!",
              html: "Harap Bersabar <b>Upload File</b> dalam Proses.",
              timer: 3000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getHtmlContainer();
                  if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 3000);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log("Proses Generate Berhasil");
              }
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else {
            Swal.fire({
              title: "Maaf",
              text: json,
              icon: "error",
              customClass: {
                confirmButton: "btn btn-danger",
              },
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          }
        },
      });
    });
  });
  var uploadField = document.getElementById("L_templatekartu");
  var L_templatekartuFIle = $("#L_templatekartuImg");
  var L_templatekartuText = document.getElementById("L_templatekartu-text");
  var L_templatekartu = $("#L_templatekartu");
  if (L_templatekartu.length) {
    $(L_templatekartu).on("change", function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (L_templatekartuFIle.length) {
          L_templatekartuFIle.attr("src", reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
      L_templatekartuText.innerHTML = L_templatekartu.val();
    });
  }
  $(document).ready(function () {
    $("#form-L_templatekartu").on("submit", function (event) {
      event.preventDefault();
      var submitButton = $("#L_templatekartuBtn");
      $.ajax({
        url: "Institution/M_Institution_files.php?pg=EditL_templatekartu",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          submitButton.attr("disabled", true);
          if ($(submitButton).has(".fa-spinner").length === 0) {
            $(submitButton).prepend(
              '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>'
            );
          }
        },
        success: function (data) {
          var json = $.parseJSON(data);
          if (json == "ok") {
            Swal.fire({
              title: "Gambar Sedang Di Upload..!",
              html: "Harap Bersabar <b>Upload File</b> dalam Proses.",
              timer: 3000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getHtmlContainer();
                  if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 3000);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log("Proses Generate Berhasil");
              }
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else {
            Swal.fire({
              title: "Maaf",
              text: json,
              icon: "error",
              customClass: {
                confirmButton: "btn btn-danger",
              },
            });
            setTimeout(function () {
              window.location.reload();
            }, 2000);
          }
        },
      });
    });
  });
  if ($("#form-L_tglkartupelajar").length) {
    $("#form-L_tglkartupelajar").validate({
      rules: {
        L_tglkartupelajar: {
          required: true
        },
      },
    });
  }
  $("#form-L_tglkartupelajar").submit(function () {
    if ($("#form-L_tglkartupelajar").valid())
      $.ajax({
        type: "POST",
        url: "Institution/M_Institution.php?pg=FormL_tglkartupelajar",
        data: $(this).serialize(),
        // data: new FormData(this),
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
            setTimeout(function () {
              window.location.reload();
            }, 1000);
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

});
var autoClose = $('#btn_zip');
function validateForm() {
  let x = document.forms["zipForm"]["zip_file"].value;
  console.log(x)
  if (x == "") {
    Swal.fire({
      title: 'Error!',
      text: 'Zip Photo File Tidak boleh Kosong',
      icon: 'error',
      customClass: {
        confirmButton: 'btn btn-primary'
      },
      buttonsStyling: false
    });
    return false;
  } else {
    Swal.fire({
      title: 'Hafap Bersabar!',
      icon: 'info',
      html: 'Kami akan selesai dalam <b></b> detik.',
      timer: 4000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        timerInterval = setInterval(() => {
          const content = Swal.getHtmlContainer();
          if (content) {
            const b = content.querySelector('b');
            if (b) {
              b.textContent = Swal.getTimerLeft();
            }
          }
        }, 200);
      },
      willClose: () => {
        clearInterval(timerInterval);
      }
    }).then(result => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
      }
    });
  }
}