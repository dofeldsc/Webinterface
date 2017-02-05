<script type="text/javascript">

$(document).ready(function(){
	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1 + x2;
	}
	function getRandomColor(alpha) {
	    var r = (Math.floor(Math.random() * 256));
	    var g = (Math.floor(Math.random() * 256));
	    var b = (Math.floor(Math.random() * 256));
	    var color = [
	    	'rgba(' + r + ',' + g + ',' + b + ','+alpha+')',
	    	'rgba(' + r + ',' + g + ',' + b + ',1)'
	    	];
		
	    return color;
	}
	var datasets=[];
	var labelsets=[];
	var charts=[];
	var colors=[];
	function drawChart(dataset,varname) {
		datasets[varname] = [];
		labelsets[varname] = [];
		for(var i in dataset) {
			datasets[varname].push(dataset[i].data);
			labelsets[varname].push(dataset[i].date);
		}
		datasets[varname].reverse()
		labelsets[varname].reverse()

		var col = getRandomColor(0.2);
		colors[varname] = col;
		var chartdata = {
			labels: labelsets[varname].slice((labelsets[varname].length)-144,(labelsets[varname].length)+1),
			datasets: [
				{
					label: varname,
					fill: true,
					backgroundColor: col[0],
					borderColor: col[1],
					pointColor: col[1],
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					pointHoverBackgroundColor: col[1],
					pointHoverBorderColor: col[1],
					pointStrokeColor: "#c1c7d1",
					strokeColor: "rgba(210, 214, 222, 1)",
					tension: 0.1,
					data: datasets[varname].slice((datasets[varname].length)-144,(datasets[varname].length)+1)
				}
			]
		};
		var ctx = $("#"+varname);
		var LineGraph = new Chart(ctx, {
			type: 'line',
			data: chartdata,
			options: {
				animation : false,
				elements: {
                    point:{
                        radius: 0.1
                    }
                },
                legend: {
		            display: false
		        },
				responsive: true,
				maintainAspectRatio : false,
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
							callback: function(label, index, labels) {
						        return "$"+addCommas(label);
						    },
							beginAtZero: true
						},
		                gridLines: {
		                    display:true
		                }   
		            }]
				},
				tooltips: {
					mode: 'x-axis',
				    callbacks: {
				    	title: function(tooltipItem,data) {
				        	return moment(tooltipItem[0].xLabel).format('D. MMMM HH:mm');
				        },
				        label: function(tooltipItem, data) {
				        	return "$"+addCommas(tooltipItem.yLabel);
				        }
				    }
				}
			}
		});
		charts[varname] = LineGraph;
		$('#'+varname+'_spinner').remove();
	};
	function updateChart(varname,periode) {
		var chart = charts[varname];
		var data = datasets[varname];
		var labels = labelsets[varname];
		var col = colors[varname];
		if (periode < 0) {
			periode=(labelsets[varname].length);
			chart.options.scales.xAxes[0].time.unit = 'day';
			chart.options.scales.xAxes[0].time.unitStepSize = 1;
		} else if (periode == 144) {
			chart.options.scales.xAxes[0].time.unit = 'minute';
			chart.options.scales.xAxes[0].time.unitStepSize = 30;
		} else if (periode == 72) {
			chart.options.scales.xAxes[0].time.unit = 'minute';
			chart.options.scales.xAxes[0].time.unitStepSize = 15;
		} else if (periode == 12) {
			chart.options.scales.xAxes[0].time.unit = 'minute';
			chart.options.scales.xAxes[0].time.unitStepSize = 5;
		}
		chart.data.labels = labelsets[varname].slice((labelsets[varname].length)-periode,(labelsets[varname].length)+1);
		chart.data.datasets = [
			{
				label: varname,
				fill: true,
				backgroundColor: col[0],
				borderColor: col[1],
				pointColor: col[1],
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				pointHoverBackgroundColor: col[1],
				pointHoverBorderColor: col[1],
				pointStrokeColor: "#c1c7d1",
				strokeColor: "rgba(210, 214, 222, 1)",
				tension: 0.3,
				data: datasets[varname].slice((datasets[varname].length)-periode,(datasets[varname].length)+1)
			}
		];
		chart.update();
	}
	<?php 
		foreach($stocks as $item){
			echo "var ".$item['Item']."=".json_encode(Stock::getHistory($item['Item'],$item['Price'])).";";
			echo 'drawChart('.$item['Item'].',"'.$item['Item'].'");';
		}
	?>
	$('.timeScale').on('change', function () {
		var varname = $(this).attr('varname');
		var displayName = $(this).attr('displayName');
		var periode = this.value;
		updateChart(varname,periode);
		periode = (periode < 0) ? 'All-Time' : (periode/6)+" Stunden";

		$('#'+varname+'_title').text(displayName+"-Preis "+periode);
    });
});
</script>