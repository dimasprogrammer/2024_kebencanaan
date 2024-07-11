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
        formReset();
        $('#modalEntryFormShare').modal('toggle');
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
        refreshMap();
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
                    $('#tanggal_bencana').val(data.message.dataBencana.tanggal_bencana);
                    $('#jam_bencana').val(data.message.dataBencana.jam_bencana);
                    $('#gambar').val(data.message.dataBencana.gambar);
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    var latlng = {
                        lat: data.message.dataBencana.latitude,
                        lng: data.message.dataBencana.longitude
                    };
                    marker = L.marker(latlng).addTo(map);
                    $('#latitude').val(data.message.dataBencana.latitude);
                    $('#longitude').val(data.message.dataBencana.longitude);
                    $('#address').val(data.message.dataBencana.address);

                    //--------------------- DATA OPD DAERAH PENANGGULANGAN BENCANA DAERAH -------------------//
                    htmlBencana += '<thead>';
                    htmlBencana += '<th width="5%" class="font-weight-bold"><left>#</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Nama Penanggung Jawab</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Instansi</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Kabupaten/Kota</left></th>';
                    htmlBencana += '<th width="20%" class="font-weight-bold"><left>Action</left></th>';
                    htmlBencana += '</thead>';
                    if (Object.keys(data.message.dataDetailBencana).length > 0) {
                        $.each(data.message.dataDetailBencana, function(key, val) {
                            let no = 1;
                            htmlBencana += '<tbody>';
                            htmlBencana += '<tr>';
                            htmlBencana += '<td width="2%"> ' + no + '. </td><br>';
                            htmlBencana += '<td width="25%" class="text-justify">' + val['fullname'] + '</td>';
                            htmlBencana += '<td width="25%" class="text-justify">' + val['nm_instansi'] + '</td>';
                            htmlBencana += '<td width="25%" class="text-justify">' + val['nm_regency'] + '</td>';
                            htmlBencana += '<td width="15%" class="text-center">' + '<button type="button" class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEditBencanaShare" data-id=' + val['token_bencana_share'] + '><i class="fas fa-box-open"></i> Edit </button>' + '</td>';
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

    $(document).on('click', '.btnEditBencanaShare', function(e) {
        formReset();
        $('#formEntry').attr('action', site + '/updateShare');
        var token_bencana_share = $(this).data('id');
        $('#modalEntryFormShare').modal({
            backdrop: 'static'
        });
        getDataBencanaShare(token_bencana_share);
    });

    function getDataBencanaShare(token_bencana_share) {
        run_waitMe($('#frmEntryShare'));
        $.ajax({
            type: 'POST',
            url: site + '/detailShare',
            data: {
                'token_bencana_share': token_bencana_share,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token_bencana_share);
                }
                $('#frmEntryShare').waitMe('hide');
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

    $('input[name="daterange"]').daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
        locale: {
            // format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
        }
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Time Picker Initialization
    $('#jam_bencana').pickatime({
        // 12 or 24 hour
        twelvehour: false,
        // Light or Dark theme
        darktheme: false
    });
</script>

<script>
    var map = L.map('map-canvas').setView([-0.7682504, 100.4866192], 10);

    // map google
    // L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
    //     tileSize: 512,
    //     maxZoom: 18,
    //     zoomOffset: -1,
    // }).addTo(map);

    // map box
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
        tileSize: 512,
        maxZoom: 18,
        zoomOffset: -1,
        id: 'mapbox/streets-v12',
        accessToken: 'pk.eyJ1IjoiZGltYXNkd2lyYW5kYSIsImEiOiJjbG80MjBhdTYxZThyMnFwamVnZ3I2OHdtIn0.a-QYQCmFyKhE1dDplHpMQQ'
    }).addTo(map);

    var marker;

    // Fungsi untuk menambahkan marker dan menampilkan koordinat pada input
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        var latlng = e.latlng;
        console.log(latlng);
        marker = L.marker(latlng).addTo(map);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        getAddress(latlng.lat, latlng.lng);
    });
    window.addEventListener('resize', function() {
        map.invalidateSize();
    });

    function getAddress(lat, lon) {
        var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
                document.getElementById('address').value = address;
            })
            .catch(error => {
                console.error('Error fetching address:', error);
            });
    }

    function refreshMap() {
        setTimeout(function() {
            map.invalidateSize();
        }, 400);
    }
</script>