$(document).on('submit', '#formEntry-kerusakan', function(e) {
    e.preventDefault();

    if(!validasiWaktuDanVillage()) {
        return false;
    }

    let form = $(this);
    let url = form.attr('action');
    let data_date = $('#data_date').val();
    let wil_village = $('#wil_village').val();
    let data = form.serializeArray();
    let csrfHash = $('input[name="'+csrfName+'"]').val();
    let token_bencana_detail = $('input[name="token_bencana_detail"]').val();
    data.push({name: 'data_date', value: data_date});
    data.push({name: 'wil_village', value: wil_village});
    data.push({name: csrfName, value: csrfHash});
    data.push({name: 'token_bencana_detail', value: token_bencana_detail});
    run_waitMe($('#formParent'));
    $('#save-kerusakan').html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
    $('#save-kerusakan').addClass('disabled');
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
    }).done(function(data) {
        $('input[name="'+csrfName+'"]').val(data.csrfHash);
        if(data.status == 'RC200') {
            swalAlert.fire({
                title: 'Berhasil Simpan',
                text: data.message,
                icon: 'success',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            }).then((result) => {
                if (result.value) {
                    getDataListFungsi();
                }
            })
        } else {

            swalAlert.fire({
                title: 'Terjadi Kesalahan',
                text: data.message,
                icon: 'warning',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            }).then((result) => {
                if (result.value) {
                    $('#errEntry-korbanjiwa').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                    $('#frmEntry').waitMe('hide');
                }
            })
        }
    }).fail(function() {
        $('#errEntry').html(msg.error('Harap periksa kembali data yang diinputkan'));
        swalAlert.fire({
            title: 'Terjadi Kesalahan',
            text: 'Gagal melakukan proses simpan data',
            icon: 'warning',
            confirmButtonText: '<i class="fas fa-check"></i> Oke',
        }).then((result) => {
            if (result.value) {
                window.location.reload();
            }
        })
    }).always(function() {
        $('#formParent').waitMe('hide');
        $('#save-kerusakan').html('<i class="fas fa-check"></i> Simpan Data ');
        $('#save-kerusakan').removeClass('disabled');
    });
});

function getDataKerusakan(){
    let wil_village = $('#wil_village').val();
    let token_bencana_detail = $('input[name="token_bencana_detail"]').val();
    let url = siteUri + '/review/getDataKerusakan';
    let data = {
        wil_village: wil_village,
        token_bencana_detail: token_bencana_detail,
    }

    run_waitMe($('#formParent'));
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: "json",
    }).done(function(data) {
        if(data.status == 'RC200'){
            data.data.kerusakan.forEach(function(item) {
                $('#rusak_berat-' + item.id_kerusakan).val(item.rusak_berat);
                $('#rusak_sedang-' + item.id_kerusakan).val(item.rusak_sedang);
                $('#rusak_ringan-' + item.id_kerusakan).val(item.rusak_ringan);
            });
            data.data.terendam.forEach(function(item) {
                $('#jml_terendam-' + item.id_kerusakan).val(item.jml_terendam);
            });
            data.data.sarana_lainnya.forEach(function(item) {
                $('#jml_sarana_lainnya-' + item.id_kerusakan).val(item.jumlah_sarana);
            });
            $('#label-waktu_input').html(data.create_date);
            $('#label-waktu_data').html(data.waktu_data);
            $('#label-kelnagdes').html(data.nm_village);
            $('#wil_village').select2().val(data.wil_village).trigger('change');
        }
        else{
            $('#formEntry-kerusakan input').val(0);
            $('#label-waktu_input').html('');
            $('#label-waktu_data').html('');
            $('#label-kelnagdes').html('');
        }
    }).fail(function() {
        swalAlert.fire({
            title: 'Terjadi Kesalahan',
            text: 'Gagal memuat data',
            icon: 'warning',
            confirmButtonText: '<i class="fas fa-check"></i> Oke',
        })
    }).always(function() {
        $('#formParent').waitMe('hide');
    });
}