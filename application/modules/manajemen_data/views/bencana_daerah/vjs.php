<script type="text/javascript">
    let activeTabs = 1;
    const siteUri = '<?php echo site_url() . $siteUri; ?>';
    $(document).ready(function(e) {
        getDataListbencana();
        $('.select-all').select2();
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

    function resetValueOnClick(element)
    {
        $(element).val('');
    }

    <?php if (isset($vkorbanjiwajs)) echo $vkorbanjiwajs; ?>

    function activeTabSet(tab) {
        activeTabs = tab;
        console.log(tab);
        loadData();
    }
    $('#btn-refresh-korban-jiwa').click(function() {
        loadData();
    });
    function loadData() {

        if(activeTabs == 1) {
            getDataKorbanJiwa();
        }
    }
</script>