<script type="text/javascript">
    $(document).ready(function() {
        $('#BannedPlayers tbody').on( 'click', '.reason-btn', function () {
            var reason = $(this).attr('reason');
            
            $('#ReasonModal .Text').html(reason);
            $('#ReasonModal').modal();
        });

        $('#BannedPlayers tbody').on( 'click', '.edit-ban', function () {
            var banid = $(this).attr('banid');
            document.location.href = "<?php echo DIR_TO_SITES ;?>banmanager.php/?banid="+ rconID + "&name="+ name +"&action=kick&reason=" + $(".reason-text-kick").val();
        });

        
        $('#BannedPlayers tbody').on( 'click', '.unban', function () {
            var banid = $(this).attr('banid');
            var name = $(this).attr('name');
            
            $('#UnbanModal .Text').html("Möchtest du den Spieler <strong>" + name + "</strong> wirklich entbannen?");
            document.getElementsByClassName('confirm-unban-btn')[0].setAttribute("banid", banid);
            $('#UnbanModal').modal();
        });
        
        $('.confirm-unban-btn').click(function() {
            var banid = $(this).attr('banid');
            document.location.href = "<?php echo DIR_TO_SITES ;?>banmanager.php/?action=unban&banid=" + banid;
        });
        
        $('#BannedPlayers').DataTable({
            "pageLength": 25,
            "pagingType": "full_numbers",
            "responsive": true,
            "oSearch": {
                "sSearch": "<?php echo (!Input::get('search'))? "":Input::get('search'); ?>"
            },
            "columnDefs": [ {
                "targets": -1,
                "orderable": false
            },
            {
                "targets": 4,
                "orderable": false
            }
            
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    } );
</script>