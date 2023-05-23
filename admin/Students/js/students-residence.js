$(function () {
    'use strict';
    var select = $('.select2'),
        picker = $('.picker'),
        FormEditResidenceForms = $('#FormEditResidence');
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
    if (FormEditResidenceForms.length) {
        FormEditResidenceForms.validate({
            rules: {
                siswa_dom_statusrumah: {
                    required: true,
                },
                siswa_dom_jarak: {
                    required: true,
                },
                siswa_dom_waktu: {
                    required: true,
                },
                siswa_dom_transportasi: {
                    required: true,
                },
                siswa_dom_statusalamat: {
                    required: true,
                },
                siswa_dom_provinsi: {
                    required: true,
                },
                siswa_dom_kota: {
                    required: true,
                },
                siswa_dom_kecamatan: {
                    required: true,
                },
                siswa_dom_kelurahan: {
                    required: true,
                },
                siswa_dom_alamat: {
                    required: true,
                },
                siswa_dom_rt: {
                    required: true,
                },
                siswa_dom_rw: {
                    required: true,
                },
                siswa_dom_kodepos: {
                    required: true,
                },
                ayah_dom_statusalamat: {
                    required: true,
                },
                ayah_dom_provinsi: {
                    required: true,
                },
                ayah_dom_kota: {
                    required: true,
                },
                ayah_dom_kecamatan: {
                    required: true,
                },
                ayah_dom_kelurahan: {
                    required: true,
                },
                ayah_dom_alamat: {
                    required: true,
                },
                ayah_dom_rt: {
                    required: true,
                },
                ayah_dom_rw: {
                    required: true,
                },
                ayah_dom_kodepos: {
                    required: true,
                },
                ibu_dom_statusalamat: {
                    required: true,
                },
                ibu_dom_provinsi: {
                    required: true,
                },
                ibu_dom_kota: {
                    required: true,
                },
                ibu_dom_kecamatan: {
                    required: true,
                },
                ibu_dom_kelurahan: {
                    required: true,
                },
                ibu_dom_alamat: {
                    required: true,
                },
                ibu_dom_rt: {
                    required: true,
                },
                ibu_dom_rw: {
                    required: true,
                },
                ibu_dom_kodepos: {
                    required: true,
                },
                wali_dom_statusalamat: {
                    required: true,
                },
                wali_dom_provinsi: {
                    required: true,
                },
                wali_dom_kota: {
                    required: true,
                },
                wali_dom_kecamatan: {
                    required: true,
                },
                wali_dom_kelurahan: {
                    required: true,
                },
                wali_dom_alamat: {
                    required: true,
                },
                wali_dom_rt: {
                    required: true,
                },
                wali_dom_rw: {
                    required: true,
                },
                wali_dom_kodepos: {
                    required: true,
                },
            },
        });
    }
    FormEditResidenceForms.submit(function () {
        if (FormEditResidenceForms.valid())
            $.ajax({
                type: 'POST',
                url: 'Students/Models/cruds-residence.php?pg=FormEditResidenceEdit',
                data: $(this).serialize(),
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

});
// $(document).ready(function () {
//     function readonly_select(objs, action) {
//         if (action === true)
//             objs.prepend('<div class="disabled-select"></div>');
//         else
//             $(".disabled-select", objs).remove();
//     }
//     $('#siswa_dom_statusalamat').on("select2:select", function (e) {
//         // $('body').on("change", "#siswa_dom_statusalamat", function () {
//         var siswa_id_kota = $('#siswa_id_kota').val(),
//             siswa_dom_statusalamat = $(this).val();
//         $.ajax({
//             type: 'GET',
//             url: 'cruds_temp/siswa_dom_statusalamat.php',
//             data: 'siswa_id_kota=' + siswa_id_kota,
//             success: function (response) {
//                 var json = response,
//                     obj = JSON.parse(json);
//                 // console.log(obj.siswa_kk_provinsi)
//                 // console.log(obj.siswa_kk_kota)
//                 // console.log(obj.siswa_kk_kecamatan)
//                 // console.log(obj.siswa_kk_kelurahan)
//                 // console.log(obj.siswa_kk_alamat)
//                 // console.log(obj.siswa_kk_rt)
//                 // console.log(obj.siswa_kk_rw)
//                 // console.log(obj.siswa_kk_kodepos)
//                 console.log(obj)
//                 if (siswa_dom_statusalamat == 2) {
//                     $('#siswa_dom_provinsi').val(obj.siswa_kk_provinsi).trigger("change");
//                     $("#siswa_dom_kota").querySelectorAll('option')[obj.siswa_kk_kecamatan].selected = 'selected';
//                     $("#siswa_dom_kecamatan").html(obj.siswa_kk_kecamatan);
//                     $('#siswa_dom_kelurahan').val(obj.siswa_kk_kelurahan).trigger('change', 'selected').attr("readonly", "readonly");
//                     $("input[name=siswa_dom_alamat]").val(obj.siswa_kk_alamat).attr("readonly", true);
//                     $("input[name=siswa_dom_rt]").val(obj.siswa_kk_rt).attr("readonly", true);
//                     $("input[name=siswa_dom_rw]").val(obj.siswa_kk_rw).attr("readonly", true);
//                     $("input[name=siswa_dom_kodepos]").val(obj.siswa_kk_kodepos).attr("readonly", true);
//                     // } else if (siswa_dom_statusalamat == 2) {
//                     // } else if (siswa_dom_statusalamat == 3) {
//                     // $("input[name=wali_kk_nama]").val(null).removeAttr("readonly", true);
//                     // $('#wali_kk_wn').val(null).trigger('change').removeAttr("readonly", "readonly");
//                 }
//             }
//         });
//     });
// });
