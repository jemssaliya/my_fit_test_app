import {Scatter, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins

export default {
    extends: Scatter,
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
                            fontSize: 16
                        },
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            fontColor: '#000000',
                            fontSize: 18,
                            labelString: 'Heart Rate'
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            fontSize: 16
                        },
                        gridLines: {
                            display: false
                        },
                        scaleLabel: {
                            display: true,
                            fontColor: '#000000',
                            fontSize: 18,
                            labelString: 'VO2 ml/kg/min'
                        }
                    }]
                },
                legend: {
                    display: false,
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
                animation: {
                    onProgress: function () {
                        var ctx = this.chart.ctx;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        this.data.datasets.forEach(function (dataset) {
                            if (dataset.showLabel) {
                                for (var i = 0; i < dataset.data.length; i++) {
                                    for (var key in dataset._meta) {
                                        var model = dataset._meta[key].data[i]._model;

                                        let mainTxtHeight = model.y <= 30 ? model.y + 30 : model.y - 15;
                                        let subTxtHeight = model.y <= 30 ? model.y + 35 : model.y - 10;
                                        //
                                        let mainTxtWidth = model.x >= 555 ? model.x - 45 : model.x;
                                        let subTxtWidth = model.x >= 555 ? model.x - 20 : model.x + 26;

                                        ctx.fillStyle = 'black';
                                        ctx.font = '14px Arial';
                                        ctx.fillText('VO', mainTxtWidth, mainTxtHeight);
                                        ctx.font = '10px Arial';
                                        ctx.fillText('2 peak', subTxtWidth, subTxtHeight);
                                    }
                                }
                            }
                        });
                    }
                },
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
                }],
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
                responsive: true,
                maintainAspectRatio: false,
                trendlineLinear: {
                    style: "rgba(255,105,180, .8)",
                    width: 2
                },
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
