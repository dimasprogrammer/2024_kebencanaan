<?= $this->asset->js('plugins/tinymce/tinymce.min.js'); ?>
<?= $this->asset->js('addons/setting.tinymce.js'); ?>

<script type="text/javascript">
    let regeID, distID, villID;

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
                },
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
            ],

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
    });
    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        formReset();
        $('#modalEntryForm').modal('toggle');
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

    $(document).on('click', '.btnEdit', function(e) {
        formReset();
        $('#formEntry').attr('action', site + '/update');
        var token_bencana = $(this).data('id');
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        // refreshMap();
        // token = 
        getDataBencana(token_bencana);
    });

    function getDataBencana(token_bencana) {
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
                    $('#tanggal_bencana').val(data.message.tanggal_bencana);
                    $('#kategori_tanggap').select2().val(data.message.kategori_tanggap).trigger("change");
                    $('#id_regency').select2().val(data.message.id_regency).trigger("change");
                    distID = data.message.id_district;
                    villID = data.message.id_village;
                    $('#jorong').val(data.message.jorong);
                    $('#id_jenis_bencana').select2().val(data.message.id_jenis_bencana).trigger("change");
                    $('#nama_bencana').val(data.message.nama_bencana);
                    $('#keterangan_bencana').val(data.message.keterangan_bencana);
                    $('#penyebab_bencana').val(data.message.penyebab_bencana);
                    // $('#gambar').val(data.message.gambar);
                    $('#gambar').html(data.message.gambar);
                    $('#infografis').html(data.message.infografis);

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

    $(document).on('click', '#printExcelAll', function(e) {
        url = site + '/export-to-excel';
        window.location.href = url;
    });

    $(document).on('click', '#printExcel', function(e) {
        var opd = $('#formFilter').find('select[name="opd"]').val();
        url = site + '/export-to-excel?opd=' + opd;
        window.location.href = url;
    });

    // PRINT PDF
    $(document).on('click', '.printPDF', function(e) {
        e.preventDefault();
        let token = $(this).data('id');

        url = site + '/export_to_pdf?token=' + token;
        window.open(url, '_blank', 'width=600px',
            'height=400px');
    });

    //regency
    $(document).on('change', 'select[name="id_regency"]', function(e) {
        let id = $(this).val();
        getDistrict(id);
    });

    //district
    $(document).on('change', 'select[name="id_district"]', function(e) {
        let id = $(this).val();
        getVillage(id);
    });

    //mengambil data kecamatan
    function getDistrict(regencyId) {
        let lblDis = '';
        distID = (distID != '') ? distID : '<?php echo $this->input->post('district', TRUE); ?>';
        $.ajax({
            type: 'GET',
            url: site + '/district',
            data: {
                'regency': regencyId
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                $('select[name="id_district"]').html('').select2('data', null);
                if (data.status == 'RC200') {
                    lblDis = '<option value="">Pilih Data</option>';
                    $.each(data.message, function(key, value) {
                        lblDis += '<option value="' + value['id'] + '">' + value['text'] + '</option>';
                    });
                } else
                    lblDis = '<option value="">Pilih Data</option>';
                $('select[name="id_district"]').html(lblDis);
                $('select[name="id_district"]').select2().val(distID).trigger('change');
            }
        });
    }

    //mengambil data kelurahan/desa/nagari
    function getVillage(districtId) {
        let lblVil = '';
        villID = (villID != '') ? villID : '<?php echo $this->input->post('village', TRUE); ?>';
        $.ajax({
            type: 'GET',
            url: site + '/village',
            data: {
                'district': districtId
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                $('select[name="id_village"]').html('').select2('data', null);
                if (data.status == 'RC200') {
                    lblVil = '<option value="">Pilih Data</option>';
                    $.each(data.message, function(key, value) {
                        lblVil += '<option value="' + value['id'] + '">' + value['text'] + '</option>';
                    });
                } else
                    lblVil = '<option value="">Pilih Data</option>';
                $('select[name="id_village"]').html(lblVil);
                $('select[name="id_village"]').select2().val(villID).trigger('change');
            }
        });
    }
</script>