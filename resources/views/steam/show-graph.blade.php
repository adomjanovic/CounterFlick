@extends('layouts.master')
@section('content')
    <script type="text/javascript" src="{{ URL::to('/public/js/canvasjs.min.js') }}"></script>
	<script type="text/javascript">
		window.onload = function () {
            var steamid = 0, numOfdata = 0, cnt = 0, kill = 0, death = 0, killDiff = 0, deathDiff = 0;
            var steamid = {!! $steamid !!};
            var counter = localStorage.length;
            var date = [], wins = [], accuracy = [], headshoots = [], numOfStat = [];
            for (i = 0; i <= counter; i++) {
                if (localStorage.getItem('counter_flick_' + steamid + '_' + i)) {
                    numOfStat[cnt] = JSON.parse(localStorage.getItem('counter_flick_' + steamid + '_' + i));
                    cnt++;
                }
            }
            if (cnt > 10) {
                cnt -= 10;
                for (i = 0; i < 10; i++ ) {
                    wins[i] = numOfStat[cnt].win;
                    accuracy[i] = numOfStat[cnt].accuracy;
                    headshoots[i] = numOfStat[cnt].headshoots;
                    date[i] = numOfStat[cnt].timestamp;
                    kill = numOfStat[cnt].total_kills;
                    death = numOfStat[cnt].total_deaths;
                }
                kill = numOfStat[cnt-1].total_kills - numOfStat[cnt-2].total_kills;
                death = numOfStat[cnt-1].total_deaths - numOfStat[cnt-2].total_deaths;
            } else {
                for (i = 0; i < cnt; i++ ) {
                    wins[i] = numOfStat[i].win;
                    accuracy[i] = numOfStat[i].accuracy;
                    headshoots[i] = numOfStat[i].headshoots;
                    date[i] = numOfStat[i].timestamp;
                    kill = numOfStat[i].total_kills;
                    death = numOfStat[i].total_deaths;
                }
                killDiff = numOfStat[i-1].total_kills - numOfStat[i-2].total_kills;
                deathDiff = numOfStat[i-1].total_deaths - numOfStat[i-2].total_deaths;
            }
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "Graph-history Statistic",
					fontSize: 26
				},
				animationEnabled: true,
				axisX: {
					gridColor: "Silver",
					tickColor: "silver",
					valueFormatString: "DD.MM.YY"
				},
				toolTip: {
					shared: true
				},
				theme: "theme1",
				axisY: {
					gridColor: "Silver",
					tickColor: "silver"
				},
				legend: {
					verticalAlign: "center",
					horizontalAlign: "right"
				},
				data: [
				{
					type: "line",
					showInLegend: true,
					lineThickness: 2,
					name: "WIN %",
					markerType: "square",
					color: "#2026e5",
					dataPoints: [
					{ x: new Date(date[0]), y: wins[0] },
					{ x: new Date(date[1]), y: wins[1] },
					{ x: new Date(date[2]), y: wins[2] },
					{ x: new Date(date[3]), y: wins[3] },
					{ x: new Date(date[4]), y: wins[4] },
					{ x: new Date(date[5]), y: wins[5] },
					{ x: new Date(date[6]), y: wins[6] },
					{ x: new Date(date[7]), y: wins[7] },
					{ x: new Date(date[8]), y: wins[8] },
					{ x: new Date(date[9]), y: wins[9] },
					{ x: new Date(date[10]), y: wins[10] },
					]
				},
				{
					type: "line",
					showInLegend: true,
					name: "ACCURACY %",
					color: "#ce2323",
					lineThickness: 2,

					dataPoints: [
                        { x: new Date(date[0]), y: accuracy[0] },
    					{ x: new Date(date[1]), y: accuracy[1] },
    					{ x: new Date(date[2]), y: accuracy[2] },
    					{ x: new Date(date[3]), y: accuracy[3] },
    					{ x: new Date(date[4]), y: accuracy[4] },
    					{ x: new Date(date[5]), y: accuracy[5] },
    					{ x: new Date(date[6]), y: accuracy[6] },
    					{ x: new Date(date[7]), y: accuracy[7] },
    					{ x: new Date(date[8]), y: accuracy[8] },
    					{ x: new Date(date[9]), y: accuracy[9] },
    					{ x: new Date(date[10]), y: accuracy[10] },
    					]
				},
                {
                    type: "line",
                    showInLegend: true,
                    lineThickness: 2,
                    name: "HEADSHOOTS %",
                    markerType: "square",
                    color: "orange",
                    dataPoints: [
                        { x: new Date(date[0]), y: headshoots[0] },
    					{ x: new Date(date[1]), y: headshoots[1] },
    					{ x: new Date(date[2]), y: headshoots[2] },
    					{ x: new Date(date[3]), y: headshoots[3] },
    					{ x: new Date(date[4]), y: headshoots[4] },
    					{ x: new Date(date[5]), y: headshoots[5] },
    					{ x: new Date(date[6]), y: headshoots[6] },
    					{ x: new Date(date[7]), y: headshoots[7] },
    					{ x: new Date(date[8]), y: headshoots[8] },
    					{ x: new Date(date[9]), y: headshoots[9] },
    					{ x: new Date(date[10]), y: headshoots[10] },
    					]
                },
				],
				legend: {
					cursor: "pointer",
					itemclick: function (e) {
						if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
							e.dataSeries.visible = false;
						}
						else {
							e.dataSeries.visible = true;
						}
						chart.render();
					}
				}
			});
			chart.render();
        // pie chart
            var chart = new CanvasJS.Chart("pie-chartContainer",
            {
                title:{
                    text: "K/D Ratio"
                },
                        animationEnabled: true,
                data: [
                {
                    type: "doughnut",
                    startAngle: 90,
                    toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>",
                    showInLegend: true,
                  explodeOnClick: false, //**Change it to true
                    dataPoints: [
                        {y: kill, indexLabel: "Total kills #percent% | +" + killDiff,
                            legendText: "Total kills" },
                        {y: death, indexLabel: "Total deaths #percent% | +" + deathDiff,
                            legendText: "Total deaths" },
                    ]
                }
                ]
            });
            chart.render();
            }
        </script>

    <div id="pie-chartContainer" style="height: 400px; width: 90%; margin: auto; padding-top: 25px"></div>
	<div id="chartContainer" style="height: 400px; width: 90%; margin: auto; padding: 50px 0"></div>
@endsection
