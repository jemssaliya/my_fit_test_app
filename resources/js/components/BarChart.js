import {Bar, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins

export default {
    extends: Bar,
    mixins: [reactiveProp],
    // props: ['options'],
    props: [],
    data: function () {
        return {
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'VO2 Peak'
                        },
                        yAxisID: "0"
                    }],
                    xAxes: [{
                        ticks: {
                            // beginAtZero: true,
                            min: 0,
                            autoSkip: false
                        },
                        gridLines: {
                            display: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }]
                },
                legend: {
                    display: true
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return tooltipItems.yLabel;
                        }
                    }
                },
                annotation: {
                    annotations: [{
                        type: 'line',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        value: 2225,
                        endValue: 0,
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 4,
                        label: {
                            enabled: true,
                            content: 'Trendline',
                            yAdjust: -16,
                        }
                    }]
                },
                // animation: {
                // 	onComplete: function () {
                // 		var ctx = this.chart.ctx;
                // 		ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'small', Chart.defaults.global.defaultFontFamily);
                // 		ctx.fillStyle = "black";
                // 		ctx.fontSize = 10;
                // 		ctx.textAlign = 'center';
                // 		ctx.textBaseline = 'bottom';

                // 		this.data.datasets.forEach(function (dataset)
                // 		{
                // 			if(dataset.showLabel){
                // 				for (var i = 0; i < dataset.data.length; i++) {
                // 					for(var key in dataset._meta)
                // 					{
                // 						var model = dataset._meta[key].data[i]._model;
                // 						ctx.fillText(dataset.label, model.x, model.y - 5);
                // 					}
                // 				}
                // 			} else {
                // 				for (var i = 0; i < 2; i++) {
                // 					for(var key in dataset._meta)
                // 					{
                // 						if(i == 1) {
                // 							var model = dataset._meta[key].data[i]._model;
                // 							ctx.fillText(dataset.label, model.x, model.y - 5);
                // 						}
                // 					}
                // 				}
                // 			}
                // 		});
                // 	}
                // },
                responsive: true,
                maintainAspectRatio: false,
                height: 200
            }
        }
    },
    mounted() {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options)
    }
}
