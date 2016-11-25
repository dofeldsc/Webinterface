<script type="text/javascript">
    $(document).ready(function() {
        var vehiclelist = $('#VehicleList').DataTable({
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            "responsive": false,
            "ajax": "../templates/tabledata/vehicles.php",
            "pagingType": "full_numbers",
            <?php if($user->hasPermision("VehicleEdit") || $user->hasPermision("VehicleReset")): ?>
            "columnDefs": [ {
                "orderable": false,
                "targets": -1,
                "data": null,
                "defaultContent": "<?php if($user->hasPermision("VehicleEdit")): ?><a class='edit' title='Bearbeiten'><i class='fa fa-pencil pull-right'></i></a><?php endif;?><?php if($user->hasPermision("VehicleReset")): ?><a class='store' title='In Garage stellen'><i class='fa fa-sign-in pull-right'></i></a><?php endif;?>"
            } ],
            <?php endif;?>
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            },
            "oSearch": {
                "sSearch": "<?php echo (!Input::get('search'))? "":Input::get('search'); ?>"
            }
        });
        $('#VehicleList tbody').on( 'click', 'a.edit', function () {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = vehiclelist.row(current_row).data();
            document.location.href = "editvehicle.php/?id="+data[10];
        });
        $('#VehicleList tbody').on( 'click', 'a.store', function () {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = vehiclelist.row(current_row).data();
            if (data[8] != '<span class="label label-success">Nein</span>' || data[6] == '<span class="label label-success">Okay</span>') {
                swal("Fehler!", "Nur zerstörte Fahrzeuge, die nicht im ChopShop sind können zurückgesetzt werden.", "error");
            } else {
                swal({
                  title: "Bist du sicher?",
                  text: "Möchtest du das Fahrzeug wirklich zurücksetzen?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Zurücksetzen",
                  closeOnConfirm: false
                },
                function(){
                    swal("Zurückgesetzt!", "Das Fahrzeug wurde wieder in die Garage gestellt.", "success");
                    document.location.href = "vehicles.php/?action=reset&id="+data[10];
                });
            }
        });
    } );
</script>