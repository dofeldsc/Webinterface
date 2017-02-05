<script type="text/javascript">
    $(document).ready(function() {
        
        var LogList = $('#LogList').DataTable({
            "pageLength": 25,
            "responsive": true,
            "order": [],
            "columnDefs": [ {
                "targets": -1,
                "orderable": false,
                "searchable": true,
                "width": "55%",
                "type": "date-de"
            }],

            "pagingType": "full_numbers",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
        $('#actions').on('change', function () {
            LogList.columns(1).search( this.value ).draw();
        } );
    } );
</script>