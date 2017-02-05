<script type="text/javascript">
    function addZero (number) {
        if (number < 10) {
            
            return "0" + number.toString();
        } else {
            return number.toString();
        }
    }
    $(document).ready(function() {
        $('#BannedPlayers tbody').on( 'click', '.reason-btn', function () {
            var reason = $(this).attr('reason');
            
            $('#ReasonModal .Text').html(reason);
            $('#ReasonModal').modal();
        });

        $('#BannedPlayers tbody').on( 'click', '.edit-ban', function () {
            var banid = $(this).attr('banid');
            var reason = $(this).attr('reason');

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = BannedPlayers.row(current_row).data();
            var TmpTab = document.getElementById("TmpTab");
            var PermTab = document.getElementById("PermTab");
            var TmpContent = document.getElementById("TmpContent");
            var PermContent = document.getElementById("PermContent");

            if (data[3] == 'Permanent') {
                if (TmpTab) {
                    TmpTab.className = '';
                    TmpContent.className = 'tab-pane';
                    $('#datepicker').data("DateTimePicker").date(moment());
                }
                if (PermTab) {
                    PermTab.className = 'active';
                    PermContent.className = 'tab-pane active';
                } else {
                    TmpTab.className = 'active';
                    TmpContent.className = 'tab-pane active';
                }
            } else {
                if (PermTab) {                  
                    PermTab.className = '';
                    PermContent.className = 'tab-pane';
                } else {
                    TmpTab.className = 'active';
                    TmpContent.className = 'tab-pane active';
                    $('#datepicker').data("DateTimePicker").date(data[3]);
                }
                if (TmpTab) {
                    TmpTab.className = 'active';
                    TmpContent.className = 'tab-pane active';
                    $('#datepicker').data("DateTimePicker").date(data[3]);
                } else {
                    PermTab.className = 'active';
                    PermContent.className = 'tab-pane active';
                }
            };
            $('#EditModal .reason-text-tmpban').val(reason);
            $('#EditModal .reason-text-ban').val(reason);
            $('#EditModal .Name').html(data[0]);
            $('#EditModal').modal();
            document.getElementsByClassName('confirm-tmpban-btn')[0].setAttribute("playerid", data[1]);
            document.getElementsByClassName('confirm-tmpban-btn')[0].setAttribute("banid", banid);
            document.getElementsByClassName('confirm-ban-btn')[0].setAttribute("playerid", data[1]);
            document.getElementsByClassName('confirm-ban-btn')[0].setAttribute("banid", banid);
        });

        
        $('#BannedPlayers tbody').on( 'click', '.unban', function () {
            var banid = $(this).attr('banid');
            var name = $(this).attr('name');
            var playerid = $(this).attr('playerid');
            
            $('#UnbanModal .Text').html("Möchtest du den Spieler <strong>" + name + "</strong> wirklich entbannen?");
            document.getElementsByClassName('confirm-unban-btn')[0].setAttribute("banid", banid);
            document.getElementsByClassName('confirm-unban-btn')[0].setAttribute("name", name);
            document.getElementsByClassName('confirm-unban-btn')[0].setAttribute("playerid", playerid);
            $('#UnbanModal').modal();
        });
        
        $('.confirm-unban-btn').click(function() {
            var banid = $(this).attr('banid');
            var name = $(this).attr('name');
            var playerid = $(this).attr('playerid');
            if (!$('.reason-text-unban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                document.location.href = "<?php echo DIR_TO_SITES ;?>banmanager?action=unban&banid=" + banid + "&name=" + name + "&playerid=" + playerid +"&reason=" + $(".reason-text-unban").val();
            }
        });

        $('.confirm-tmpban-btn').click(function() {
            var banid = $(this).attr('banid');
            var playerid = $(this).attr('playerid');
            if (!$('#datepicker').val()) {
                swal("Du musst ein Datum angeben.","", "error");
            } else if (!$('.reason-text-tmpban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                var rawDate = new Date($('#datepicker').data("DateTimePicker").date());
                var year = addZero(rawDate.getFullYear());
                var month = addZero(rawDate.getMonth() + 1);
                var day = addZero(rawDate.getDate());
                var hr = addZero(rawDate.getHours());
                var min = addZero(rawDate.getMinutes());
                var date = year + month + day + hr + min;
                document.location.href = window.location.href + "?action=tmpban&id="+ banid + "&playerid=" + playerid +"&date="+ date +"&reason=" + $(".reason-text-tmpban").val();
            }
        });
        
        $('.confirm-ban-btn').click(function() {
            var banid = $(this).attr('banid');
            var playerid = $(this).attr('playerid');
            if (!$('.reason-text-ban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                document.location.href = window.location.href + "?action=ban&id="+ banid +"&playerid="+ playerid +"&reason=" + $(".reason-text-ban").val();
            }
        });

        var BannedPlayers = $('#BannedPlayers').DataTable({
            "pageLength": 25,
            "pagingType": "full_numbers",
            "responsive": true,
            "order": [],
            "oSearch": {
                "sSearch": "<?php echo (!Input::get('search'))? "":Input::get('search'); ?>"
            },
            "columnDefs": [ {
                "targets": -1,
                "orderable": false
            },
            {
                "targets": -2,
                "orderable": false
            },
            {
                "targets": [2,3],
                "type": "date-dd-MMM-yyyy"
            }
            
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });

        var picker = $('#datepicker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            locale: 'de'
        });
    } );
</script>