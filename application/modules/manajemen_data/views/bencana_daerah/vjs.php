<script type="text/javascript">
    let activeTabs = 1;
    let lastValue = 0;
    const siteUri = '<?php echo site_url() . $siteUri; ?>';
    $(document).ready(function(e) {
        getDataListbencana();
        $('.select-all').select2();
        activedTabUrl();
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
    if (isset($vtersalurkanjs)) echo $vtersalurkanjs;
    if (isset($vditerimajs)) echo $vditerimajs;
    ?>
</script>