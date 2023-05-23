$(function () {
    'use strict';
    var select = $('.select2'),
        picker = $('.picker'),
        formStudentsFamilyCard = $('#form-FormSiswaKK');
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this
            .select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
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
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }
    if (formStudentsFamilyCard.length) {
        formStudentsFamilyCard.validate({
            rules: {
                siswa_kk_nomor: {
                    required: true,
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                siswa_kk_kepala: {
                    required: true,
                },
                siswa_kk_rt: {
                    required: true,
                    number: true,
                    minlength: 2,
                    maxlength: 3,
                },
                siswa_kk_rw: {
                    required: true,
                    number: true,
                    minlength: 2,
                    maxlength: 3,
                },
                siswa_kk_alamat: {
                    required: true
                },
                siswa_kk_kodepos: {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 5,
                },
                siswa_kk_provinsi: {
                    required: true
                },
                siswa_kk_kota: {
                    required: true
                },
                siswa_kk_kecamatan: {
                    required: true
                },
                siswa_kk_kelurahan: {
                    required: true
                },
                siswa_kk_nama: {
                    required: true
                },
                siswa_kk_wn: {
                    required: true
                },
                siswa_kk_nik: {
                    required: true,
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                siswa_kk_tempat: {
                    required: true
                },
                siswa_kk_tgllahir: {
                    required: true
                },
                siswa_kk_anakke: {
                    required: true,
                    number: true,
                    minlength: 1,
                    maxlength: 2,
                },
                siswa_kk_jmlsaudara: {
                    required: true,
                    number: true,
                    minlength: 1,
                    maxlength: 2,
                },
                siswa_kk_darah: {
                    required: true
                },
                ayah_kk_nama: {
                    required: true
                },
                ayah_kk_status: {
                    required: true
                },
                ayah_kk_nik: {
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                ayah_kk_hp: {
                    number: true,
                    minlength: 10,
                    maxlength: 13,
                },
                ibu_kk_nama: {
                    required: true
                },
                ibu_kk_status: {
                    required: true
                },
                ibu_kk_nik: {
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                ibu_kk_hp: {
                    number: true,
                    minlength: 10,
                    maxlength: 13,
                },
                siswa_wali_hubungan: {
                    required: true
                },
                wali_kk_nama: {
                    required: true
                },
                wali_kk_nik: {
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                wali_kk_hp: {
                    number: true,
                    minlength: 10,
                    maxlength: 13,
                },
            },
        });
    }
    formStudentsFamilyCard.submit(function () {
        if (formStudentsFamilyCard.valid())
            $.ajax({
                type: 'POST',
                url: 'Students/Models/cruds-family-card.php?pg=FormSiswaKKEdit',
                data: $(this).serialize(),
                // data: new FormData(this),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 200) {
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: obj.icon,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 1000);
                    }
                },
            });
        else
            Swal.fire({
                title: 'Warning!',
                text: 'Kolom Input Isian Belum Lengkap',
                icon: 'info',
                customClass: {
                    confirmButton: 'btn btn-info'
                },
                buttonsStyling: false
            }); return false;
    });
    $(document).ready(function () {
        $('#ayah_kk_status').on("select2:select", function (e) {
            var ayah_kk_status = $(this).val();
            if (ayah_kk_status == 0) {
                $('#id_ayah_kk_status').show(600);
            } else {
                $('#id_ayah_kk_status').hide(600);
            }
        });
    });
    $(document).ready(function () {
        $('#ibu_kk_status').on("select2:select", function (e) {
            var ayah_kk_status = $(this).val();
            if (ayah_kk_status == 0) {
                $('#id_ibu_kk_status').show(600);
            } else {
                $('#id_ibu_kk_status').hide(600);
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
        $('#siswa_wali_hubungan').on("select2:select", function (e) {
            var siswa_wali_hubungan = $(this).val();
            if (siswa_wali_hubungan == 1) {
                $("input[name=wali_kk_nama]").val($("input[name=ayah_kk_nama]").val()).attr("readonly", true);
                $('#wali_kk_wn').val($("#ayah_kk_wn").select2('val')).trigger('change').attr("readonly", "readonly");
                $("input[name=wali_kk_nik]").val($("input[name=ayah_kk_nik]").val()).attr("readonly", true);
                $("input[name=wali_kk_tempat]").val($("input[name=ayah_kk_tempat]").val()).attr("readonly", true);
                $("input[name=wali_kk_tgllahir]").val($("input[name=ayah_kk_tgllahir]").val()).attr("readonly", true)
                $('#wali_kk_pendidikan').val($("#ayah_kk_pendidikan").select2('val')).trigger('change').attr("readonly", "readonly");
                $('#wali_kk_pekerjaan').val($("#ayah_kk_pekerjaan").select2('val')).trigger('change').attr("readonly", "readonly");
                $('#wali_kk_penghasilan').val($("#ayah_kk_penghasilan").select2('val')).trigger('change').attr("readonly", "readonly");
                $("input[name=wali_kk_hp]").val($("input[name=ayah_kk_hp]").val()).attr("readonly", true);
            } else if (siswa_wali_hubungan == 2) {
                $("input[name=wali_kk_nama]").val($("input[name=ibu_kk_nama]").val()).attr("readonly", true);
                $('#wali_kk_wn').val($("#ibu_kk_wn").select2('val')).trigger('change').attr("readonly", "readonly");
                $("input[name=wali_kk_nik]").val($("input[name=ibu_kk_nik]").val()).attr("readonly", true);
                $("input[name=wali_kk_tempat]").val($("input[name=ibu_kk_tempat]").val()).attr("readonly", true);
                $("input[name=wali_kk_tgllahir]").val($("input[name=ibu_kk_tgllahir]").val()).attr("readonly", true)
                $('#wali_kk_pendidikan').val($("#ibu_kk_pendidikan").select2('val')).trigger('change').attr("readonly", "readonly");
                $('#wali_kk_pekerjaan').val($("#ibu_kk_pekerjaan").select2('val')).trigger('change').attr("readonly", "readonly");
                $('#wali_kk_penghasilan').val($("#ibu_kk_penghasilan").select2('val')).trigger('change').attr("readonly", "readonly");
                $("input[name=wali_kk_hp]").val($("input[name=ibu_kk_hp]").val()).attr("readonly", true);
            } else if (siswa_wali_hubungan == 3) {
                $("input[name=wali_kk_nama]").val(null).removeAttr("readonly", true);
                $('#wali_kk_wn').val(null).trigger('change').removeAttr("readonly", "readonly");
                $("input[name=wali_kk_nik]").val(null).removeAttr("readonly", true);
                $("input[name=wali_kk_tempat]").val(null).removeAttr("readonly", true);
                $("input[name=wali_kk_tgllahir]").val(null).removeAttr("readonly", true)
                $('#wali_kk_pendidikan').val(null).trigger('change').removeAttr("readonly", "readonly");
                $('#wali_kk_pekerjaan').val(null).trigger('change').removeAttr("readonly", "readonly");
                $('#wali_kk_penghasilan').val(null).trigger('change').removeAttr("readonly", "readonly");
                $("input[name=wali_kk_hp]").val(null).removeAttr("readonly", true);
            }
        });
    });
    $(document).ready(function () {
        // dropdown.find('[value="2"]').remove();
        // $("#siswa_wali_hubungan").children('option[value="' + $(this).val() + '"]').prop("disabled", true);
        $('#ibu_kk_status').on("select2:select", function (e) {
            var dropdown = $('#siswa_wali_hubungan'),
                ibu_kk_status = $(this).val();
            if (ibu_kk_status == 0) {
                dropdown.children('option[value="' + 2 + '"]').removeAttr("disabled", true);
            } else {
                dropdown.children('option[value="' + 2 + '"]').prop("disabled", true);
            }
        });
        $('#ayah_kk_status').on("select2:select", function (e) {
            var dropdown = $('#siswa_wali_hubungan'),
                ayah_kk_status = $(this).val();
            if (ayah_kk_status == 0) {
                dropdown.children('option[value="' + 1 + '"]').removeAttr("disabled", true);
            } else {
                dropdown.children('option[value="' + 1 + '"]').prop("disabled", true);
            }
        });
    });
});