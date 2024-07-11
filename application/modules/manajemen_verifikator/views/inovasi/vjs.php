<?= $this->asset->js('plugins/tinymce/tinymce.min.js'); ?>
<?= $this->asset->js('addons/setting.tinymce.js'); ?>

<?php
$id_tahapan_inovasi = $this->uri->segment(4, 0);
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        getDataListInovasi();
    });

    $(document).on('click', '.btnFilter', function(e) {
        $('#formFilter').slideToggle('slow');
        $('form#formFilter').trigger('reset');
        $('form#formFilter .select-all').select2().val('').trigger("change");
    });

    $(document).on('click', '#cancel', function(e) {
        e.preventDefault();
        $('#formFilter').slideToggle('slow');
        $('form#formFilter').trigger('reset');
        $('form#formFilter .select-all').select2().val('').trigger("change");
        getDataListInovasi();
    });
    $('#formFilter').submit(function(e) {
        e.preventDefault();
        getDataListInovasi();
    });

    function getDataListInovasi() {
        $('#tblList').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing": true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "stateSave": true,
            "ordering": false,
            "ajax": {
                "url": site + '/listview',
                "type": "POST",
                "data": {
                    "param": $('#formFilter').serializeArray(),
                    "id_tahapan_inovasi": <?php echo $id_tahapan_inovasi; ?>,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": $('input[name="' + csrfName + '"]').val()
                },
            },
            "columnDefs": [{
                    "targets": [0], //first column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
                {
                    "targets": [-1, -2], //last column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
            ],
        });
        $('#tblList_filter input').addClass('form-control').attr('placeholder', 'Search Data');
        $('#tblList_length select').addClass('form-control');
    }

    $(document).on('change', '#tblList > tbody input[type=checkbox]', function(e) {
        const rowCount = $('#tblList > tbody input[type=checkbox]').length;
        const n = $('#tblList > tbody input[type=checkbox]').filter(':checked').length;
        if (n > 0)
            $('#btnDelete').show();
        else
            $('#btnDelete').hide();

        if (rowCount == n)
            $('#checkAll').prop('checked', 'checked');
        else
            $('#checkAll').prop('checked', '');
    });

    //panggil form Entri
    $(document).on('click', '#btnAdd', function(e) {
        formReset();
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
    });
    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        formReset();
        $('#modalEntryForm').modal('toggle');
    });

    $(document).on('click', '.btnCloseUploadHasil', function(e) {
        formReset();
        $('#modalEntryFormUploadHasil').modal('toggle');
    });

    $(document).on('click', '.btnClosePermohonan', function(e) {
        formReset();
        $('#modalEntryFormPermohonan').modal('toggle');
    });

    $(document).on('click', '.btnClosePengirim', function(e) {
        formReset();
        $('#modalEntryFormPengirim').modal('toggle');
    });

    $(document).on('submit', '#formEntry', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntry')[0];
        let formActionURL = $(this).attr("action");
        $("#save").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#save").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntry'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: formActionURL,
                    mimeType: "multipart/form-data",
                    type: "POST",
                    data: new FormData(form),
                    dataType: "json",
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        $('#formEntry').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntry').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmEntry').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntry').waitMe('hide');
                        $('#modalEntryForm').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                newKode = data.kode;
                                $('#errSuccess').html(msg.success(data.message));
                                getDataListInovasi();
                            }
                        })
                    }
                }).fail(function() {
                    $('#errEntry').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmEntry').waitMe('hide');
                }).always(function() {
                    $("#save").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#save").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntry').waitMe('hide');
                        $("#save").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#save").removeClass('disabled');
                    }
                })
            }
        })
    });

    $(document).on('click', '.btnEdit', function(e) {
        formReset();
        $('#formEntry').attr('action', site + '/update');
        var token = $(this).data('id');
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        getDataKontrol(token);
    });

    function getDataKontrol(token) {
        // $(".idTahapanInovasi").removeClass('active');
        // $(".idInisiatorInovasi").removeClass('active');
        // $(".idJenisInovasi").removeClass('active');
        run_waitMe($('#frmEntry'));
        $.ajax({
            type: 'POST',
            url: site + '/details',
            data: {
                'token': token,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token);
                    $.each(data.message.nama_file, function(key, value) {
                        $('#tes_' + key + '').html(value);
                    });
                    $('#nama_inovasi').val(data.message.nama_inovasi);
                    $('input[type="radio"][name="id_tahapan_inovasi"][value="' + data.message.type_tahapan + '"]').prop('checked', true);
                    $('input[type="radio"][name="id_inisiator_inovasi"][value="' + data.message.type_inisiator + '"]').prop('checked', true);
                    $('input[type="radio"][name="id_jenis_inovasi"][value="' + data.message.type_jenis + '"]').prop('checked', true);
                    // $('input[type="radio"][value="' + data.message.id_tahapan_inovasi + '"]').parent('.btn').addClass('active');
                    // $('input[type="radio"][value="' + data.message.id_inisiator_inovasi + '"]').parent('.btn').addClass('active');
                    // $('input[type="radio"][value="' + data.message.id_jenis_inovasi + '"]').parent('.btn').addClass('active');
                    $('#id_bentuk_inovasi').select2().val(data.message.id_bentuk_inovasi).trigger("change");
                    $('#id_tematik').select2().val(data.message.id_tematik).trigger("change");
                    $('#id_urusan_utama').select2().val(data.message.id_urusan_utama).trigger("change");
                    $('#id_urusan_lainnya').select2().val(data.message.id_urusan_lainnya).trigger("change");
                    $('#waktu_uji_coba').val(data.message.waktu_uji_coba);
                    $('#waktu_penerapan').val(data.message.waktu_penerapan);
                    tinymce.get('rancang_bangun').setContent(data.message.rancang_bangun);
                    tinymce.get('rancang_perbaikan').setContent(data.message.rancang_perbaikan);
                    $('#status_inovasi').select2().val(data.message.status_inovasi).trigger("change");
                }
                $('#frmEntry').waitMe('hide');
            }
        });
    }

    $(document).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        let postData = {
            'tokenId': $(this).data('id'),
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        $(this).html('<i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i>');
        $(this).addClass('disabled');
        run_waitMe($('#formParent'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menghapus data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/delete',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Hapus',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccess').html(msg.error(data.message));
                            }
                        })
                    } else {
                        swalAlert.fire({
                            title: 'Berhasil Hapus',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                getDataListInovasi();
                            }
                        })
                    }
                    $('#formParent').waitMe('hide');
                }).fail(function() {
                    $('#errSuccess').html(msg.error('Harap periksa kembali data yang akan dihapus'));
                    $('#formParent').waitMe('hide');
                }).always(function() {
                    $('.btnDelete').html('<i class="fas fa-trash-alt"></i>');
                    $('.btnDelete').removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Hapus',
                    text: 'Proses hapus data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#formParent').waitMe('hide');
                        $('.btnDelete').html('<i class="fas fa-trash-alt"></i>');
                        $('.btnDelete').removeClass('disabled');
                    }
                })
            }
        })
    });

    //------------------------------- MENGUPLOAD DOKUMEN HASIL UJI COBA ------------------------------------------//
    $(document).on('click', '.btnUploadHasil', function(e) {
        formReset();
        $('#formEntryUploadHasil').attr('action', site + '/createUploadHasil');
        var token = $(this).data('id');
        // alert(token);
        $('#modalEntryFormUploadHasil').modal({
            backdrop: 'static'
        });
        getDataIndikatorUploadHasil(token);
    });

    function getDataIndikatorUploadHasil(token) {
        run_waitMe($('#frmEntryUploadHasil'));
        $.ajax({
            type: 'POST',
            url: site + '/detailUploadHasil',
            data: {
                'token': token,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token);
                }
                $('#frmEntryUploadHasil').waitMe('hide');
            }
        });
    }

    $(document).on('submit', '#formEntryUploadHasil', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntryUploadHasil')[0];
        let formActionURL = $(this).attr("action");
        $("#saveUploadHasil").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#saveUploadHasil").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntryUploadHasil'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: formActionURL,
                    mimeType: "multipart/form-data",
                    type: "POST",
                    data: new FormData(form),
                    dataType: "json",
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        $('#formEntryUploadHasil').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntryUploadHasil').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmEntryUploadHasil').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntryUploadHasil').waitMe('hide');
                        $('#modalEntryForm').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                newKode = data.kode;
                                $('#errSuccess').html(msg.success(data.message));
                                // getDataListInovasi();
                                window.location.reload();
                            }

                        })
                    }
                }).fail(function() {
                    $('#errEntryUploadHasil').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmEntryUploadHasil').waitMe('hide');
                }).always(function() {
                    $("#saveUploadHasil").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#saveUploadHasil").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntryUploadHasil').waitMe('hide');
                        $("#saveUploadHasil").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#saveUploadHasil").removeClass('disabled');
                    }
                })
            }
        })
    });
    //------------------------------- MENGUPLOAD DOKUMEN HASIL UJI COBA ------------------------------------------//

    //-------------------------- MENGAJUKAN NOMOR REGISTRASI KE BALITBANG PROVINSI -------------------------------//
    $(document).on('click', '.btnPermohonan', function(e) {
        formReset();
        $('#formEntryPermohonan').attr('action', site + '/createPermohonan');
        var token = $(this).data('id');
        // alert(token);
        $('#modalEntryFormPermohonan').modal({
            backdrop: 'static'
        });
        getDataIndikatorPermohonan(token);
    });

    function getDataIndikatorPermohonan(token) {
        run_waitMe($('#frmEntryPermohonan'));
        $.ajax({
            type: 'POST',
            url: site + '/detailPermohonan',
            data: {
                'token': token,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token);
                }
                $('#frmEntryPermohonan').waitMe('hide');
            }
        });
    }

    $(document).on('submit', '#formEntryPermohonan', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntryPermohonan')[0];
        let formActionURL = $(this).attr("action");
        $("#savePermohonan").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#savePermohonan").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntryPermohonan'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: formActionURL,
                    mimeType: "multipart/form-data",
                    type: "POST",
                    data: new FormData(form),
                    dataType: "json",
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        $('#formEntryPermohonan').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntryPermohonan').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmEntryPermohonan').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntryPermohonan').waitMe('hide');
                        $('#modalEntryForm').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                newKode = data.kode;
                                $('#errSuccess').html(msg.success(data.message));
                                // getDataListInovasi();
                                window.location.reload();
                            }

                        })
                    }
                }).fail(function() {
                    $('#errEntryPermohonan').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmEntryPermohonan').waitMe('hide');
                }).always(function() {
                    $("#savePermohonan").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#savePermohonan").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntryPermohonan').waitMe('hide');
                        $("#savePermohonan").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#savePermohonan").removeClass('disabled');
                    }
                })
            }
        })
    });

    $(document).on('click', '.btnPengirim', function(e) {
        formReset();
        $('#formEntryPengirim').attr('action', site + '/createPengirim');
        var token = $(this).data('id');
        // alert(token);
        $('#modalEntryFormPengirim').modal({
            backdrop: 'static'
        });
        getDataIndikatorPengirim(token);
    });

    function getDataIndikatorPengirim(token) {
        run_waitMe($('#frmEntryPengirim'));
        $.ajax({
            type: 'POST',
            url: site + '/detailPengirim',
            data: {
                'token': token,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token);
                    $("#nama_lengkap_pengirim").text(data.message.nama_lengkap);
                    $("#jabatan_pengirim").text(data.message.jabatan);
                    $("#instansi_pengirim").text(data.message.instansi);
                    $("#no_hp_pengirim").text(data.message.no_hp);
                    $("#email_pengirim").text(data.message.email);
                }
                $('#frmEntryPengirim').waitMe('hide');
            }
        });
    }
    //-------------------------- MENGAJUKAN NOMOR REGISTRASI KE BALITBANG PROVINSI -------------------------------//
</script>