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
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
    }).done(function(data) {
        $('input[name="'+csrfName+'"]').val(data.csrfHash);
        $('#formParent').waitMe('hide');
        if(data.status == 'RC404') {
            $('#formEntry').addClass('was-validated');
            swalAlert.fire({
                title: 'Gagal Simpan',
                text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                icon: 'error',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            }).then((result) => {
                if (result.value) {
                    $('#errEntry').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                    $.each(data.message, function(key,value){
                        if(key != 'isi')
                            $('input[name="'+key+'"], select[name="'+key+'"]').closest('div.required').find('div.invalid-feedback').text(value);
                        else {
                            $('#pesanErr').html(value);
                        }
                    });
                    $('#frmEntry').waitMe('hide');
                }
            })
        } else {
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
        }
    }).fail(function() {
        $('#errEntry').html(msg.error('Harap periksa kembali data yang diinputkan'));
        $('#frmEntry').waitMe('hide');
    }).always(function() {
        $("#save").html('<i class="fas fa-check"></i> SUBMIT');
        $("#save").removeClass('disabled');
    });
});