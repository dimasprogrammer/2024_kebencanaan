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
        refreshMap();
    });

    $(document).on('click', '.btnCloseFoto', function(e) {
        formReset();
        $('#modalEntryFormFoto').modal('toggle');
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

    $(document).on('click', '.btnFoto', function(e) {
        formReset();
        let token_bencana = $(this).data('id');
        $('#modalEntryFormFoto').modal({
            backdrop: 'static'
        });
        getDataFotoBencana(token_bencana);
    });

    function getDataFotoBencana(token_bencana) {
        run_waitMe($('#frmEntryFoto'));
        $.ajax({
            type: 'POST',
            url: site + '/detailFoto',
            data: {
                'token_bencana': token_bencana,
                '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
            },
            dataType: 'json',
            success: function(data) {
                $('input[name="' + csrfName + '"]').val(data.csrfHash);
                if (data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token_bencana);
                    $('#video_bencana').html(data.message.video_bencana);
                    $('#nama_file').html(data.message.nama_file);
                }
                $('#frmEntryFoto').waitMe('hide');
            }
        });
    }
</script>