$(function () {
  "use strict";
  var select = $(".select2"),
    picker = $(".picker"),
    formActivityStudents = $("#formEditActivity");
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this
      .select2({
        placeholder: "Select value",
        dropdownParent: $this.parent(),
      })
      .change(function () {
        $(this).valid();
      });
  });
  if (picker.length) {
    picker.flatpickr({
      allowInput: true,
      onReady: function (selectedDates, dateStr, instance) {
        if (instance.isMobile) {
          $(instance.mobileInput).attr("step", null);
        }
      },
    });
  }
  if (formActivityStudents.length) {
    formActivityStudents.validate({
      rules: {
        siswa_nama: {
          required: true,
        },
        siswa_tempat: {
          required: true,
        },
        siswa_tgllahir: {
          required: true,
        },
        siswa_gender: {
          required: true,
        },
        siswa_act_hobi: {
          required: true,
        },
        siswa_act_cita: {
          required: true,
        },
        siswa_act_abk: {
          required: true,
        },
        siswa_act_disability: {
          required: true,
        },
        siswa_telpon: {
          number: true,
          minlength: 10,
          maxlength: 15,
        },
      },
    });
  }
  if (formActivityStudents) {
    formActivityStudents.submit(function () {
      var $caption = formActivityStudents.html(); // We store the html content of the submit button
      if (formActivityStudents.valid())
        $.ajax({
          type: "POST",
          url: "Students/Models/M_Students.php?pg=formEditActivity",
          data: $(this).serialize(),
          // data: new FormData(this),
          beforeSend: function () {
            //We add this before send to disable the button once we submit it so that we prevent the multiple click
            formActivityStudents.attr("disabled", true).html("Processing...");
          },
          success: function (data) {
            formActivityStudents.attr("disabled", false).html($caption);
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
  }
});
