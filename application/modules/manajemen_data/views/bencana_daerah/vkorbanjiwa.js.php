$(document).on('submit', '#formEntry-korbanJiwa', function(e) {
    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');
    let data_date = $('#data_date').val();
    // validasi waktu tanggal data
    if(data_date == ""){
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

    let data = form.serializeArray();
    let csrfHash = $('input[name="'+csrfName+'"]').val();
    data.push({name: 'data_date', value: data_date});
    data.push({name: csrfName, value: csrfHash});
    run_waitMe($('#formParent'));
    $("#save-korban-jiwa").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
    $("#save-korban-jiwa").addClass('disabled');
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
    }).done(function(data) {
        $('input[name="'+csrfName+'"]').val(data.csrfHash);
        if(data.status == 'RC200') {
            $('#modalEntryForm').modal('toggle');
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
        $("#save-korban-jiwa").html('<i class="fas fa-check"></i> Simpan Data ');
        $("#save-korban-jiwa").removeClass('disabled');
    });
});