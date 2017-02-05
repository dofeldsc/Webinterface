<script type="text/javascript">
	var Expire = false;
	var timing = 5000;
	var lastID = <?php echo $article->getLastBetID(); ?>;
	var currentPrice = <?php echo $articleData['currentPrice']; ?>;
	var sold = <?php echo $articleData['sold']; ?>;
	var tl = <?php echo $articleData['time_left']; ?>;

	function update_layout(periods) {
		var form = $('#expireCountDown').countdown('option','layout');
		if (periods[5] == 0 && form != '{sn} {sl}' && periods[4] == 0) {
			$('#expireCountDown').countdown('option','layout','{sn} {sl}');
			$('#expireCountDown').addClass('text-warning');
			timing = 1000;
		} else if (periods[4] == 0 && form != '{sn} {sl}' && form != '{mn} {ml} {sn} {sl}') {
			$('#expireCountDown').countdown('option','layout','{mn} {ml} {sn} {sl}');
		} else if (periods[3] == 0 && form != '{sn} {sl}' && form != '{mn} {ml} {sn} {sl}' && form != '{hn} {hl} {mn} {ml} {sn} {sl}') {
			$('#expireCountDown').countdown('option','layout','{hn} {hl} {mn} {ml} {sn} {sl}');
		}
	}

	function close_bet() {
		if (!Expire) {//Scheiß Plugin Triggert manchmal 2x 
			Expire = true;	
			alertify.error("Das Angebot ist ausgelaufen.");
			$('#expireCountDown').countdown('destroy');
			$('#expireCountDown').text('Artikel verkauft');
			$('#expireCountDown').toggleClass('is-countdown text-danger');
		}
	}

	function req_betData() {
		$.ajax({
	        url: "<?php echo DIR_TO_HOOKS; ?>articleData.php",
	        type: "post",
	        data: { id: "<?php echo $articleData['a_id']; ?>",betId:lastID},
	        dataType:"json",
	        success:update_betData
	    });
	}

	function loop_betData() {
		req_betData()
		if (sold == 0 && tl < 0) {
			window.setTimeout(loop_betData, timing);
		}
	}

	function update_table(data) {
		
		for (var i = 0; i < data.length; i++) {
			var amnt = data[i].amount
			if ($.isNumeric(data[i].amount)) {amnt = numeral(data[i].amount).format('$0,0')}
			betHistory.row.add({0: data[i].id,1: data[i].person_name,2: amnt,3: moment(data[i].timestamp).format('DD.MM.YYYY HH:mm')});
			lastID = parseInt(data[i].id);
		}
		betHistory.draw();
	}

	function update_betData(data) {
		if (data) {
			if (currentPrice != data.currentPrice) {
				currentPrice = data.currentPrice;
				$('#bet_amount').val(currentPrice);
				$('#currentHolder').text(data.currentHolder_name);
				$('#currentPrice').text(numeral(data.currentPrice).format('$0,0'));
				alertify.notify("Der Preis wurde aktualisiert", 'custom');
				update_table(data.betHistory);
			}
			if (data.sold == 1 && sold == 0) {
				sold = data.sold;
				$('#holderTitle').text('Käufer');
				$('#currentHolder').text(data.currentHolder_name);
				alertify.notify("Der Artikel wurde verkauft", 'custom');
				$('#expireCountDown').countdown('destroy');
				$('#expireCountDown').text('Artikel verkauft');
				$('#expireCountDown').toggleClass('is-countdown text-danger');
				update_table(data.betHistory);
			}
		}
	}

	function bet_confirmed(data) {
		if (data == 3) {
			alertify.error("Dein Online-Konto ist dafür nicht ausreichend gedeckt.");
		} else if (data == 1) {
			alertify.success("Dein Gebot wird verarbeitet und sollte gleich angezeigt werden.");
		} else if (data == 2) {
			alertify.error("Dein Gebot wurde abgehlent, da jmd. anderes bereits dein Gebot überboten hat.");
		} else if(data == -1) {
			alertify.error("Du bist nicht eingeloggt");
		} else {
			alertify.error("Es gab einen Fehler mit der Datenbank");
		}
		req_oBank();
	}

	function buyNow_confirm(data) {
		if (data == 3) {
			alertify.error("Dein Online-Konto ist dafür nicht ausreichend gedeckt.");
		} else if (data == 1) {
			alertify.success("Du hast den Artikel gekauft. Die Daten sollten gleich aktualisiert sein.");
		} else if (data == 2) {
			alertify.error("Jemand anderes hat in der zwischen Zeit den Artikel gekauft.");
		} else if(data == -1) {
			alertify.error("Du bist nicht eingeloggt");
		} else {
			alertify.error("Es gab einen Fehler mit der Datenbank");
		}
		req_oBank();
	}
    $(document).ready(function(){
    	
		expireDate = new Date("<?php echo date("m d Y H:i:s", strtotime($articleData['expireDate'])); ?>");
		if (sold == 0) {
			$('#expireCountDown').countdown({
				until: expireDate,
				layout: '{dn} {dl} {hn} {hl} {mn} {ml} {sn} {sl}',
				onExpiry: close_bet,
				alwaysExpire: true,
				onTick: update_layout,
				tickInterval: 1
			}); 
		} else {
			$('#expireCountDown').text('Artikel verkauft');
			$('#expireCountDown').addClass('text-danger');
		}
    	betHistory = $('#BetHistory').DataTable({
            "pageLength": 10,
            "responsive": false,
            "pagingType": "full_numbers",
            "order": [ 0, 'desc' ],
            "columnDefs": [{
                "visible": false,
                "targets": 0,
            },
            {
            	"orderable" : false,
            	"targets" : [1,2,3]
            }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    	$('#bet_submitt').click(function() {
    		if (sold == 1) {
    			alertify.error("Der Artikel ist bereits verkauft.");
    			$('#bet').modal('hide');
    			return;
    		}
            if ($('#bet_amount').val() <= 0) {
                swal("Falsche eingabe","Der eingegebene Betrag, darf nicht Null oder negativ sein.", "error");
            } else if (currentPrice >= $('#bet_amount').val()) {
            	swal("Falsche eingabe","Der eingegebene Betrag, ist kleiner oder genau so hoch, wie das momentane Höchstgebot.", "error");
            } else {
            	$('#bet').modal('hide');
				$.ajax({
			        url: "<?php echo DIR_TO_HOOKS; ?>addBet.php",
			        type: "post",
			        data: { id: "<?php echo $articleData['a_id']; ?>",pid: "<?php echo $user->steamID(); ?>", amnt : $('#bet_amount').val()},
			        dataType:"json",
			        success:bet_confirmed
			    });
            }
        });

    	$('#buyNow').click(function() {
    		if (sold == 1) {
    			alertify.error("Der Artikel ist bereits verkauft.");
    			return;
    		}
    		swal({
				title: "Bist du dir sicher?",
				text: "Möchtest du den Artikel wirklich sofortkaufen?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Sofortkaufen",
				cancelButtonText: "Abbrechen",
				closeOnConfirm: true,
				closeOnCancel: true
            },

            function(isConfirm){
				if (isConfirm) {
					$.ajax({
				        url: "<?php echo DIR_TO_HOOKS; ?>articleBuyNow.php",
				        type: "post",
				        data: { id: "<?php echo $articleData['a_id']; ?>",pid: "<?php echo $user->steamID(); ?>"},
				        dataType:"json",
				        success:buyNow_confirm
				    });
				}
			}
			);
        });

		loop_betData()
    });
</script>