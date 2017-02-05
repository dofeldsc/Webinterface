<script type="text/javascript">
$(document).ready(function(){
    var total = <?php echo json_encode(Player::getTotalPlayerHistory());?>;
    var civ = <?php echo json_encode(Player::getTotalPlayerHistory("CivTotal"));?>;
    var cop = <?php echo json_encode(Player::getTotalPlayerHistory("CopTotal"));?>;
    var thr = <?php echo json_encode(Player::getTotalPlayerHistory("ThrTotal"));?>;
	var totalC = [];
	var civC = [];
	var copC = [];
	var thrC = [];
	var label = [];
	for(var i in total) {
		totalC.push(total[i].data);
		civC.push(civ[i].data);
		copC.push(cop[i].data);
		thrC.push(thr[i].data);
		label.push(total[i].date)
	}
	totalC.reverse()
	civC.reverse()
	copC.reverse()
	thrC.reverse()
	label.reverse();
	$('#DataSets').click(function() {
		if ($(this).attr('dataSet') == 0) {
            var data = <?php echo json_encode(Player::getNewestPlayerHistory());?>;
			var labelN = [];
			var count = [];

			for(var i in data) {
				labelN.push(data[i].date_formatted);
				count.push(data[i].count);
			}
			labelN.reverse()
			count.reverse()
			LineGraph.options.scales.xAxes[0].time.unit = 'day';
			LineGraph.options.scales.xAxes[0].time.unitStepSize = 1;
			LineGraph.data.datasets = [
				{
					label: "Neue Spieler",
					fill: true,
					backgroundColor: "rgba(59, 89, 152, 0.75)",
					borderColor: "rgba(59, 89, 152, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
					pointHoverBorderColor: "rgba(59, 89, 152, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: count
				}
			];
			LineGraph.data.labels = labelN;
			LineGraph.update();
			$("#DataSets").attr('dataSet',1);
			$("#DataSets").text("Neue Spieler");
			$('#timeScale').hide();
		} else {
			var slicer = $('#timeScale').val();
			LineGraph.data.labels = label.slice(144-slicer,145);
			LineGraph.data.datasets = [
				{
					label: "Spieler",
					fill: true,
					backgroundColor: "rgba(204, 0, 0, 0.1)",
					borderColor: "rgba(204, 0, 0, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(204, 0, 0, 1)",
					pointHoverBorderColor: "rgba(204, 0, 0, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: totalC.slice(144-slicer,145)
				},
				{
					label: "Zivilisten",
					fill: true,
					backgroundColor: "rgba(102, 0, 128, 0.1)",
					borderColor: "rgba(102, 0, 128, 1)",
					pointColor: "rgba(102, 0, 128, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(102, 0, 128, 1)",
					pointHoverBorderColor: "rgba(102, 0, 128, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: civC.slice(144-slicer,145)
				},
				{
					label: "Polizei",
					fill: true,
					backgroundColor: "rgba(0, 77, 153, 0.1)",
					borderColor: "rgba(0, 77, 153, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(0, 77, 153, 1)",
					pointHoverBorderColor: "rgba(0, 77, 153, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: copC.slice(144-slicer,145)
				},
				{
					label: "THR",
					fill: true,
					backgroundColor: "rgba(0, 128, 0, 0.1)",
					borderColor: "rgba(0, 128, 0, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(0, 128, 0, 1)",
					pointHoverBorderColor: "rgba(0, 128, 0, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: thrC.slice(144-slicer,145)
				}
			];
			LineGraph.options.scales.xAxes[0].time.unit = 'minute';
			LineGraph.options.scales.xAxes[0].time.unitStepSize = 30;
			LineGraph.update();
			$("#DataSets").attr('dataSet',0);
			$("#DataSets").text("Spieler der letzten "+slicer/6+" Stunden");
			$('#timeScale').show();
		}
	});
	$('#timeScale').on('change', function () {
		if ($('#DataSets').attr('dataSet') == 0) {
			var slicer = this.value;
			LineGraph.data.labels = label.slice(144-slicer,145);
			if (slicer == 144) {
				LineGraph.options.scales.xAxes[0].time.unit = 'minute';
				LineGraph.options.scales.xAxes[0].time.unitStepSize = 30;
			} else if (slicer == 72) {
				LineGraph.options.scales.xAxes[0].time.unit = 'minute';
				LineGraph.options.scales.xAxes[0].time.unitStepSize = 15;
			} else if (slicer == 12) {
				LineGraph.options.scales.xAxes[0].time.unit = 'minute';
				LineGraph.options.scales.xAxes[0].time.unitStepSize = 5;
			}
			LineGraph.data.datasets = [
				{
					label: "Spieler",
					fill: true,
					backgroundColor: "rgba(204, 0, 0, 0.1)",
					borderColor: "rgba(204, 0, 0, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(204, 0, 0, 1)",
					pointHoverBorderColor: "rgba(204, 0, 0, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: totalC.slice(144-slicer,145)
				},
				{
					label: "Zivilisten",
					fill: true,
					backgroundColor: "rgba(102, 0, 128, 0.1)",
					borderColor: "rgba(102, 0, 128, 1)",
					pointColor: "rgba(102, 0, 128, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(102, 0, 128, 1)",
					pointHoverBorderColor: "rgba(102, 0, 128, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: civC.slice(144-slicer,145)
				},
				{
					label: "Polizei",
					fill: true,
					backgroundColor: "rgba(0, 77, 153, 0.1)",
					borderColor: "rgba(0, 77, 153, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(0, 77, 153, 1)",
					pointHoverBorderColor: "rgba(0, 77, 153, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: copC.slice(144-slicer,145)
				},
				{
					label: "THR",
					fill: true,
					backgroundColor: "rgba(0, 128, 0, 0.1)",
					borderColor: "rgba(0, 128, 0, 1)",
					pointColor: "rgba(210, 214, 222, 1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: "rgba(0, 128, 0, 1)",
					pointHoverBorderColor: "rgba(0, 128, 0, 1)",
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.3,
					data: thrC.slice(144-slicer,145)
				}
			];
			LineGraph.update();
			$("#DataSets").text("Spieler der letzten "+slicer/6+" Stunden");
		}
    } );
	function drawChart() {
            var total = <?php echo json_encode(Player::getTotalPlayerHistory());?>;
            var civ = <?php echo json_encode(Player::getTotalPlayerHistory("CivTotal"));?>;
            var cop = <?php echo json_encode(Player::getTotalPlayerHistory("CopTotal"));?>;
            var thr = <?php echo json_encode(Player::getTotalPlayerHistory("ThrTotal"));?>;
			var totalC = [];
			var civC = [];
			var copC = [];
			var thrC = [];
			var label = [];
			for(var i in total) {
				totalC.push(total[i].data);
				civC.push(civ[i].data);
				copC.push(cop[i].data);
				thrC.push(thr[i].data);
				label.push(total[i].date)
			}
			totalC.reverse()
			civC.reverse()
			copC.reverse()
			thrC.reverse()
			label.reverse()
			var chartdata = {
				labels: label,
				datasets: [
					{
						label: "Spieler",
						fill: true,
						backgroundColor: "rgba(204, 0, 0, 0.1)",
						borderColor: "rgba(204, 0, 0, 1)",
						pointColor: "rgba(210, 214, 222, 1)",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						pointHoverBackgroundColor: "rgba(204, 0, 0, 1)",
						pointHoverBorderColor: "rgba(204, 0, 0, 1)",
						pointStrokeColor: "#c1c7d1",
						strokeColor: "rgba(210, 214, 222, 1)",
						tension: 0.3,
						data: totalC
					},
					{
						label: "Zivilisten",
						fill: true,
						backgroundColor: "rgba(102, 0, 128, 0.1)",
						borderColor: "rgba(102, 0, 128, 1)",
						pointColor: "rgba(102, 0, 128, 1)",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						pointHoverBackgroundColor: "rgba(102, 0, 128, 1)",
						pointHoverBorderColor: "rgba(102, 0, 128, 1)",
						pointStrokeColor: "#c1c7d1",
						strokeColor: "rgba(210, 214, 222, 1)",
						tension: 0.3,
						data: civC
					},
					{
						label: "Polizei",
						fill: true,
						backgroundColor: "rgba(0, 77, 153, 0.1)",
						borderColor: "rgba(0, 77, 153, 1)",
						pointColor: "rgba(210, 214, 222, 1)",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						pointHoverBackgroundColor: "rgba(0, 77, 153, 1)",
						pointHoverBorderColor: "rgba(0, 77, 153, 1)",
						pointStrokeColor: "#c1c7d1",
						strokeColor: "rgba(210, 214, 222, 1)",
						tension: 0.3,
						data: copC
					},
					{
						label: "THR",
						fill: true,
						backgroundColor: "rgba(0, 128, 0, 0.1)",
						borderColor: "rgba(0, 128, 0, 1)",
						pointColor: "rgba(210, 214, 222, 1)",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						pointHoverBackgroundColor: "rgba(0, 128, 0, 1)",
						pointHoverBorderColor: "rgba(0, 128, 0, 1)",
						pointStrokeColor: "#c1c7d1",
						strokeColor: "rgba(210, 214, 222, 1)",
						tension: 0.3,
						data: thrC
					}
				]
			};
			
			var ctx = $("#newPlayerChart");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				animation : true,
				options: {
					elements: {
	                    point:{
	                        radius: 0.1
	                    }
	                },
	                tooltips: {
	                	position: 'nearest',
				    	mode: 'x-axis',
					    callbacks: {
					    	title: function(tooltipItem,data) {
					    		if ($('#DataSets').attr('dataSet') == 1) {
					    			return moment(tooltipItem[0].xLabel).format('D. MMMM');
					    		} else {
					    			return moment(tooltipItem[0].xLabel).format('D. MMMM HH:mm');
					    		}
					        }
					    }
				    },
					responsive: true,
					maintainAspectRatio : true,
					scales: {
					    xAxes: [{
					    	type: 'time',
							time: {
								unitStepSize: 30,
								round: true,
								minUnit: 'minute',
								unit: 'minute',
			                    displayFormats: {
			                        minute: 'dd HH:mm',
			                        hour: 'DD MMM HH:mm',
			                        day: 'DD MMM'
			                    }
			                }
			            }],
					    yAxes: [{
					    	ticks: {
					    		suggestedMax: 10,
					    		beginAtZero: true
					    	},
			                gridLines: {
			                    display:true
			                }   
			            }]
					}
				}
			});
			return LineGraph;
		};
	var LineGraph = drawChart();
});
</script>