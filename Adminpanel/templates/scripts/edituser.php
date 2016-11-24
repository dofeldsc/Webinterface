<script type="text/javascript">
    $(document).ready(function(){
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