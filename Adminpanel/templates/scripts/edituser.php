<script type="text/javascript">
    $(document).ready(function(){
        $('.confirm-del-btn').click(function() {
            swal({
              title: "Bist du dir sicher?",
              text: "Der Account wird permanent aus der Datenbank gelöscht!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Account löschen!",
              cancelButtonText: "Abbrechen",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                swal("Gelöscht!", "Der Account wurde gelöscht.", "success");
                document.location.href = window.location.href + "&action=del";
              } else {
                swal("Abgebrochen", "Der Vorgang wurde abgebrochen.", "error");
              }
            });
        });

        $(".permissions").click(function () {
        	if (!$(this).hasClass("disabled")) {
	            $(this).toggleClass('bg-green bg-red');
	            $(this).children("i").toggleClass('fa-check fa-times');
	            var perm = $(this).attr('id');

	        	$.post( "<?php echo DIR_TO_HOOKS ?>permissionChanged.php", { perm: perm, id:<?php echo $target->data()["id"]?> } );
        	}
        });
    });
</script>