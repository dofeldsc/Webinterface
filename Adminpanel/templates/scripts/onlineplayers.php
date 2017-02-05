<script type="text/javascript">
    function addZero (number) {
        if (number < 10) {
            
            return "0" + number.toString();
        } else {
            return number.toString();
        }
    }
    $(document).ready(function() {
        $('#OnlinePlayerList tbody').on( 'click', '.kick-player', function () {
            var rconID = $(this).attr('id');
            var guid = $(this).attr('guid');
            var playername = $(this).attr('name');
            
            $('#KickPlayerModal .Text').html("Spieler <strong>" + playername + "</strong> wirklich kicken?");
            document.getElementsByClassName('confirm-kick-btn')[0].setAttribute("id", rconID);
            document.getElementsByClassName('confirm-kick-btn')[0].setAttribute("guid", guid);
            document.getElementsByClassName('confirm-kick-btn')[0].setAttribute("name", playername);
            $('#KickPlayerModal').modal();
        });
        
        $('#OnlinePlayerList tbody').on( 'click', '.tempban-player', function () {
            var rconID = $(this).attr('rconid');
            var guid = $(this).attr('guid');
            var playername = $(this).attr('name');
            
            $('#TempbanPlayerModal .Text').html("Wie lange möchtest du den Spieler <strong>" + playername + "</strong> temporäre bannen?");
            document.getElementsByClassName('confirm-tmpban-btn')[0].setAttribute("rconid", rconID);
            document.getElementsByClassName('confirm-tmpban-btn')[0].setAttribute("guid", guid);
            document.getElementsByClassName('confirm-tmpban-btn')[0].setAttribute("name", playername);
            $('#TempbanPlayerModal').modal();
        });
        
        $('#OnlinePlayerList tbody').on( 'click', '.ban-player', function () {
            var rconID = $(this).attr('rconid');
            var guid = $(this).attr('guid');
            var playername = $(this).attr('name');
            
            $('#BanPlayerModal .Text').html("Spieler <strong>" + playername + "</strong> wirklich permanent bannen?");
            document.getElementsByClassName('confirm-ban-btn')[0].setAttribute("rconid", rconID);
            document.getElementsByClassName('confirm-ban-btn')[0].setAttribute("guid", guid);
            document.getElementsByClassName('confirm-ban-btn')[0].setAttribute("name", playername);
            $('#BanPlayerModal').modal();
        });
        
        $('#OnlinePlayerList tbody').on( 'click', '.show_player', function () {
            var guid = $(this).attr('guid');

           window.open("<?php echo DIR_TO_SITES ;?>onlineplayers?guid="+ guid + "&action=show");
        });

        $('.confirm-kick-btn').click(function() {
            if (!$('.reason-text-kick').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                var guid =  $(this).attr('guid');
                var rconID =  $(this).attr('id');
                var name =  $(this).attr('name');
                $('#KickPlayerModal').modal('hide');
                $('#TransferData').modal();
                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers?id="+ rconID + "&guid="+ guid + "&name="+ name +"&action=kick&reason=" + $(".reason-text-kick").val();
            }
        });
        
        $('.confirm-tmpban-btn').click(function() {
            if (!$('#datepicker').val()) {
                swal("Du musst ein Datum angeben.","", "error");
            } else if (!$('.reason-text-tmpban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                var rconID =  $(this).attr('rconid');
                var guid =  $(this).attr('guid');
                var name =  $(this).attr('name');
                var rawDate = new Date($('#datepicker').data("DateTimePicker").date());
                var year = addZero(rawDate.getFullYear());
                var month = addZero(rawDate.getMonth() + 1);
                var day = addZero(rawDate.getDate());
                var hr = addZero(rawDate.getHours());
                var min = addZero(rawDate.getMinutes());
                var date = year + month + day + hr + min;
                $('#TempbanPlayerModal').modal('hide');
                $('#TransferData').modal();
                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers?rconid="+ rconID +"&guid="+ guid + "&name="+ name +"&action=tmpban&date=" + date +"&reason=" + $(".reason-text-tmpban").val();
            }
        });
        
        $('.confirm-ban-btn').click(function() {
            if (!$('.reason-text-ban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                var rconID =  $(this).attr('rconid');
                var guid =  $(this).attr('guid');
                var name =  $(this).attr('name');

                $('#BanPlayerModal').modal('hide');
                $('#TransferData').modal();
                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers?rconid="+ rconID + "&guid="+ guid + "&name="+ name + "&action=ban&date=-1&reason=" + $(".reason-text-ban").val();
            }
        });
                
        $('#datepicker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            locale: 'de',
            minDate: 'now'
        });

        $('#OnlinePlayerList').DataTable({
            "pageLength": 25,
            "pagingType": "full_numbers",
            "responsive": true,
            "columnDefs": [ {
                "targets": -1,
                "orderable": false
            } ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    } );
</script>