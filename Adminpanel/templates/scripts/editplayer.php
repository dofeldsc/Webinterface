<script type="text/javascript">
    function addZero (number) {
        if (number < 10) {
            
            return "0" + number.toString();
        } else {
            return number.toString();
        }
    }
    $(document).ready(function(){
        $(".license").click(function () {
            $(this).toggleClass('btn-success btn-danger');
            var side = $(this).attr('side');
            var lic = $(this).attr('id');

            $.post( "<?php echo DIR_TO_HOOKS ?>licenseChanged.php", { lic: lic, side: side, player: "<?php echo Input::get('id') ?>"} );
        });

        $('.confirm-tmpban-btn').click(function() {
            if (!$('#datepicker').val()) {
                swal("Du musst ein Datum angeben.","", "error");
            } else if (!$('.reason-text-tmpban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                var rawDate = $('#datepicker').datetimepicker("getDate");
                var year = addZero(rawDate.getFullYear());
                var month = addZero(rawDate.getMonth() + 1);
                var day = addZero(rawDate.getDate());
                var hr = addZero(rawDate.getHours());
                var min = addZero(rawDate.getMinutes());
                var date = year + month + day + hr + min;
                console.log(window.location.href );
                document.location.href = window.location.href + "&action=tmpban&date="+ date +"&reason=" + $(".reason-text-tmpban").val();
            }
        });
        
        $('.confirm-ban-btn').click(function() {
            if (!$('.reason-text-ban').val()) {
                swal("Du musst einen Grund angeben.","", "error");
            } else {
                document.location.href = window.location.href + "&action=ban&reason=" + $(".reason-text-ban").val();
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
    });
</script>