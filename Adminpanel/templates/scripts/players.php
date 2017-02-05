<script type="text/javascript">
    $(document).ready(function() {
        var playerlist = $('#PlayerList').DataTable({
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "autoWidth": false,
            "ajax": "../templates/tabledata/players.php",
            "pagingType": "full_numbers",
            "columnDefs": [ 
            {
                "targets": [-2,-3],
                "visible": false
            }<?php if($user->hasPermision("PlayersEdit")): ?>,
            {
                "orderable": false,
                "targets": -1,
                "data": null,
                "defaultContent": "<a><i class='fa fa-pencil pull-right'></i></a>"
            } <?php endif;?>
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
        $('#PlayerList tbody').on( 'click', 'a', function () {
            
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = playerlist.row(current_row).data();
            document.location.href = "editplayer?id="+data[9];
        });
    } );
</script>