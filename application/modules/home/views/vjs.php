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
</script>