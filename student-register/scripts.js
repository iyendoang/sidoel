$(function () {
  "use strict";
  $.validator.addMethod("startsWithZero", function (value, element) {
    return this.optional(element) || /^0/.test(value);
  }, "Input harus diawali dengan angka nol.");
  var createAuthRegisterForm = $("#createAuthRegisterForm"),
    select = $('.select2'),
    showSelectJurusan = $("#ppdbjurusan_id"),
    loginForm = $("#loginForm"),
    showSelectTahunajaran = $("#tahunajaran_id");
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });
  if (createAuthRegisterForm.length) {
    createAuthRegisterForm.validate({
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
          startsWithZero: true,
          number: true,
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
          startsWithZero: "Harus diawali angka 0",
          number: "Harus berupa angka",
          minlength: "Kurang dari 9 digit Pastikan No HP minimanl 9 digit",
        },
        password_confirm: {
          equalTo: "Password tidak sesuai dengan input password",
        },
      },
    });
  }
  if (createAuthRegisterForm) {
    createAuthRegisterForm.on("submit", function (e) {
      var isValid = createAuthRegisterForm.valid();
      e.preventDefault();
      if (isValid) {
        $.ajax({
          url: "Controllers/C_Register.php?pg=storeControllers",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            console.log(data);
            var json = $.parseJSON(data);
            alert(data)
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
              }, 2000);
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
    $.ajax({
      type: "POST",
      url: "Controllers/C_Register.php?pg=showSelectTahunajaran",
      cache: false,
      success: function (msg) {
        showSelectTahunajaran.html(msg);
      },
    });
  });
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "Controllers/C_Register.php?pg=showSelectJurusan",
      cache: false,
      success: function (msg) {
        showSelectJurusan.html(msg);
      },
    });
  });
  if (loginForm.length) {
    loginForm.validate({
      rules: {
        ppdbregist_nisn: {
          required: true,
        },
        password: {
          required: true,
        },
      },
    });
  }
  if (loginForm) {
    loginForm.submit(function (event) {
      var isValid = loginForm.valid();
      event.preventDefault();
      if (isValid) {
        var nisn = $("#ppdbregist_nisn").val();
        var password = $("#password").val();
        $.ajax({
          type: "POST",
          url: "Controllers/C_Login.php",
          data: {
            ppdbregist_nisn: nisn,
            password: password
          },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              toastr['success'](response.message, response.title, {
                showDuration: 500,
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
              });
              setTimeout(function () {
                window.location.href = ".";
              }, 2000);
            } else {
              $('#buttonLogin').prop('disabled', false);
              toastr['error'](response.message, response.title, {
                showDuration: 500,
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
              });
            }
          },
          error: function () {
            toastr['error']("An error occurred during login.", {
              showDuration: 500,
            });
          }
        });
      }
    });
  }
});
