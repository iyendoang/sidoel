$(function () {
    'use strict';
    var formEditImmunization = $('#FormEditKesehatan'),
        formAddImmunization = $('#FormModalAddImmunization');
    if (formEditImmunization) {
        formEditImmunization.submit(function () {
            if (formEditImmunization.valid())
                $.ajax({
                    type: 'POST',
                    url: 'Students/Models/cruds-immunization.php?pg=FormEditKesehatanEdit',
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
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
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
    }
    if (formAddImmunization) {
        formAddImmunization.submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'Students/Models/cruds-immunization.php?pg=FormModalAddImmunizationAdd',
                data: $(this).serialize(),
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.status == 201) {
                        $("#FormModalAddImmunization").modal('hide');
                        Swal.fire({
                            title: 'Good job!',
                            text: obj.message,
                            icon: obj.icon,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else if (obj.status == 300) {
                        Swal.fire({
                            title: 'Error!',
                            text: obj.message,
                            icon: obj.icon,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }
                },
            });
            return false;
        });
    }
});