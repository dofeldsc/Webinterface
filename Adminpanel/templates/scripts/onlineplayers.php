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
            var playername = $(this).attr('name');
            
            $('#KickPlayerModal .Text').html("Spieler <strong>" + playername + "</strong> wirklich kicken?");
            document.getElementsByClassName('confirm-kick-btn')[0].setAttribute("id", rconID);
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
        
        $('.confirm-kick-btn').click(function() {
            if (!$('.reason-text-kick').val()) {
                alert("Du musst einen Grund angeben.");
            } else {
                var rconID =  $(this).attr('id');
                var name =  $(this).attr('name');
                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers.php/?id="+ rconID + "&name="+ name +"&action=kick&reason=" + $(".reason-text-kick").val();
            }
        });
        
        $('.confirm-tmpban-btn').click(function() {
            if (!$('#datepicker').val()) {
                alert("Du musst ein Datum angeben.");
            } else if (!$('.reason-text-tmpban').val()) {
                alert("Du musst einen Grund angeben.");
            } else {
                var rconID =  $(this).attr('rconid');
                var guid =  $(this).attr('guid');
                var name =  $(this).attr('name');
                var rawDate = $('#datepicker').datetimepicker("getDate");
                var year = addZero(rawDate.getFullYear());
                var month = addZero(rawDate.getMonth() + 1);
                var day = addZero(rawDate.getDate());
                var hr = addZero(rawDate.getHours());
                var min = addZero(rawDate.getMinutes());
                var date = year + month + day + hr + min;
                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers.php/?rconid="+ rconID +"&guid="+ guid + "&name="+ name +"&action=tmpban&date=" + date +"&reason=" + $(".reason-text-tmpban").val();
            }
        });
        
        $('.confirm-ban-btn').click(function() {
            if (!$('.reason-text-ban').val()) {
                alert("Du musst einen Grund angeben.");
            } else {
                var rconID =  $(this).attr('rconid');
                var guid =  $(this).attr('guid');
                var name =  $(this).attr('name');


                document.location.href = "<?php echo DIR_TO_SITES ;?>onlineplayers.php/?rconid="+ rconID + "&guid="+ guid + "&name="+ name + "&action=ban&date=-1&reason=" + $(".reason-text-ban").val();
            }
        });
        
        $('#datepicker').datetimepicker({
            language: "de",
            format: "dd.mm.yyyy hh:ii",
            minView: 1,
            autoclose: true,
            useCurrent: false,
            useDefault: false
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