$(document).ready(function () {
    select = $('.select2');
    select.each(function () {
        var $this = $(this);
        cardSection = $('#card-block'),
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
    $("#form-edit_istitution_detail").validate({
        ignore: ":hidden",
        rules: {
            jenjang_id: {
                required: true,
            },
            lembaga_status: {
                required: true,
            },
            lembaga_tgl_siop: {
                required: true,
            },
            lembaga_siopstatus: {
                required: true,
            },
            lembaga_akre: {
                required: true,
            },
            lembaga_nilai_akre: {
                required: true,
                number: true,
            },
            lembaga_tgl_akre: {
                required: true,
            },
            lembaga_tgl_akre_end: {
                required: true,
            },
            lembaga_no_akre: {
                required: true,
            },
            lembaga_thnberdiri: {
                required: true,
            },
            lembaga_npwp: {
                required: true,
            },
            lembaga_link_rdm: {
                required: true,
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: 'Institution/M_Institution.php?pg=edit_istitution_detail',
                data: $(form).serialize(),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 200) {
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }else{
                        Swal.fire({
                            title: 'Oooh No!!!',
                            text: obj.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                }
               
            });
            return false; // required to block normal submit since you used ajax
        }
    });
    $("#form-editAddress").validate({
        ignore: ":hidden",
        rules: {
            lembaga_provinsi: {
                required: true,
            },
            lembaga_kota: {
                required: true,
            },
            lembaga_kec: {
                required: true,
            },
            lembaga_kel: {
                required: true,
            },
            lembaga_alamat: {
                required: true,
            },
            lembaga_rt: {
                required: true,
                number: true
            },
            lembaga_rw: {
                required: true,
                number: true
            },
            lembaga_kodepos: {
                required: true,
                number: true,
                maxlength: 5,
                minlength: 5
            },
            lembaga_notelp: {
                required: true,
                number: true
            },
            lembaga_email: {
                required: true,
                email: true
            },

        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: 'Institution/M_Institution.php?pg=editAddress',
                data: $(form).serialize(),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 200) {
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }else{
                        Swal.fire({
                            title: 'Oooh No!!!',
                            text: obj.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
    $("#form-editLeader").validate({
        ignore: ":hidden",
        rules: {
            lembaga_kamad: {
                required: true,
            },
            lembaga_nip_kamad: {
                required: true,
                maxlength: 30
            },
            lembaga_kamad_notelp: {
                required: true,
                maxlength: 20,
                minlength: 9
            },
            lembaga_operator: {
                required: true,
            },
            lembaga_nip_operator: {
                required: true,
                maxlength: 30
            },
            lembaga_operator_notelp: {
                required: true,
                maxlength: 20,
                minlength: 9
            },
            lembaga_pengawas: {
                required: true,
            },
            lembaga_nip_pengawas: {
                required: true,
                maxlength: 30
            },
            lembaga_kasie: {
                required: true,
            },
            lembaga_nip_kasie: {
                required: true,
                maxlength: 30
            },
            lembaga_komite: {
                required: true,
            },
            lembaga_nip_komite: {
                required: true,
                maxlength: 30
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: 'Institution/M_Institution.php?pg=editLeader',
                data: $(form).serialize(),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 200) {
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }else{
                        Swal.fire({
                            title: 'Oooh No!!!',
                            text: obj.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
    $("#form-editFoundation").validate({
        ignore: ":hidden",
        rules: {
            LY_noakta: {
                required: true,
            },
            LY_tglakta: {
                required: true,
            },
            LY_namanotaris: {
                required: true,
            },
            LY_noakta_update: {
                required: true,
            },
            LY_tglakta_update: {
                required: true,
            },
            LY_namaakta_update: {
                required: true,
            },
            LY_sk_kemenkumham: {
                required: true,
            },
            LY_tgl_kemenkumham: {
                required: true,
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: 'Institution/M_Institution.php?pg=editFoundation',
                data: $(form).serialize(),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 200) {
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }else{
                        Swal.fire({
                            title: 'Oooh No!!!',
                            text: obj.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});