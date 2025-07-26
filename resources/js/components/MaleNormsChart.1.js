import {Line, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins

export default {
    extends: Line,
    mixins: [reactiveProp],
    // props: ['options'],
    props: [],
    data: function () {
        return {
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#fff',
                            fontSize: 15,
                        },
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'VO2 ml/kg/min'
                        },
                        // stacked: true
                    }],
                    xAxes: [{
                        ticks: {
                            // beginAtZero: true,
                            autoSkip: false,
                            fontColor: '#fff',
                            fontSize: 15,
                        },
                        gridLines: {
                            display: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Age'
                        },
                        type: 'linear',
                        position: 'bottom',
                        fillText: 'adff'
                    }]
                },
                legend: {
                    labels: {
                        usePointStyle: true, // show legend as point instead of box
                        fontSize: 10 // legend point size is based on fontsize
                    }
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
                animation: {
                    onComplete: function () {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        ctx.fillStyle = "black";
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset) {
                            if (dataset.showLabel) {
                                for (var i = 0; i < dataset.data.length; i++) {
                                    for (var key in dataset._meta) {
                                        var model = dataset._meta[key].data[i]._model;
                                        ctx.fillText(dataset.label, model.x, model.y - 5);
                                    }
                                }
                            } else {
                                for (var i = 0; i < 2; i++) {
                                    for (var key in dataset._meta) {
                                        if (i == 1) {
                                            var model = dataset._meta[key].data[i]._model;
                                            ctx.fillText(dataset.label, model.x, model.y - 5);
                                        }
                                    }
                                }
                            }
                        });
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                height: 200,
                elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                }
            },
        }
    },
    mounted() {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options)
    }
}
