<?= $this->asset->js('plugins/tinymce/tinymce.min.js'); ?>
<?= $this->asset->js('addons/setting.tinymce.js'); ?>
<script type="text/javascript">
    var idx = '';

    let activeTabs = 1;
    let lastValue = 0;
    const siteUri = '<?php echo site_url() . $siteUri; ?>';
    $(document).ready(function(e) {
        getDataListbencana();
        $('.select-all').select2();
        activedTabUrl();
    });

    $(document).on('click', '.btnCloseKebutuhan', function(e) {
        formReset();
        $('#modalEntryFormKebutuhan').modal('toggle');
    });

    $(document).on('click', '.btnCloseValidasiKorban', function(e) {
        formReset();
        $('#modalEntryFormValidasiKorban').modal('toggle');
    });

    $(document).on('click', '.btnCloseValidasiKerusakan', function(e) {
        formReset();
        $('#modalEntryFormValidasiKerusakan').modal('toggle');
    });

    function getDataListbencana() {
        $('#tblList').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing": true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": site + '/listview',
                "type": "POST",
                "data": {
                    "param": $('#formFilter').serializeArray(),
                    "<?php echo $this->security->get_csrf_token_name(); ?>": $('input[name="' + csrfName + '"]').val()
                },
            },
            "columnDefs": [{
                "targets": [0], //first column
                "orderable": false, //set not orderable
                "className": 'text-center'
            }, {
                "targets": [-1, -2], //last column
                "orderable": false, //set not orderable
                "className": 'text-center'
            }, ],
        });
        $('#tblList_filter input').addClass('form-control').attr('placeholder', 'Search Data');
        $('#tblList_length select').addClass('form-control');
    }

    // ------------------------------------- JAVASCRIPT PROSES KEBUTUHAN BENCANA DAERAH -------------------------//

    $(document).on('click', '.btnKebutuhan', function(e) {
        formReset();
        $('#formEntryKebutuhan').attr('action', site + '/createKebutuhan');
        var token_bencana_detail = $(this).data('id');
        $('#modalEntryFormKebutuhan').modal({
            backdrop: 'static'
        });
        getDataBencanaKebutuhan(token_bencana_detail);
    });

    function getDataBencanaKebutuhan(token_bencana_detail) {
        run_waitMe($('#frmEntryKebutuhan'));
        $.ajax({
            type: 'POST',
            url: site + '/details',
            data: {
                'token_bencana_detail': token_bencana_detail,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token_bencana_detail);
                    tinymce.get('kebutuhan_bencana').setContent(data.message.kebutuhan_bencana);
                }
                $('#frmEntryKebutuhan').waitMe('hide');
            }
        });
    }

    $(document).on('submit', '#formEntryKebutuhan', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntryKebutuhan')[0];
        let formActionURL = $(this).attr("action");
        $("#saveKebutuhan").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#saveKebutuhan").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntryKebutuhan'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin mengirimkan informasi ini ?',
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
                        $('#formEntryKebutuhan').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntryKebutuhan').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErrKebutuhan').html(value);
                                    }
                                });
                                $('#frmEntryKebutuhan').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntryKebutuhan').waitMe('hide');
                        $('#modalEntryFormKebutuhan').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                newKode = data.kode;
                                $('#errSuccessKebutuhan').html(msg.success(data.message));
                                getDataListbencana();
                            }
                        })
                    }
                }).fail(function() {
                    $('#errEntryKebutuhan').html(msg.error('Harap periksa kembali data'));
                    $('#frmEntryKebutuhan').waitMe('hide');
                }).always(function() {
                    $("#saveKebutuhan").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#saveKebutuhan").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntryKebutuhan').waitMe('hide');
                        $("#saveKebutuhan").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#saveKebutuhan").removeClass('disabled');
                    }
                })
            }
        })
    });
    // ------------------------------------- JAVASCRIPT PROSES KEBUTUHAN BENCANA DAERAH -------------------------//

    // ------------------------------------- JAVASCRIPT PROSES VALIDASI KORBAN BENCANA DAERAH -------------------------//

    $(document).on('click', '.btnValidasiKorban', function(e) {
        formReset();
        $('#formEntryValidasiKorban').attr('action', site + '/createValidasi');
        var token_bencana_detail = $(this).data('id');
        $('#modalEntryFormValidasiKorban').modal({
            backdrop: 'static'
        });
        getDataBencanaValidasiKorban(token_bencana_detail);
    });

    function getDataBencanaValidasiKorban(token_bencana_detail) {
        run_waitMe($('#frmEntryValidasiKorban'));
        $.ajax({
            type: 'POST',
            url: site + '/reviewValidasi',
            data: {
                'token_bencana_detail': token_bencana_detail,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenValidasiId"]').val(token_bencana_detail);
                }
                $('#frmEntryValidasiKorban').waitMe('hide');
                getDataListValidasiKorban(token_bencana_detail);
                idx = token_bencana_detail;
            }
        });
    }

    function getDataListValidasiKorban(token_bencana_detail) {
        $('#tblListKorban').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing": true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": site + '/listviewKorban',
                "type": "POST",
                "data": {
                    "token_bencana_detail": token_bencana_detail,
                    "param": $('#formFilter').serializeArray(),
                    "<?php echo $this->security->get_csrf_token_name(); ?>": $('input[name="' + csrfName + '"]').val()
                },
            },
            "columnDefs": [{
                    "targets": [0], //first column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
                {
                    "targets": [-1, -2, -3], //last column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
            ],
        });
        $('#tblListKorban_filter input').addClass('form-control').attr('placeholder', 'Search Data');
        $('#tblListKorban_length select').addClass('form-control');
    }

    // Handle click on "check all" control
    $(document).on('click', '#checkAllKorban', function() {
        $('#tblListKorban > tbody input[type=checkbox]').prop('checked', this.checked).trigger('change');
    });

    // Handle click on "checked" control
    $(document).on('change', '#tblListKorban > tbody input[type=checkbox]', function(e) {
        const rowCount = $('#tblListKorban > tbody input[type=checkbox]').length;
        const n = $('#tblListKorban > tbody input[type=checkbox]').filter(':checked').length;
        if (n > 0)
            $('#btnValidasiKorban').show();
        else
            $('#btnValidasiKorban').hide();

        if (rowCount == n)
            $('#checkAllKorban').prop('checked', 'checked');
        else
            $('#checkAllKorban').prop('checked', '');
    });

    $(document).on('click', '#tblListKorban > tbody > tr', function() {
        let n = $(this).find('input[type=checkbox]');
        n.prop('checked', (n.is(':checked')) ? false : true).trigger('change');
    });

    $(document).on('click', '#btnValidasiKorban', function(e) {
        e.preventDefault();
        let token = [];
        $.each($('#tblListKorban > tbody input[type=checkbox]:checked'), function() {
            token.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        $(this).html('<i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
        run_waitMe($('#formParent'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin mengupdate data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/createValidasiKorban',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Update',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccessValidasiKorban').html(msg.error(data.message)).delay(1600).fadeOut('slow');
                            }
                        })
                    } else {
                        swalAlert.fire({
                            title: 'Berhasil Update',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccessValidasiKorban').html(msg.success(data.message)).delay(1600).fadeOut('slow');
                                getDataListbencana();
                                $('#btnValidasiKorban').hide();
                                getDataListValidasiKorban(idx);
                                $("#btnValidasiKorban").html('<i class="fa fa-check"></i> Validasi');
                                $("#btnValidasiKorban").removeClass('disabled');
                            }
                        })
                    }
                    $('#formParent').waitMe('hide');
                }).fail(function() {
                    $('#errSuccessValidasiKorban').html(msg.error('Harap periksa kembali data yang akan diupdate')).delay(1600).fadeOut('slow');
                    $('#formParent').waitMe('hide');
                }).always(function() {
                    $("#btnValidasiKorban").html('<i class="fa fa-check"></i> Validasi');
                    $("#btnValidasiKorban").removeClass('disabled');
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
                        $('#btnValidasiKorban').html('<i class="fas fa-trash-alt"></i> Update Data');
                        $('#btnValidasiKorban').removeClass('disabled');
                    }
                })
            }
        })
    });

    // ------------------------------------- JAVASCRIPT PROSES VALIDASI KORBAN BENCANA DAERAH -------------------------//

    // ------------------------------------- JAVASCRIPT PROSES VALIDASI KERUSAKAN BENCANA DAERAH -------------------------//
    $(document).on('click', '.btnValidasiKerusakan', function(e) {
        formReset();
        // $('#formEntryValidasiKerusakan').attr('action', site + '/createValidasi');
        var token_bencana_detail = $(this).data('id');
        $('#modalEntryFormValidasiKerusakan').modal({
            backdrop: 'static'
        });
        getDataBencanaValidasiKerusakan(token_bencana_detail);
    });

    function getDataBencanaValidasiKerusakan(token_bencana_detail) {
        run_waitMe($('#frmEntryValidasiKerusakan'));
        $.ajax({
            type: 'POST',
            url: site + '/reviewValidasi',
            data: {
                'token_bencana_detail': token_bencana_detail,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenValidasiId"]').val(token_bencana_detail);
                }
                $('#frmEntryValidasiKerusakan').waitMe('hide');
                getDataListValidasiKerusakan(token_bencana_detail);
                idx = token_bencana_detail;
            }
        });
    }

    function getDataListValidasiKerusakan(token_bencana_detail) {
        $('#tblListKerusakan').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing": true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": site + '/listviewKerusakan',
                "type": "POST",
                "data": {
                    "token_bencana_detail": token_bencana_detail,
                    "param": $('#formFilter').serializeArray(),
                    "<?php echo $this->security->get_csrf_token_name(); ?>": $('input[name="' + csrfName + '"]').val()
                },
            },
            "columnDefs": [{
                    "targets": [0], //first column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
                {
                    "targets": [-1, -2, -3], //last column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
            ],
        });
        $('#tblListKerusakan_filter input').addClass('form-control').attr('placeholder', 'Search Data');
        $('#tblListKerusakan_length select').addClass('form-control');
    }

    // Handle click on "check all" control
    $(document).on('click', '#checkAllKerusakan', function() {
        $('#tblListKerusakan > tbody input[type=checkbox]').prop('checked', this.checked).trigger('change');
    });

    // Handle click on "checked" control
    $(document).on('change', '#tblListKerusakan > tbody input[type=checkbox]', function(e) {
        const rowCount = $('#tblListKerusakan > tbody input[type=checkbox]').length;
        const n = $('#tblListKerusakan > tbody input[type=checkbox]').filter(':checked').length;
        if (n > 0)
            $('#btnValidasiKerusakan').show();
        else
            $('#btnValidasiKerusakan').hide();

        if (rowCount == n)
            $('#checkAllKerusakan').prop('checked', 'checked');
        else
            $('#checkAllKerusakan').prop('checked', '');
    });

    $(document).on('click', '#tblListKerusakan > tbody > tr', function() {
        let n = $(this).find('input[type=checkbox]');
        n.prop('checked', (n.is(':checked')) ? false : true).trigger('change');
    });

    $(document).on('click', '#btnValidasiKerusakan', function(e) {
        e.preventDefault();
        let token = [];
        $.each($('#tblListKerusakan > tbody input[type=checkbox]:checked'), function() {
            token.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        $(this).html('<i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
        run_waitMe($('#formParent'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin mengupdate data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/createValidasiKerusakan',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="' + csrfName + '"]').val(data.csrfHash);
                    if (data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Update',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccessValidasiKerusakan').html(msg.error(data.message)).delay(1600).fadeOut('slow');
                            }
                        })
                    } else {
                        swalAlert.fire({
                            title: 'Berhasil Update',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccessValidasiKerusakan').html(msg.success(data.message)).delay(1600).fadeOut('slow');
                                getDataListbencana();
                                $('#btnValidasiKerusakan').hide();
                                getDataListValidasiKerusakan(idx);
                                $("#btnValidasiKerusakan").html('<i class="fa fa-check"></i> Validasi');
                                $("#btnValidasiKerusakan").removeClass('disabled');
                            }
                        })
                    }
                    $('#formParent').waitMe('hide');
                }).fail(function() {
                    $('#errSuccessValidasiKerusakan').html(msg.error('Harap periksa kembali data yang akan diupdate')).delay(1600).fadeOut('slow');
                    $('#formParent').waitMe('hide');
                }).always(function() {
                    $("#btnValidasiKerusakan").html('<i class="fa fa-check"></i> Validasi');
                    $("#btnValidasiKerusakan").removeClass('disabled');
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
                        $('#btnValidasiKerusakan').html('<i class="fas fa-trash-alt"></i> Update Data');
                        $('#btnValidasiKerusakan').removeClass('disabled');
                    }
                })
            }
        })
    });
    // ------------------------------------- JAVASCRIPT PROSES VALIDASI KERUSAKAN BENCANA DAERAH -------------------------//

    // trigger ketika focus ke form input value akan di kosongkan
    function resetValueOnClick(element) {
        lastValue = element.value;
        $(element).val('');
    }

    function restoreValueOnClick(element) {
        if (element.value == "") {
            $(element).val(lastValue);
        }
    }

    // fungsi untuk menetapkan tab mana yang sedang aktif
    function activeTabSet(tab) {
        activeTabs = tab;
        location.href = '#panel' + tab;
        loadData();
    }
    //fungsi untuk refresh data
    $('#btn-refresh-data').click(function() {
        loadData();
    });

    // fungsi untuk load data sesuai dengan tab yang aktif
    function loadData() {

        if (activeTabs == 1) {
            getDataKorbanJiwa();
        } else if (activeTabs == 2) {
            getDataKerusakan();
        } else if (activeTabs == 3) {
            getDataTernak();
        } else if (activeTabs == 4) {
            getDataTersalurkan();
        } else if (activeTabs == 5) {
            getDataDiterima();
        } else if (activeTabs == 6) {
            getDataRelawan();
        }
    }

    // fungsi untuk mengaktifkan tab sesuai dengan url
    function activedTabUrl() {
        let url = window.location.href;
        let tab = url.split('#panel')[1];
        if (tab) {
            $('#head-panel' + tab).click();
        } else {
            $('#head-panel1').click();
        }
    }

    function validasiWaktuDanVillage() {
        let data_date = $('#data_date').val();
        let wil_village = $('#wil_village').val();
        // validasi waktu tanggal data
        if (data_date == "") {
            swalAlert.fire({
                title: 'Perhatian!',
                text: 'Silahkan pilih waktu dan tanggal data terlebih dahulu',
                icon: 'warning',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            }).then((result) => {
                if (result.value) {
                    $('#data_date').focus();
                }
            })
            return false;
        }
        // validasi kelurahan/nagari/desa

        if (wil_village == "") {
            swalAlert.fire({
                title: 'Perhatian!',
                text: 'Silahkan pilih kelurahan/nagari/desa terlebih dahulu',
                icon: 'warning',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            }).then((result) => {
                if (result.value) {
                    $('#wil_village').focus();
                }
            })
            return false;
        }
        return true;
    }

    <?php
    if (isset($vkorbanjiwajs)) echo $vkorbanjiwajs;
    if (isset($vkerusakanjs)) echo $vkerusakanjs;
    if (isset($vternakjs)) echo $vternakjs;
    if (isset($vbantuantersalurkanjs)) echo $vbantuantersalurkanjs;
    if (isset($vbantuanditerimajs)) echo $vbantuanditerimajs;
    if (isset($vbantuanrelawanjs)) echo $vbantuanrelawanjs;
    ?>
</script>