<script type="text/javascript">
    var transactionList;
    var ingameList;
    function addZero (number) {
        if (number < 10) {
            
            return "0" + number.toString();
        } else {
            return number.toString();
        }
    }
    function yesNo (number) {
      if (number == 1) {
        return "Ja";
      } else {
        return "Nein";
      }
    };
    $(document).ready(function(){
        $(".license").on('switchChange.bootstrapSwitch', function () {
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
                var rawDate = new Date($('#datepicker').data("DateTimePicker").date());
                var year = addZero(rawDate.getFullYear());
                var month = addZero(rawDate.getMonth() + 1);
                var day = addZero(rawDate.getDate());
                var hr = addZero(rawDate.getHours());
                var min = addZero(rawDate.getMinutes());
                var date = year + month + day + hr + min;
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

        $('#Invis_Backpack').click(function() {
            var crnt = $(this).attr('state');
            var multi;
            if (crnt > 0) {
              multi = crnt * 1000;
            } else {
              crnt = 0;
              multi = new Date().getTime();
            }
            var text;
            var title;
            var newDate;
            if ($('#invis_range').is("span")) {
                var str = '<select class="form-control" name="AddDays" id="invis_range">';
                str = str + '<option value="-1">Entfernen</option>';
                str = str + '<option selected value="30">30</option>';
                str = str + '<option value="60">60</option>';
                str = str + '<option value="90">90</option>';
                str = str + '<option value="360">1 Jahr</option>';
                str = str + '</select>';
                $('#invis_range').replaceWith(str); 
            } else if ($('#invis_range').is("select")) {
                var val = $('#invis_range').val();
                if (val < 0) {
                  text = "NEIN";
                  title = "";
                  newDate = 0;
                } else {
                  text = "JA";
                  newDate = Math.round(val * 24 * 60 * 60 * 1000 + multi);
                  title = new Date(newDate).toLocaleString();
                  newDate = newDate/1000;
                }
                swal({
                  title: "Bist du dir sicher?",
                  text: "Möchtest du wirklich den unsichtbaren Rucksack ändern?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ändern",
                  cancelButtonText: "Abbrechen",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },

                function(isConfirm){
                  if (isConfirm) {
                    $.post( "<?php echo DIR_TO_HOOKS ?>dateChanged.php", {id:"<?php echo Input::get('id') ?>", value: val });
                    swal("Unsichtbarer Rucksack geändert!", "", "success");
                    $('#invis_range').replaceWith('<span class="info-box-number" id="invis_range" title="'+title+'">'+text+'</span>');
                    $("#Invis_Backpack").attr('state',newDate);
                  } else {
                    if (crnt > 0) {
                      text = "JA";
                    } else {
                      text = "NEIN";
                    }
                    title = new Date(crnt * 1000).toLocaleString();
                    $('#invis_range').replaceWith('<span class="info-box-number" id="invis_range" title="'+title+'">'+text+'</span>');
                  }
                });
            }
        });

        $('#Admin_trigger').click(function() {
            var crnt = $(this).attr('state');
            if ($('#admin_rang').is("span")) {
                var str = '<select class="form-control" name="AddRank" id="admin_rang">';
                for (var i = 5; i >= 0; i--) {
                    if (i == crnt) {var exte = 'selected';} else {var exte = '';}
                    str = str + '<option value="'+i+'" '+exte+'>'+i+'</option>';
                }
                str = str + '</select>';
                $('#admin_rang').replaceWith(str); 
            } else if ($('#admin_rang').is("select")) {
                var val = $('#admin_rang').val();

                swal({
                  title: "Bist du dir sicher?",
                  text: "Möchtest du wirklich das Admin Level ändern?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ändern",
                  cancelButtonText: "Abbrechen",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },
                function(isConfirm){
                  if (isConfirm) {
                    $.post( "<?php echo DIR_TO_HOOKS ?>levelChanged.php", { type: "adminlevel", id:"<?php echo Input::get('id') ?>", value: val });
                    swal("Admin Level geändert!", "", "success");
                    $('#admin_rang').replaceWith('<span class="info-box-number" id="admin_rang">'+val+'</span>');
                    $("#Admin_trigger").attr('state',val);
                  } else {
                    $('#admin_rang').replaceWith('<span class="info-box-number" id="admin_rang">'+crnt+'</span>');
                  }
                });
            }
        });

        $('#NB_trigger').click(function() {
            var crnt = $(this).attr('state');
            if ($('#NB_rang').is("span")) {
                var str = '<select class="form-control" name="AddRank" id="NB_rang">';

                if (crnt == 0) {
                  str = str + '<option value="1">Ja</option>';
                  str = str + '<option value="0" selected>Nein</option>';
                } else {
                  str = str + '<option value="1" selected>Ja</option>';
                  str = str + '<option value="0">Nein</option>';
                };

                str = str + '</select>';
                $('#NB_rang').replaceWith(str); 
            } else if ($('#NB_rang').is("select")) {
                var val = $('#NB_rang').val();

                swal({
                  title: "Bist du dir sicher?",
                  text: "Möchtest du wirklich das NoBody Level ändern?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ändern",
                  cancelButtonText: "Abbrechen",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },
                function(isConfirm){
                  if (isConfirm) {
                    $.post( "<?php echo DIR_TO_HOOKS ?>levelChanged.php", { type: "nobody_level", id:"<?php echo Input::get('id') ?>", value: val });
                    swal("NoBody Level geändert!", "", "success");
                    $("#NB_trigger").attr('state',val);
                    $('#NB_rang').replaceWith('<span class="info-box-number" id="NB_rang">'+yesNo(val)+'</span>');
                  } else {
                    $('#NB_rang').replaceWith('<span class="info-box-number" id="NB_rang">'+yesNo(crnt)+'</span>');
                  }
                });
            }
        });

        $('#THR_trigger').click(function() {
            var crnt = $(this).attr('state');
            if ($('#thr_rang').is("span")) {
                var str = '<select class="form-control" name="AddRank" id="thr_rang">';
                for (var i = 5; i >= 0; i--) {
                    if (i == crnt) {var exte = 'selected';} else {var exte = '';}
                    str = str + '<option value="'+i+'" '+exte+'>'+i+'</option>';
                }
                str = str + '</select>';
                $('#thr_rang').replaceWith(str); 
            } else if ($('#thr_rang').is("select")) {
                var val = $('#thr_rang').val();

                swal({
                  title: "Bist du dir sicher?",
                  text: "Möchtest du wirklich das THR Level ändern?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ändern",
                  cancelButtonText: "Abbrechen",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },
                function(isConfirm){
                  if (isConfirm) {
                    console.log(val);
                    $.post( "<?php echo DIR_TO_HOOKS ?>levelChanged.php", { type: "thrlevel", id:"<?php echo Input::get('id') ?>", value: val });
                    swal("THR Level geändert!", "", "success");
                    $('#thr_rang').replaceWith('<span class="info-box-number" id="thr_rang">'+val+'</span>');
                    $("#THR_trigger").attr('state',val);
                  } else {
                    $('#thr_rang').replaceWith('<span class="info-box-number" id="thr_rang">'+crnt+'</span>');
                  }
                });
            }
        });

        $('#Cop_trigger').click(function() {
            var crnt = $(this).attr('state');
            if ($('#cop_rang').is("span")) {
                var str = '<select class="form-control" name="AddRank" id="cop_rang">';
                for (var i = 12; i >= 0; i--) {
                    if (i == crnt) {var exte = 'selected';} else {var exte = '';}
                    str = str + '<option value="'+i+'" '+exte+'>'+i+'</option>';
                }
                str = str + '</select>';
                $('#cop_rang').replaceWith(str); 
            } else if ($('#cop_rang').is("select")) {
                var val = $('#cop_rang').val();

                swal({
                  title: "Bist du dir sicher?",
                  text: "Möchtest du wirklich das Polizei Level ändern?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ändern",
                  cancelButtonText: "Abbrechen",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },
                function(isConfirm){
                  if (isConfirm) {
                    $.post( "<?php echo DIR_TO_HOOKS ?>levelChanged.php", { type: "coplevel", id:"<?php echo Input::get('id') ?>", value: val });
                    swal("Polizei Level geändert!", "", "success");
                    $('#cop_rang').replaceWith('<span class="info-box-number" id="cop_rang">'+val+'</span>');
                    $("#Cop_trigger").attr('state',val);
                  } else {
                    $('#cop_rang').replaceWith('<span class="info-box-number" id="cop_rang">'+crnt+'</span>');
                  }
                });
            }
        });

        $('#datepicker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            locale: 'de',
            minDate: 'now'
        });

        $("[type='checkbox']").bootstrapSwitch();
        $('#TypeFilter').on('change', function () {
          if (transactionList) {
            transactionList.columns(2).search(this.value).draw();
          }
        } );
        $('#SlogFilter').on('change', function () {
          if (ingameList) {
            var term = '\\b' + $(this).val() + '\\b';
      
            ingameList.columns(2).search(term,true,false).draw();
          }
        } );
        $('#trigger_trans').click(function() {
          if (!transactionList) {
            transactionList = $('#Transactions').DataTable({
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": "../templates/tabledata/transactions.php/?pid=<?php echo $playerInfo['playerid'] ?>",
                "pagingType": "full_numbers",
                "order": [ 0, 'desc' ],
                "columnDefs": [ 
                {
                    "targets": [1,-3,-4],
                    "orderable": false
                },
                {
                    "targets": [-1,-2],
                    "visible": false
                }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });
          }
        });

        $('#trigger_slogs').click(function() {
          if (!ingameList) {
            ingameList = $('#sLogTabel').DataTable({
                "pageLength": 10,
                "responsive": true,
                "pagingType": "full_numbers",
                "order": [ 0, 'desc' ],
                "columnDefs": [ 
                {
                  "targets": [0,1,2,3,4],
                  "orderable": false
                },
                {
                  "targets": 2,
                  "visible": false
                }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });
          }
        });
    });
</script>