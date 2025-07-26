import {Line, mixins} from 'vue-chartjs'

const {reactiveProp} = mixins;

export default {
    extends: Line,
    mixins: [reactiveProp],
    props: {
        yLabel: {
            type: String,
            default: ''
        },
    },
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
                            labelString: '',
                            fontColor: '#000000',
                            fontSize: 18,
                        },
                        yAxisID: "0"
                    }],
                    xAxes: [{
                        type: 'linear',
                        position: 'bottom',
                        ticks: {
                            min: 0,
                            fontSize: 16,
                            beginAtZero: true,
                        },
                        gridLines: {
                            display: false
                        },
                        scaleLabel: {
                            display: true,
                            fontColor: '#000000',
                            fontSize: 18,
                            labelString: 'Time (mins)'
                        },
                        pointLabels: {
                            callback: function (label) {
                                return label;
                            }
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return tooltipItem.yLabel;
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
                responsive: true,
                maintainAspectRatio: false,
                height: 200,
                animation: {
                    onComplete(e) {
                    }
                }
            }
        }
    },
    watch: {
        yLabel: function (value) {
            console.log('updating');
            this.options.scales.yAxes[0].scaleLabel.labelString = this.yLabel;
            this.renderChart(this.chartData, this.options)
        }
    },
    mounted() {
        console.log('mounting');
        this.options.scales.yAxes[0].scaleLabel.labelString = this.yLabel;
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options)
    }
}
