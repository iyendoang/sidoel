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
  var detailAdress = "?pg=edit-student-address",
    detailParent = "?pg=edit-student-parent",
    detailPrevious = "?pg=edit-student-previous-level",
    updateRegistrationsForm = $("#updateRegistrationsForm"),
    updateAddressForm = $("#updateAddressForm"),
    updateParentForm = $("#updateParentForm"),
    updatePreviousForm = $("#updatePreviousForm");

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
        $("#ppdbjurusan_alias").html(msg);
      },
    });
  });
  if (updateRegistrationsForm.length) {
    updateRegistrationsForm.validate({
      rules: {
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
        }
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
                window.location.href = detailAdress;
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
                window.location.href = detailParent;
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
                window.location.href = detailPrevious;
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
                window.location.href = detailPrevious;
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
});
