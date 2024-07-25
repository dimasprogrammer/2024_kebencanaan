<?= $this->asset->js('plugins/tinymce/tinymce.min.js'); ?>
<?= $this->asset->js('addons/setting.tinymce.js'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        getDataListbencana();
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
        getDataListbencana();
    });
    $('#formFilter').submit(function(e) {
        e.preventDefault();
        getDataListbencana();
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

    //panggil form Entri
    $(document).on('click', '#btnAdd', function(e) {
        formReset();
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        refreshMap();
    });
    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        formReset();
        $('#modalEntryForm').modal('toggle');
    });

    $(document).on('click', '.btnCloseShare', function(e) {
        // formReset();
        $('#modalEntryFormShare').modal('toggle');
    });

    $(document).on('click', '.btnCloseKirim', function(e) {
        // formReset();
        $('#modalEntryFormKirim').modal('toggle');
    });

    $(document).on('click', '.btnEdit', function(e) {
        formReset();
        $('#formEntry').attr('action', site + '/update');
        var token_bencana = $(this).data('id');
        id_token_bencana = token_bencana;
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        refreshMap();
        // token = 
        getDataBencana(token_bencana);
    });

    function getDataBencana(token_bencana) {
        let htmlBencana = '';
        run_waitMe($('#frmEntry'));
        $.ajax({
            type: 'POST',
            url: site + '/details',
            data: {
                'token_bencana': token_bencana,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token_bencana);
                    $('#id_jenis_bencana').select2().val(data.message.dataBencana.id_jenis_bencana).trigger("change");
                    $('#nama_bencana').val(data.message.dataBencana.nama_bencana);
                    $('#penyebab_bencana').val(data.message.dataBencana.penyebab_bencana);
                    $('#kategori_bencana').select2().val(data.message.dataBencana.kategori_bencana).trigger("change");
                    $('#kategori_tanggap').select2().val(data.message.dataBencana.kategori_tanggap).trigger("change");
                    $('#tanggal_bencana').val(data.message.dataBencana.tanggal_bencana);
                    $('#jumlah_kejadian').val(data.message.dataBencana.jumlah_kejadian);
                    $('#video_bencana').val(data.message.dataBencana.video_bencana);
                    $('#logo').html(data.message.dataBencana.logo);
                    if (marker) {
                        map1.removeLayer(marker);
                    }
                    var latlng = {
                        lat: data.message.dataBencana.latitude,
                        lng: data.message.dataBencana.longitude
                    };
                    marker = L.marker(latlng).addTo(map1);
                    $('#latitude').val(data.message.dataBencana.latitude);
                    $('#longitude').val(data.message.dataBencana.longitude);

                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//
                    htmlBencana += '<thead>';
                    // htmlBencana += '<th width="5%" class="font-weight-bold"><left>#</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Kabupaten/Kota</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Action</left></th>';
                    htmlBencana += '</thead>';
                    if (Object.keys(data.message.dataDetailBencana).length > 0) {
                        $.each(data.message.dataDetailBencana, function(key, val) {
                            let no = 1;
                            htmlBencana += '<tbody>';
                            htmlBencana += '<tr>';
                            // htmlBencana += '<td width="2%"> ' + no + '. </td><br>';
                            htmlBencana += '<td width="25%" class="text-justify">' + val['nm_regency'] + '</td>';
                            htmlBencana += '<td width="15%" class="text-center">' + '<button type="button" class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEditBencanaShare" data-id=' + val['token_bencana_detail'] + '><i class="fas fa-box-open"></i> Edit </button>' + '</td>';
                            htmlBencana += '</tr>';
                            htmlBencana += '</tbody>';
                            no++;

                        });
                    } else {
                        htmlBencana = '<tr><td colspan="2"><i>Data Bencana Belum Ada</i></td></tr>';
                    }

                    $('#tblPenanggungJawab').html(htmlBencana);
                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//
                }
                $('#frmEntry').waitMe('hide');
            }
        });
    }

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
                                getDataListbencana();
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

    $(document).on('click', '.btnKirim', function(e) {
        formReset();
        $('#formEntryKirim').attr('action', site + '/kirim');
        var token_bencana = $(this).data('id');
        id_token_bencana = token_bencana;
        $('#modalEntryFormKirim').modal({
            backdrop: 'static'
        });
        refreshMap2();
        // token = 
        getDataBencanaKirim(token_bencana);
    });

    function getDataBencanaKirim(token_bencana) {
        let htmlBencanaKirim = '';
        run_waitMe($('#frmEntryKirim'));
        $.ajax({
            type: 'POST',
            url: site + '/review',
            data: {
                'token_bencana': token_bencana,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token_bencana);
                    $('#tanggal_kirim').val(data.message.dataBencanaKirim.tanggal_bencana);
                    $('#tanggap_kirim').val(data.message.dataBencanaKirim.nm_tanggap);
                    $('#jenis_bencana_kirim').val(data.message.dataBencanaKirim.jenis_bencana);
                    $('#nama_bencana_kirim').val(data.message.dataBencanaKirim.nama_bencana);
                    $('#keterangan_bencana_kirim').val(data.message.dataBencanaKirim.keterangan_bencana);
                    $('#penyebab_bencana_kirim').val(data.message.dataBencanaKirim.penyebab_bencana);
                    $('#infografis_kirim').html(data.message.dataBencanaKirim.gambar);
                    $('#video_bencana_kirim').val(data.message.dataBencanaKirim.video_bencana);

                    if (marker2) {
                        map2.removeLayer(marker2);
                    }
                    var latlng = {
                        lat: data.message.dataBencanaKirim.latitude,
                        lng: data.message.dataBencanaKirim.longitude
                    };
                    marker2 = L.marker(latlng).addTo(map2);
                    $('#latitude').val(data.message.dataBencanaKirim.latitude);
                    $('#longitude').val(data.message.dataBencanaKirim.longitude);

                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//

                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//
                    if (Object.keys(data.message.dataDetailBencana).length > 0) {
                        $.each(data.message.dataDetailBencana, function(key, val) {
                            let no = 1;
                            htmlBencanaKirim += '<tbody>';
                            htmlBencanaKirim += '<tr>';
                            // htmlBencanaKirim += '<td width="2%"> ' + no + '. </td><br>';
                            htmlBencanaKirim += '<td width="25%" class="text-justify">' + val['nm_regency'] + '</td>';
                            htmlBencanaKirim += '</tr>';
                            htmlBencanaKirim += '</tbody>';
                            no++;

                        });
                    } else {
                        htmlBencanaKirim = '<tr><td colspan="2"><i>Data Bencana Belum Ada</i></td></tr>';
                    }

                    $('#tblKirim').html(htmlBencanaKirim);
                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//
                }
                $('#frmEntryKirim').waitMe('hide');
            }
        });
    }

    $(document).on('submit', '#formEntryKirim', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntryKirim')[0];
        let formActionURL = $(this).attr("action");
        $("#saveKirim").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#saveKirim").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntryKirim'));
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
                        $('#formEntryKirim').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntryKirim').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErrKirim').html(value);
                                    }
                                });
                                $('#frmEntryKirim').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntryKirim').waitMe('hide');
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
                                getDataListbencana();
                            }
                        })
                    }
                }).fail(function() {
                    $('#errEntryKirim').html(msg.error('Harap periksa kembali data'));
                    $('#frmEntryKirim').waitMe('hide');
                }).always(function() {
                    $("#saveKirim").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#saveKirim").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntryKirim').waitMe('hide');
                        $("#saveKirim").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#saveKirim").removeClass('disabled');
                    }
                })
            }
        })
    });

    $(document).on('click', '.btnEditBencanaShare', function(e) {
        // formReset();
        $('#formEntryShare').attr('action', site + '/updateShare');
        var token_bencana_detail = $(this).data('id');
        $('#modalEntryFormShare').modal({
            backdrop: 'static'
        });

        getDataBencanaShare(token_bencana_detail);
    });

    function getDataBencanaShare(token_bencana_detail) {
        run_waitMe($('#frmEntryShare'));
        $.ajax({
            type: 'POST',
            url: site + '/detailShare',
            data: {
                'token_bencana_detail': token_bencana_detail,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(data.message.token_bencana);
                    $('input[name="tokenIdShare"]').val(token_bencana_detail);
                    $('#id_regency_penerima').select2().val(data.message.id_regency_penerima).trigger("change");
                }
                $('#frmEntryShare').waitMe('hide');
            }
        });
    }

    $(document).on('submit', '#formEntryShare', function(e) {
        e.preventDefault();
        // let postData = $(this).serialize();
        // get form action url
        var form = $('#formEntryShare')[0];
        let formActionURL = $(this).attr("action");
        $("#saveShare").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#saveShare").addClass('disabled');
        // alert(formActionURL);
        run_waitMe($('#frmEntryShare'));
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
                        $('#formEntryShare').addClass('was-validated');
                        $('.invalid-feedback').removeClass('valid-feedback').text('');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntryShare').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key, value) {
                                    if (key != 'isi')
                                        $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').addClass('valid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmEntryShare').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntryShare').waitMe('hide');
                        $('#modalEntryFormShare').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                newKode = data.kode;
                                $('#errSuccessShare').html(msg.success(data.message));
                                getDataBencana(id_token_bencana);
                            }
                        })
                    }
                }).fail(function() {
                    $('#errEntryShare').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmEntryShare').waitMe('hide');
                }).always(function() {
                    $("#saveShare").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#saveShare").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntryShare').waitMe('hide');
                        $("#saveShare").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#saveShare").removeClass('disabled');
                    }
                })
            }
        })
    });

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
                                getDataListbencana();
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
</script>

<script>
    var map1 = L.map("map1").setView([-0.7682504, 100.4866192], 10);
    L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map1);

    var map2 = L.map("map2").setView([-0.7682504, 100.4866192], 10);
    L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map2);

    var marker;
    var marker2;

    // Fungsi untuk menambahkan marker dan menampilkan koordinat pada input
    map1.on('click', function(e) {
        if (marker) {
            map1.removeLayer(marker);
        }
        var latlng = e.latlng;
        console.log(latlng);
        marker = L.marker(latlng).addTo(map1);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });

    window.addEventListener('resize', function() {
        map1.invalidateSize();
    });

    map2.on('click', function(e) {
        if (marker2) {
            map2.removeLayer(marker2);
        }
        var latlng = e.latlng;
        console.log(latlng);
        marker2 = L.marker(latlng).addTo(map2);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });

    window.addEventListener('resize', function() {
        map2.invalidateSize();
    });


    function refreshMap() {
        setTimeout(function() {
            map1.invalidateSize();
        }, 400);
    }

    function refreshMap2() {
        setTimeout(function() {
            map2.invalidateSize();
        }, 400);
    }

    // function refreshMap() {
    //     setTimeout(function() {
    //         map.invalidateSize();
    //     }, 400);
    // }
</script>