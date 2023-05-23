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
  $.validator.addMethod("startsWithZero", function (value, element) {
    return this.optional(element) || /^0/.test(value);
  }, "Input harus diawali dengan angka nol.");
  var assetPath = "Registrations/",
    datatableRegistrations = $(".datatables-regist"),
    detailStudent = "?pg=edit-student-regist&id=",
    detailAdress = "?pg=edit-student-address&id=",
    detailParent = "?pg=edit-student-parent&id=",
    detailPrevious = "?pg=edit-student-previous-level&id=",
    createRegistrationsForm = $("#createRegistrationsForm"),
    updateRegistrationsForm = $("#updateRegistrationsForm"),
    updateAddressForm = $("#updateAddressForm"),
    updateParentForm = $("#updateParentForm"),
    updatePreviousForm = $("#updatePreviousForm");
  $(document).ready(function () {
    $.ajax({
      url: assetPath + "ClassRegistrations.php?pg=showSelectTahunajaran2",
      dataType: 'json',
      success: function (data) {
        $('#filterSelect').select2({
          data: data,
          placeholder: 'Pilih Tahun Ajaran',
          allowClear: true
        });
        loadData();
      }
    });
    function loadData() {
      // Inisialisasi DataTables
      if (datatableRegistrations.length) {
        datatableRegistrations.DataTable({
          processing: true,
          // serverSide: true,
          ajax: {
            url: assetPath + "ClassRegistrations.php?pg=showregist",
            type: 'POST',
            data: function (d) {
              // Menambahkan parameter tahunajaran_id ke URL
              var selectedValue = $('#filterSelect').val();
              if (selectedValue) {
                d.tahunajaran_id = selectedValue;
              }
              return d; // Tambahkan ini untuk mengembalikan data yang diperbarui
            }
          },
          responsive: true,
          columns: [
            { data: '' },
            { data: 'ppdbregist_id' },
            { data: 'tahunajaran_nama' },
            { data: 'ppdbregist_number' },
            { data: 'ppdbjurusan_name' }
          ],
          columnDefs: [
            {
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
              responsivePriority: 4,
              render: function (data, type, full, meta) {
                var $ppdbregist_number = full["ppdbregist_number"],
                  $tahunajaran_nama = full["tahunajaran_nama"],
                  $ppdbregist_actived = full["ppdbregist_actived"],
                  $ppdbjurusan_name = full["ppdbjurusan_name"];
                if ($ppdbregist_actived == 1) {
                  var $row_output =
                    '<div class="d-flex bg-light-success justify-content-center align-items-center">' +
                    '<div class="d-flex flex-column">' +
                    '<small class="text-nowrap fw-bolder text-dark">' +
                    $ppdbregist_number +
                    "</small></a>" +
                    '<small class="text-nowrap fw-bolder text-dark">' +
                    $tahunajaran_nama +
                    "</small>" +
                    '<small class="text-nowrap fw-bolder text-dark">' +
                    $ppdbjurusan_name +
                    "</small>" +
                    "</div>" +
                    "</div>";
                  return $row_output;
                } else {
                  var $row_output =
                    '<div class="d-flex bg-danger justify-content-center align-items-center">' +
                    '<div class="d-flex flex-column">' +
                    '<small class="text-nowrap fw-bolder text-light">' +
                    $ppdbregist_number +
                    "</small></a>" +
                    '<small class="text-nowrap fw-bolder text-light">' +
                    $tahunajaran_nama +
                    "</small>" +
                    '<small class="text-nowrap fw-bolder text-light">' +
                    $ppdbjurusan_name +
                    "</small>" +
                    "</div>" +
                    "</div>";
                  return $row_output;
                }
              },
            },
            {
              targets: 2,
              responsivePriority: 4,
              render: function (data, type, full, meta) {
                var $ppdbregist_name = full["ppdbregist_name"],
                  $ppdbregist_tempat = full["ppdbregist_tempat"],
                  $ppdbregist_tgllahir = full["ppdbregist_tgllahir"],
                  $ppdbregist_id = full["ppdbregist_id"],
                  $initials = $ppdbregist_name.match(/(\b\S)?/g).join("").match(/(^\S|\S$)?/g).join("").toUpperCase();
                var $row_output =
                  '<div class="d-flex justify-content-left align-items-center">' +
                  '<div class="avatar-wrapper">' +
                  '<div class="avatar bg-truncated me-1">' +
                  '<a href="' +
                  detailStudent +
                  $ppdbregist_id +
                  '" class="avatar-content text-dark">' + $initials + '</a>' +
                  "</div>" +
                  "</div>" +
                  '<div class="d-flex flex-column">' +
                  '<span class="user_name"><span class="fw-bolder">' +
                  $ppdbregist_name +
                  "</span></span>" +
                  '<small class="emp_post">' +
                  $ppdbregist_tempat +
                  "</small>" +
                  '<small class="emp_post fw-bolder">' +
                  $ppdbregist_tgllahir +
                  "</small>" +
                  "</div>" +
                  "</div>";
                return $row_output;
              },
            },
            {
              targets: 3,
              responsivePriority: 4,
              render: function (data, type, full, meta) {
                var $ppdbregist_nokk = full["ppdbregist_nokk"],
                  $ppdbregist_nik = full["ppdbregist_nik"],
                  $ppdbregist_nisn = full["ppdbregist_nisn"];
                var $row_output =
                  '<div class="d-flex justify-content-left align-items-center">' +
                  '<div class="d-flex flex-column">' +
                  '<span class="user_name"><span class="fw-bolder">' +
                  'NISN : ' + $ppdbregist_nisn +
                  "</span></span>" +
                  '<small class="emp_post text-nowrap">' +
                  'KK : ' + $ppdbregist_nokk +
                  "</small>" +
                  '<small class="emp_post text-nowrap">' +
                  'NIK : ' + $ppdbregist_nik +
                  "</small>" +
                  "</div>" +
                  "</div>";
                return $row_output;
              },
            },
            {
              targets: 4,
              orderable: true,
              render: function (data, type, full, meta) {
                var ppdbregist_gender = full["ppdbregist_gender"],
                  $ppdbregist_nohp = full["ppdbregist_nohp"],
                  $password = full["password"];
                if (ppdbregist_gender = 'L') {
                  return (
                    '<div class="d-flex justify-content-left align-items-center">' +
                    '<div class="d-flex flex-column text-nowrap">' +
                    '<small class="fw-truncated">' +
                    $ppdbregist_nohp +
                    '</small>' +
                    '<small class="emp_post text-nowrap">' +
                    'Laki-laki</small>' +
                    '<small class="emp_post text-danger">' +
                    'Pass: ' + $password + '</small>' +
                    '</div>' +
                    '</div>'
                  );
                } else {
                  return (
                    '<div class="d-flex justify-content-left align-items-center">' +
                    '<div class="d-flex flex-column">' +
                    '<small class="fw-truncated">' +
                    $ppdbregist_nohp +
                    '</small>' +
                    '<small class="emp_post text-nowrap">' +
                    'Perempuan</small>' +
                    '<small class="emp_post text-danger">' +
                    'Pass: ' + $password + '</small>' +
                    '</div>' +
                    '</div>'
                  );
                }
              },
            },
            {
              targets: 5,
              orderable: true,
              render: function (data, type, full, meta) {
                var ppdbregist_actived = full["ppdbregist_actived"],
                  ppdbregist_id = full["ppdbregist_id"];
                if (ppdbregist_actived == 1) {
                  return (
                    '<a href="' +
                    detailStudent +
                    ppdbregist_id +
                    '" type="button" class="btn btn-sm btn-icon btn-primary me-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Edit">' +
                    feather.icons["eye"].toSvg({ class: "font-medium-2" }) +
                    "</a>" +
                    '<button data-id="' +
                    ppdbregist_id +
                    '" type="button" class="btn btn-sm btn-icon btn-success me-25 dtUnactivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Unactivated">' +
                    feather.icons["check"].toSvg({ class: "font-medium-2" }) +
                    "</button>" +
                    '<button type="button" data-id="' +
                    ppdbregist_id +
                    '" class="btn btn-sm btn-icon btn-danger deleteRegistrations" >' +
                    feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                    "</button>"
                  );
                } else {
                  return (
                    '<a href="' +
                    detailStudent +
                    ppdbregist_id +
                    '" type="button" class="btn btn-sm btn-icon btn-primary me-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Edit">' +
                    feather.icons["eye"].toSvg({ class: "font-medium-2" }) +
                    "</a>" +
                    '<button data-id="' +
                    ppdbregist_id +
                    '" type="button" class="btn btn-sm btn-icon btn-warning me-25 dtActivated" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Untuk Activated">' +
                    feather.icons["x"].toSvg({ class: "font-medium-2" }) +
                    "</button>" +
                    '<button type="button" data-id="' +
                    ppdbregist_id +
                    '" class="btn btn-sm btn-icon btn-danger deleteRegistrations">' +
                    feather.icons["trash"].toSvg({ class: "font-medium-2" }) +
                    "</button>"
                  );
                }
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
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function (row) {
                  var data = row.data();
                  return "Details of Registrations";
                },
              }),
              type: "column",
              renderer: function (api, rowIdx, columns) {
                var data = $.map(columns, function (col, i) {
                  return col.title !== ""
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
          buttons: [
            {
              text: "Add Registrations",
              className: "add-new btn btn-primary mt-50",
              attr: {
                "data-bs-toggle": "modal",
                "data-bs-target": "#createRegistrations",
              },
              init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
              },
            },
          ],
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
    }
    $('#filterSelect').on('change', function () {
      var datatable = datatableRegistrations.DataTable();
      datatable.ajax.reload();
    });
  });

  if (createRegistrationsForm.length) {
    createRegistrationsForm.validate({
      rules: {
        tahunajaran_id: {
          required: true,
        },
        ppdbjurusan_id: {
          required: true,
        },

        ppdbregist_name: {
          required: true,
        },
        ppdbregist_gender: {
          required: true,
        },
        ppdbregist_tempat: {
          required: true,
        },
        ppdbregist_tgllahir: {
          required: true,
        },
        ppdbregist_nisn: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10,
        },
        ppdbregist_nokk: {
          required: true,
          number: true,
          minlength: 16,
          maxlength: 16,
        },
        ppdbregist_nik: {
          required: true,
          number: true,
          minlength: 16,
          maxlength: 16,
        },
        ppdbregist_nohp: {
          required: true,
          number: true,
          startsWithZero: true,
          minlength: 9,
        },
        password: {
          required: true,
        },
        password_confirm: {
          required: true,
          equalTo: "#password",
        },
      },
      messages: {
        ppdbregist_nisn: {
          required: "Confirm NISN is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 10 digit Pastikan NISN minimal 10 digit",
          maxlength: "Lebih dari 10 digit Pastikan NISN maksimal 10 digit",
        },
        ppdbregist_nokk: {
          required: "Confirm NO KK is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 16 digit Pastikan NO KK minimal 16 digit",
          maxlength: "Lebih dari 16 digit Pastikan NO KK maksimal 16 digit",
        },
        ppdbregist_nik: {
          required: "Confirm NIK is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 16 digit Pastikan NIK minimal 16 digit",
          maxlength: "Lebih dari 16 digit Pastikan NIK 16 maksimal digit",
        },
        ppdbregist_nohp: {
          required: "Confirm No HP is required",
          number: "Harus berupa angka",
          startsWithZero: "Harus diawali angka 0",
          minlength: "Kurang dari 9 digit Pastikan No HP minimanl 9 digit",
        },
        password_confirm: {
          equalTo: "Password tidak sesuai dengan input password",
        },
      },
    });
  }
  if (createRegistrationsForm) {
    createRegistrationsForm.on("submit", function (e) {
      var isValid = createRegistrationsForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Registrations/ClassRegistrations.php?pg=storeRegistrations",
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
                title: json.title_message,
                text: json.message,
                icon: "success",
                customClass: {
                  confirmButton: "btn btn-success",
                },
              });
              createRegistrationsForm[0].reset();
              $("#createRegistrations").modal("hide");
              datatableRegistrations.DataTable().ajax.reload();
            } else {
              Swal.fire({
                title: json.title_message,
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
  datatableRegistrations.on("click", ".deleteRegistrations",
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
            url: assetPath + "ClassRegistrations.php?pg=deleteRegistrations", // JSON file to add data
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
                datatableRegistrations.DataTable().ajax.reload();
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
  datatableRegistrations.on("click", ".dtUnactivated", function () {
    var id = $(this).data("id");
    // console.log(id);
    $.ajax({
      url: assetPath + "ClassRegistrations.php?pg=dtUnactivated", // JSON file to add data
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
          datatableRegistrations.DataTable().ajax.reload();
        }
      },
    });
  });
  datatableRegistrations.on("click", ".dtActivated", function () {
    var id = $(this).data("id");
    // console.log(id);
    $.ajax({
      url: assetPath + "ClassRegistrations.php?pg=dtActivated", // JSON file to add data
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
          datatableRegistrations.DataTable().ajax.reload();
        }
      },
    });
  });

  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "Registrations/ClassRegistrations.php?pg=showSelectTahunajaran",
      cache: false,
      success: function (msg) {
        $("#tahunajaran_id").html(msg);
      },
    });
  });
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "Registrations/ClassRegistrations.php?pg=showSelectJurusan",
      cache: false,
      success: function (msg) {
        $("#ppdbjurusan_id").html(msg);
      },
    });
  });
  if (updateRegistrationsForm.length) {
    updateRegistrationsForm.validate({
      rules: {
        tahunajaran_idedit: {
          required: true,
        },
        ppdbjurusan_idedit: {
          required: true,
        },

        ppdbregist_name: {
          required: true,
        },
        ppdbregist_gender: {
          required: true,
        },
        ppdbregist_tempat: {
          required: true,
        },
        ppdbregist_tgllahir: {
          required: true,
        },
        ppdbregist_nisn: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10,
        },
        ppdbregist_nokk: {
          required: true,
          number: true,
          minlength: 16,
          maxlength: 16,
        },
        ppdbregist_nik: {
          required: true,
          number: true,
          minlength: 16,
          maxlength: 16,
        },
        ppdbregist_anakke: {
          required: true,
          number: true,
          maxlength: 2,
        },
        ppdbregist_saudara: {
          required: true,
          number: true,
          maxlength: 2,
        },
        ppdbregist_hobi: {
          required: true,
        },
        ppdbregist_cita: {
          required: true,
        },
        ppdbregist_nohp: {
          required: true,
          number: true,
          minlength: 9,
        },
        password: {
          required: true,
        },
      },
      messages: {
        ppdbregist_nisn: {
          required: "Confirm NISN is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 10 digit Pastikan NISN minimal 10 digit",
          maxlength: "Lebih dari 10 digit Pastikan NISN maksimal 10 digit",
        },
        ppdbregist_nokk: {
          required: "Confirm NO KK is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 16 digit Pastikan NO KK minimal 16 digit",
          maxlength: "Lebih dari 16 digit Pastikan NO KK maksimal 16 digit",
        },
        ppdbregist_nik: {
          required: "Confirm NIK is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 16 digit Pastikan NIK minimal 16 digit",
          maxlength: "Lebih dari 16 digit Pastikan NIK 16 maksimal digit",
        },
        ppdbregist_nohp: {
          required: "Confirm No HP is required",
          number: "Harus berupa angka",
          minlength: "Kurang dari 9 digit Pastikan No HP minimanl 9 digit",
        },
        password_confirm: {
          equalTo: "Password tidak sesuai dengan input password",
        },
      },
    });
  }
  if (updateRegistrationsForm) {
    updateRegistrationsForm.on("submit", function (e) {
      var isValid = updateRegistrationsForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Registrations/ClassRegistrations.php?pg=updateRegistrations",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            // console.log(data);
            // alert(data);
            var json = $.parseJSON(data);
            if (json.status == 200) {
              Swal.fire({
                title: json.title_message,
                text: json.message,
                icon: "success",
                customClass: {
                  confirmButton: "btn btn-success",
                },
              });
              setTimeout(function () {
                // window.location.reload();
                window.location.href = detailAdress + json.idRegist;
              }, 1500);
            } else {
              Swal.fire({
                title: json.title_message,
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
  if (updateAddressForm.length) {
    updateAddressForm.validate({
      rules: {
        ppdbregist_stt: {
          required: true,
        },
        ppdbregist_prov: {
          required: true,
        },
        ppdbregist_kota: {
          required: true,
        },
        ppdbregist_kec: {
          required: true,
        },
        ppdbregist_kel: {
          required: true,
        },
        ppdbregist_alamat: {
          required: true,
        },
        ppdbregist_rt: {
          required: true,
          number: true
        },
        ppdbregist_rw: {
          required: true,
          number: true
        },
        ppdbregist_kodepos: {
          required: true,
          number: true,
          minlength: 5,
          maxlength: 5
        },
        ppdbregist_jarak: {
          required: true,
        },
        ppdbregist_transportasi: {
          required: true
        },
      }
    });
  }
  if (updateAddressForm) {
    updateAddressForm.on("submit", function (e) {
      var isValid = updateAddressForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Registrations/ClassRegistrations.php?pg=updateAddressRegist",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            // console.log(data);
            // alert(data);
            var json = $.parseJSON(data);
            if (json.status == 200) {
              Swal.fire({
                title: json.title_message,
                text: json.message,
                icon: "success",
                customClass: {
                  confirmButton: "btn btn-success",
                },
              });
              setTimeout(function () {
                // window.location.reload();
                window.location.href = detailParent + json.idRegist;
              }, 1500);
            } else {
              Swal.fire({
                title: json.title_message,
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
  $(document).ready(function () {
    $('#ppdbayah_status').on("select2:select", function (e) {
      var ppdbayah_status = $(this).val();
      // alert(ppdbayah_status);
      if (ppdbayah_status == 0) {
        $('#id_ppdbayah_status').show(600);
      } else {
        $('#id_ppdbayah_status').hide(600);
      }
    });
    $('#ppdbibu_status').on("select2:select", function (e) {
      var ppdbibu_status = $(this).val();
      // alert(ppdbibu_status);
      if (ppdbibu_status == 0) {
        $('#id_ppdbibu_status').show(600);
      } else {
        $('#id_ppdbibu_status').hide(600);
      }
    });
  });
  $(document).ready(function () {
    function readonly_select(objs, action) {
      if (action === true)
        objs.prepend('<div class="disabled-select"></div>');
      else
        $(".disabled-select", objs).remove();
    }
    $('#ppdbwali_status').on("select2:select", function (e) {
      var ppdbwali_status = $(this).val();
      if (ppdbwali_status == 1) {
        $("input[name=ppdbwali_name]").val($("input[name=ppdbayah_name]").val()).attr("readonly", true);
        $('#ppdbwali_wn').val($("#ppdbayah_wn").select2('val')).trigger('change').attr("readonly", "readonly");
        $("input[name=ppdbwali_nik]").val($("input[name=ppdbayah_nik]").val()).attr("readonly", true);
        $("input[name=ppdbwali_tempat]").val($("input[name=ppdbayah_tempat]").val()).attr("readonly", true);
        $("input[name=ppdbwali_tgllahir]").val($("input[name=ppdbayah_tgllahir]").val()).attr("readonly", true)
        $('#ppdbwali_pendidikan').val($("#ppdbayah_pendidikan").select2('val')).trigger('change').attr("readonly", "readonly");
        $('#ppdbwali_pekerjaan').val($("#ppdbayah_pekerjaan").select2('val')).trigger('change').attr("readonly", "readonly");
        $('#ppdbwali_penghasilan').val($("#ppdbayah_penghasilan").select2('val')).trigger('change').attr("readonly", "readonly");
        $("input[name=ppdbwali_nohp]").val($("input[name=ppdbayah_nohp]").val()).attr("readonly", true);
      } else if (ppdbwali_status == 2) {
        $("input[name=ppdbwali_name]").val($("input[name=ppdbibu_name]").val()).attr("readonly", true);
        $('#ppdbwali_wn').val($("#ppdbibu_wn").select2('val')).trigger('change').attr("readonly", "readonly");
        $("input[name=ppdbwali_nik]").val($("input[name=ppdbibu_nik]").val()).attr("readonly", true);
        $("input[name=ppdbwali_tempat]").val($("input[name=ppdbibu_tempat]").val()).attr("readonly", true);
        $("input[name=ppdbwali_tgllahir]").val($("input[name=ppdbibu_tgllahir]").val()).attr("readonly", true)
        $('#ppdbwali_pendidikan').val($("#ppdbibu_pendidikan").select2('val')).trigger('change').attr("readonly", "readonly");
        $('#ppdbwali_pekerjaan').val($("#ppdbibu_pekerjaan").select2('val')).trigger('change').attr("readonly", "readonly");
        $('#ppdbwali_penghasilan').val($("#ppdbibu_penghasilan").select2('val')).trigger('change').attr("readonly", "readonly");
        $("input[name=ppdbwali_nohp]").val($("input[name=ppdbibu_nohp]").val()).attr("readonly", true);
      } else if (ppdbwali_status == 3) {
        $("input[name=ppdbwali_name]").val(null).removeAttr("readonly", true);
        $('#ppdbwali_wn').val(null).trigger('change').removeAttr("readonly", "readonly");
        $("input[name=ppdbwali_nik]").val(null).removeAttr("readonly", true);
        $("input[name=ppdbwali_tempat]").val(null).removeAttr("readonly", true);
        $("input[name=ppdbwali_tgllahir]").val(null).removeAttr("readonly", true)
        $('#ppdbwali_pendidikan').val(null).trigger('change').removeAttr("readonly", "readonly");
        $('#ppdbwali_pekerjaan').val(null).trigger('change').removeAttr("readonly", "readonly");
        $('#ppdbwali_penghasilan').val(null).trigger('change').removeAttr("readonly", "readonly");
        $("input[name=ppdbwali_nohp]").val(null).removeAttr("readonly", true);
      }
    });
  });
  $(document).ready(function () {
    $('#ppdbibu_status').on("select2:select", function (e) {
      var dropdown = $('#ppdbwali_status'),
        ppdbibu_status = $(this).val();
      if (ppdbibu_status == 0) {
        dropdown.children('option[value="' + 2 + '"]').removeAttr("disabled", true);
      } else {
        dropdown.children('option[value="' + 2 + '"]').prop("disabled", true);
      }
    });
    $('#ppdbayah_status').on("select2:select", function (e) {
      var dropdown = $('#ppdbwali_status'),
        ppdbayah_status = $(this).val();
      if (ppdbayah_status == 0) {
        dropdown.children('option[value="' + 1 + '"]').removeAttr("disabled", true);
      } else {
        dropdown.children('option[value="' + 1 + '"]').prop("disabled", true);
      }
    });
  });
  if (updateParentForm.length) {
    updateParentForm.validate({
      rules: {
        ppdbayah_status: {
          required: true,
        },
        ppdbayah_name: {
          required: true,
        },
        ppdbayah_nik: {
          number: true,
          minlength: 16,
          maxlength: 16
        },
        ppdbayah_nohp: {
          number: true,
        },
        ppdbibu_status: {
          required: true,
        },
        ppdbibu_name: {
          required: true,
        },
        ppdbibu_nik: {
          number: true,
          minlength: 16,
          maxlength: 16
        },
        ppdbibu_nohp: {
          number: true,
        },
        ppdbwali_status: {
          required: true,
        },
        ppdbwali_name: {
          required: true,
        },
        ppdbwali_nik: {
          number: true,
          minlength: 16,
          maxlength: 16
        },
        ppdbwali_nohp: {
          number: true,
        },
      }
    });
  }
  if (updateParentForm) {
    updateParentForm.on("submit", function (e) {
      var isValid = updateParentForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Registrations/ClassRegistrations.php?pg=updateParentRegist",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            // console.log(data);
            // alert(data);
            var json = $.parseJSON(data);
            if (json.status == 200) {
              Swal.fire({
                title: json.title_message,
                text: json.message,
                icon: "success",
                customClass: {
                  confirmButton: "btn btn-success",
                },
              });
              setTimeout(function () {
                window.location.reload();
                window.location.href = detailPrevious + json.idRegist;
              }, 1500);
            } else {
              Swal.fire({
                title: json.title_message,
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
  if (updatePreviousForm.length) {
    updatePreviousForm.validate({
      rules: {
        ppdbasal_jenjang: {
          required: true,
        },
        ppdbasal_status: {
          required: true,
        },
        ppdbasal_npsn: {
          required: true,
          number: true,
          maxlength: 8
        },
        ppdbasal_sekolah: {
          required: true,
        },
        ppdbasal_kota: {
          required: true,
        },
        ppdbasal_tahun: {
          required: true,
        },
        ppdbasal_noujian: {
          required: true,
        },
        ppdbasal_noijazah: {
          required: true,
        },
      }
    });
  }
  if (updatePreviousForm) {
    updatePreviousForm.on("submit", function (e) {
      var isValid = updatePreviousForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Registrations/ClassRegistrations.php?pg=updatePreviousRegist",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            // console.log(data);
            // alert(data);
            var json = $.parseJSON(data);
            if (json.status == 200) {
              Swal.fire({
                title: json.title_message,
                text: json.message + " Data anda telah lengkap",
                icon: "success",
                customClass: {
                  confirmButton: "btn btn-success",
                },
              });
              setTimeout(function () {
                window.location.reload();
                window.location.href = detailPrevious + json.idRegist;
              }, 1500);
            } else {
              Swal.fire({
                title: json.title_message,
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
  $('#reloadButton').on('click', function () {
    window.location.reload();
  });
  $(document).ready(function () {
    $(".printXLS").click(function () {
      var tahunajaran_id = 1;

      $.ajax({
        url: 'Registrations/Components/XlsRegister.php?tahunajaran_id=' + tahunajaran_id,
        method: "GET",
        dataType: "json",
        success: function (response) {
          var filename = response.filename;
          var filepath = response.filepath;

          var a = document.createElement('a');
          var filename = response.filename;
          var downloadUrl = 'Registrations/Components/Download/' + filename;
          var filepath = downloadUrl;
          window.location.href = downloadUrl;
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);

          $.ajax({
            url: "Registrations/ClassRegistrations.php?pg=deletePatchExcel",
            method: "POST",
            data: {
              filepath: filepath
            },
            success: function () {
              console.log("File dihapus.");
            },
            error: function () {
              console.log("Gagal menghapus file.");
            }
          });
        },
        error: function () {
          console.log("Gagal mengunduh file Excel.");
        }
      });
    });
  });

  setTimeout(() => {
    $("#filterSelect .form-select").removeClass("form-select-sm");
  }, 300);
});
