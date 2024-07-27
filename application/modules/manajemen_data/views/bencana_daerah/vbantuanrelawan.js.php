let relawanTotalData = 0;
const relawanRow = (index, nama_organisasi = "", jml_relawan = "") => {
    let value_nama_organisasi = nama_organisasi == "" ? "" : `value="${nama_organisasi}"`;
    let value_jml_relawan = jml_relawan == "" ? "" : `value="${jml_relawan}"`;
    return `<tr id="relawanRow-${index}">
                <td class="text-center">${index+1}</td>
                <td>
                    <input type="text" class="form-control form-control-sm" 
                        name="nama_organisasi[${index}]" id="nama_organisasi-${index}"
                        ${value_nama_organisasi}
                        placeholder="Nama Organisasi"
                    required>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-right" min="0" 
                        onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" 
                        onfocusout="onInputJmlRelawan(${index}, this.value)"
                        name="jml_relawan[${index}]" id="jml_relawan-${index}" placeholder="Jumlah Relawan"
                        ${value_jml_relawan}
                    required>
                </td>
            </tr>`;
}


const renderRelawanContent = (index, nama_organisasi = "", jml_relawan = "") => {
    let content = relawanRow(index, nama_organisasi, jml_relawan);
    $('#content-relawan').append(content);
}

$("#btn-add-relawan").click(() => {
    relawanTotalData++;
    renderRelawanContent(relawanTotalData);
});

$('#btn-remove-relawan').click(() => {
    if(relawanTotalData > 0) {
        $('#relawanRow-'+relawanTotalData).remove();
        relawanTotalData--;
    }
});


$(document).on('submit', '#formEntry-relawan', function(e) {
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
    $('#save-relawan').html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
    $('#save-relawan').addClass('disabled');
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
                    $('#errEntry-relawan').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                    $('#frmEntry').waitMe('hide');
                }
            })
        }
    }).fail(function() {
        $('#errEntry-relawan').html(msg.error('Harap periksa kembali data yang diinputkan'));
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
        $('#save-relawan').html('<i class="fas fa-check"></i> Simpan Data ');
        $('#save-relawan').removeClass('disabled');
    });
});


function getDataRelawan(){
    let wil_village = $('#wil_village').val();
    let token_bencana_detail = $('input[name="token_bencana_detail"]').val();
    let url = siteUri + '/review/getDataRelawan';
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
            relawanTotalData = data.data.length - 1;
            $('#content-relawan').html('');
            data.data.forEach(function(item, index) {
                renderRelawanContent(index, item.nama_organisasi, item.jml_relawan);
            });
            $('#label-waktu_input').html(data.create_date);
            $('#label-waktu_data').html(data.waktu_data);
            $('#label-kelnagdes').html(data.nm_village);
            $('#wil_village').select2().val(data.wil_village).trigger('change');
        }
        else{
            $('#content-relawan').html('');
            relawanTotalData = 0;
            $('#content-relawan').html(relawanRow(relawanTotalData));
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