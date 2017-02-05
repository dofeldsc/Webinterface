<script type="text/javascript">
	var weaponList;
	var ClothingList;
	var ItemList;
	var OtherList;

    function send_to_game(type) {
		switch(type) {
		    case "weapon":
		        var list = weaponList;
		        break;
		    case "clothing":
		        var list = ClothingList;
		        break;
		    case "items":
		        var list = ItemList;
		        break;
		    case "other":
		        var list = OtherList;
		        break;
		}
		var items = list.rows( { selected: true } );
		if (items.count() == 0) {
			swal("Du hast kein Item ausgewählt","", "error");
		} else {
			var arr = [];
			for (var i = 0; i < items.data().length; i++) {
				arr.push(items.data()[i]);
			}
			$.post( "<?php echo DIR_TO_HOOKS ?>itemSend.php", { items: JSON.stringify(arr)},function(data,status){
				if(data==0) {
					alertify.error("Es ist ein Fehler aufgetreten.<br>Bitte versuche es später nochmal");
				} else {
					alertify.success(items.count()+" Item/s wurde ins Spiel gesendet.<br>Das/Die Item/s werden in kürze verfügbar sein.");
					items.remove().draw();
				}
	        } );
		}
    }

    function create_auction(type) {
		switch(type) {
		    case "weapon":
		        var list = weaponList;
		        break;
		    case "clothing":
		        var list = ClothingList;
		        break;
		    case "items":
		        var list = ItemList;
		        break;
		    case "other":
		        var list = OtherList;
		        break;
		}
		var items = list.rows( { selected: true } );
		if (items.count() == 0) {
			swal("Du hast kein Item ausgewählt","", "error");
		} else if (items.count() > 1) {
			swal("Du kannst immer nur mit einem Item eine Auktion erstellen","", "error");
		} else {
			$('#CA_articleDesc').text(items.data()[0][1]);
			$('#create_auction').modal('show');
			$('#ca_create').attr('type',type);
		}
    }

    $(document).ready(function(){
        weaponList = $('#WeaponList').DataTable({
            "pageLength": 25,
            "responsive": false,
            "order": [ 1, 'asc' ],
            "select": {
	            "style": 'multi'
	        },
	        "columnDefs": [ 
            {
                "targets": 0,
                "visible": false
            }],
            "pagingType": "full_numbers",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
                "select": {
	                "rows": {
	                    "_": "Du hast %d Items ausgewählt",
	                    "0":""
	                }
	            }
            }
        });

        $('#trigger_clo').click(function() {
			if (!ClothingList) {
				ClothingList = $('#ClothingList').DataTable({
		            "pageLength": 25,
		            "responsive": false,
		            "order": [ 1, 'asc' ],
		            "select": {
			            "style": 'multi'
			        },
			        "columnDefs": [ 
		            {
		                "targets": 0,
		                "visible": false
		            }],
		            "pagingType": "full_numbers",
		            "language": {
		                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
		                "select": {
			                "rows": {
			                    "_": "Du hast %d Items ausgewählt",
			                    "0":""
			                }
			            }
		            }
		        });
			}
        });

        $('#trigger_items').click(function() {
			if (!ItemList) {
		        ItemList = $('#ItemList').DataTable({
		            "pageLength": 25,
		            "responsive": false,
		            "order": [ 1, 'asc' ],
		            "select": {
			            "style": 'multi'
			        },
			        "columnDefs": [ 
		            {
		                "targets": 0,
		                "visible": false
		            }],
		            "pagingType": "full_numbers",
		            "language": {
		                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
		                "select": {
			                "rows": {
			                    "_": "Du hast %d Items ausgewählt",
			                    "0":""
			                }
			            }
		            }
		        });
			}
        });

        $('#trigger_oth').click(function() {
			if (!OtherList) {
				OtherList = $('#OtherList').DataTable({
		            "pageLength": 25,
		            "responsive": false,
		            "order": [ 1, 'asc' ],
		            "select": {
			            "style": 'multi'
			        },
			        "columnDefs": [ 
		            {
		                "targets": 0,
		                "visible": false
		            }],
		            "pagingType": "full_numbers",
		            "language": {
		                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
		                "select": {
			                "rows": {
			                    "_": "Du hast %d Items ausgewählt",
			                    "0":""
			                }
			            }
		            }
		        });
			}
        });

        $('#CA_datepicker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            locale: 'de',
            minDate: 'now'
        });

        $('#ca_create').click(function() {
        	var errmsg = [];
    		var expireDate;
			switch($('#ca_create').attr('type')) {
			    case "weapon":
			        var list = weaponList;
			        break;
			    case "clothing":
			        var list = ClothingList;
			        break;
			    case "items":
			        var list = ItemList;
			        break;
			    case "other":
			        var list = OtherList;
			        break;
			}

			var items = list.rows( { selected: true } );

			if (items.count() == 0) {
				errmsg.push("Kein Item ausgewählt");
			} else if (items.count() > 1) {
				errmsg.push("Mehr als ein Item ausgewählt");
			}

    		if (!$('#CA_buyNow').val()) {
    			errmsg.push("Sofortkaufpreis fehlt");
    		} else if ($('#CA_buyNow').val() <= 0) {
    			errmsg.push("Sofortkaufpreis muss größer als Null sein");
    		}

    		if (!$('#CA_startBet').val()) {
    			errmsg.push("Startgebot fehlt");
    		} else if ($('#CA_startBet').val() <= 0) {
    			errmsg.push("Startgebot muss größer als Null sein");
    		}

    		if (!$('#CA_datepicker').val()) {
    			errmsg.push("Gültigkeit fehlt");
    		} else {
    			expireDate = $('#CA_datepicker').data("DateTimePicker").date();
	    		var now = moment(new Date());
	    		var dur = moment.duration(expireDate.diff(now));
	    		if (dur.asHours() > 72) {
	    			errmsg.push("Gültigkeit überschreitet die maximal erlaubte Gültigkeit");
	    		}

	    		if (dur.asHours() < 2) {
	    			errmsg.push("Gültigkeit unterschreitet die minimal erlaubte Gültigkeit");
	    		}
    		}
    		
    		if (errmsg.length > 0) {
    			var text = "Folgende Fehler wurden gefunden:<br><h4 class='text-danger'>";
    			for (var i = 0; i < errmsg.length; i++) {
    				if (i == errmsg.length -1) {
    					text += errmsg[i]+"</h4>";
    				} else {
    					text += errmsg[i]+",<br>";
    				}
    			}
    			swal({
	    				title: "Fehler bei der Eingabe",
	    				text: text, 
	    				type: "error",
	    				html: true
    			    });
    		} else {
    			data = {
    				itemID: items.data()[0][0],
    				buyNow: Math.round($('#CA_buyNow').val()),
    				startBet: Math.round($('#CA_startBet').val()),
    				expireDate: new Date(expireDate),
    				pid: "<?php echo $user->steamID() ?>"
    			};
    			$.post( "<?php echo DIR_TO_HOOKS ?>createArticle.php", { itemInfo: JSON.stringify(data)},function(data,status){
				if(data==0) {
					alertify.error("Es ist ein Fehler aufgetreten.<br>Bitte versuche es später nochmal");
				} else {
					alertify.success("Auktion wurde erstellt.<br>Link zur Auktion: <a target='_blank' href='<?php echo DIR_TO_SITES; ?>article?id="+data+"'>"+items.data()[0][1]+"</a>",10);
					items.remove().draw();
					$('#create_auction').modal('hide');
				}
	        } );
    		}
        });

    });
</script>