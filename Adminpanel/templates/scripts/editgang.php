<script type="text/javascript">
    $(document).ready(function() {
        
        var GangList = $('#Members').DataTable({
            "pageLength": 10,
            "responsive": true,
            "columnDefs": [ 
            {
                "targets": -1,
                "orderable": false,
                "searchable": false
            }            
            ],
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