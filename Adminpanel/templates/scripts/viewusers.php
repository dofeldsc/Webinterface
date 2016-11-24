<script type="text/javascript">
    $(document).ready(function() {
        $('#BannedPlayers').DataTable({
            "pageLength": 25,
            "pagingType": "full_numbers",
            "responsive": false,
            "oSearch": {
                "sSearch": "<?php echo (!Input::get('search'))? "":Input::get('search'); ?>"
            },
            "columnDefs": [ {
                "targets": 2,
                "orderable": false
            },
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    } );
</script>