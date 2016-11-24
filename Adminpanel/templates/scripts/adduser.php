<script type="text/javascript">
    $(document).ready(function(){
        $(".permissions").click(function () {
            $(this).toggleClass('bg-green bg-red');
            $(this).children("i").toggleClass('fa-check fa-times');
            var perm = document.getElementsByClassName("permissions bg-green");
            
            
            var array = [];
            $(".permissions").each(function() {
                if($(this).hasClass("bg-green")) {
                    array.push($(this).attr("id"));
                }
                document.getElementById('Permissions').value = JSON.stringify(array);
            });
        });
    });
</script>