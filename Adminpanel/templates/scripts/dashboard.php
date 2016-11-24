<script type="text/javascript">
$(document).ready(function(){
    function drawChart() {
			console.log();
            var data = <?php echo json_encode(Player::getNewestPlayerHistory());?>;
			var label = [];
			var count = [];

			for(var i in data) {
				label.push(data[i].date);
				count.push(data[i].count);
			}

			var chartdata = {
				labels: label,
				datasets: [
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
				]
			};
			
			var ctx = $("#newPlayerChart");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				animation : true,
				options: {
					scales: {
					    xAxes: [{
			                gridLines: {
			                    display:false
			                }
			            }],
					    yAxes: [{
					    	ticks: {
					    		suggestedMax: 60,
					    		beginAtZero: true
					    	},
			                gridLines: {
			                    display:false
			                }   
			            }]
					}
				},
			});
		};
	drawChart();
});
</script>