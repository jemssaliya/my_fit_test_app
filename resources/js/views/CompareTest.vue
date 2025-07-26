<template>
    <div class>
        <section id="section-a" class="row grid" style="background: white;width: 60% !important;">
            <div class="col-md-4client-card" style="height: 110px !important;">
                <h3 class="compare-test-report">Compare Test Reports</h3>
                <p class="report_date">{{formatDate(comparedata[0].created_at,'DD/MM/YYYY')}}</p>
                <div style="margin-top: 30px;">
                    <span class="name-text">{{comparedata[0].client.name}}</span>
                    <span class="gender-text">{{comparedata[0].client.gender}}</span>
                    <span class="years-old"><b
                        style="height: 19px;width: 20px;color: #000;font-family: Montserrat;font-size: 16px;font-weight: bold;letter-spacing: 0.19px;line-height: 19px;"> {{comparedata[0].client.age}} </b> Years old  <span
                        class="dob-28-02-1991">DOB: {{formatDate(comparedata[0].client.dob,'D/MM/YYYY')}} </span></span>
                </div>
            </div>
        </section>
        <!-- Section B |  Output Charts -->
        <section id="section-b" class="row grid" style="background: #fafafb;font-family: Montserrat;">
            <div class="col-md-12 pull-right">
                <a class="btn btn-success pull-right"
                   v-bind:class="[print_status ? 'disabled':'']"
                   id="download_btn_full" @click="printPdf"
                   style="width: 250px;margin: 10px;" href="#">
                    <i v-bind:class="[print_status ? 'fa-spinner fa-spin' : 'fa-cloud-download']"
                       class="fa fa-fw text-white"></i>
                    Download Report
                </a>
                <a class="btn btn-white pull-right" href="#"
                   style="width: 130px;color: #5ABF5A; border: 1px solid #36A036;margin: 10px;">Email</a>
            </div>

            <!-- Section B-2 | Chart -->
            <section id="section-b-2">
                    <div v-show="cycleTest.length>0">
                        <div class="col-md-12">
                            <h4 class="chart-text" style="margin-top:15px;margin-bottom:25px;">Cycle Tests</h4>
                            <div class="linechart">
                                <div class="mt-3" style="height: 22px;">
                                </div>
                                <female-norms-chart class="jsChart" :chart-data="collectionCycle" :test="datasetsfull"
                                                    id="cycle_test"  v-on:chart:render="disablePrintBtn(false)"></female-norms-chart>
                            </div>

                            <div class="compare-chart compare-summery-box">
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="summery-border compare-summery-box-col-1">#</th>
                                        <th class="summery-border compare-summery-box-col-1">
                                            <p class="summery-table-header">Date</p>
                                        </th>
                                        <th class="summery-border compare-summery-box-col-2">
                                            <p class="summery-table-header">VO<sub>2peak</sub></p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="cycleTestData in cycleTest" :key="cycleTestData.id">
                                        <td class="summery-border"><span class="dot" v-bind:style="{backgroundColor: cycleTestData['color_code']}"></span></td>
                                        <td class="summery-border">
                                            <p class="summery-table-body">{{ formatDate(cycleTestData['x'],'DD/MM/Y')}} </p>
                                        </td>
                                        <td class="summery-border">
                                            <p class="summery-table-body"><b>{{CustomDecimal(cycleTestData['y'])}}</b></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div v-show="walkTest.length>0">
                        <div class="col-md-12 mt-5">
                            <h4 class="chart-text" style="margin-top:15px; margin-bottom:25px;">Walk Tests(uphill)</h4>
                            <div class="linechart">
                                <div class="mt-3" style="height: 22px;">
                                </div>
                                <female-norms-chart class="jsChart" :chart-data="collectionWalk" :test="datasetsfull"
                                             id="walk_test"  v-on:chart:render="disablePrintBtn(false)"></female-norms-chart>
                            </div>
                            <div class="compare-chart compare-summery-box">
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="summery-border compare-summery-box-col-1">#</th>
                                        <th class="summery-border compare-summery-box-col-1">
                                            <p class="summery-table-header">Date</p>
                                        </th>
                                        <th class="summery-border compare-summery-box-col-2">
                                            <p class="summery-table-header">VO<sub>2peak</sub></p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="walkTestData in walkTest" :key="walkTestData.id">
                                        <td class="summery-border"><span class="dot" v-bind:style="{backgroundColor: walkTestData['color_code']}"></span></td>
                                        <td class="summery-border">
                                            <p class="summery-table-body">{{ formatDate(walkTestData['x'],'DD/MM/Y')}}</p>
                                        </td>
                                        <td class="summery-border">
                                            <p class="summery-table-body"><b>{{CustomDecimal(walkTestData['y'])}}</b></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div v-show="runTest.length>0">
                        <div class="col-md-12 mt-5">
                            <h4 class="chart-text" style="margin-top:15px; margin-bottom:25px;">Jog or Run Tests</h4>
                            <div class="linechart">
                                <div class="mt-3" style="height: 22px;">
                                </div>
                                <female-norms-chart class="jsChart" :chart-data="collectionRun" :test="datasetsfull"
                                          id="run_test"    v-on:chart:render="disablePrintBtn(false)"></female-norms-chart>
                            </div>
                            <div class="compare-chart compare-summery-box">
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="summery-border compare-summery-box-col-1">#</th>
                                        <th class="summery-border compare-summery-box-col-1">
                                            <p class="summery-table-header">Date</p>
                                        </th>
                                        <th class="summery-border compare-summery-box-col-2">
                                            <p class="summery-table-header">VO<sub>2peak</sub></p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="runTestData in runTest" :key="runTestData.id">
                                        <td class="summery-border"><span class="dot" v-bind:style="{backgroundColor: runTestData['color_code']}"></span></td>
                                        <td class="summery-border">
                                            <p class="summery-table-body">{{formatDate(runTestData['x'],'DD/MM/Y')}}</p>
                                        </td>
                                        <td class="summery-border">
                                            <p class="summery-table-body"><b>{{CustomDecimal(runTestData['y'])}}</b></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div  v-show="stepTest.length>0">
                        <div class="col-md-12 mt-5">
                            <h4 class="chart-text" style="margin-top:15px; margin-bottom:25px;">Step Tests</h4>
                            <div class="linechart">
                                <div class="mt-3" style="height: 22px;">
                                </div>
                                <female-norms-chart class="jsChart" :chart-data="collectionStep" :test="datasetsfull"
                                                    id="step_test"   v-on:chart:render="disablePrintBtn(false)"></female-norms-chart>
                            </div>
                            <div class="compare-chart compare-summery-box">
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="summery-border compare-summery-box-col-1">#</th>
                                        <th class="summery-border compare-summery-box-col-1">
                                            <p class="summery-table-header">Date</p>
                                        </th>
                                        <th class="summery-border compare-summery-box-col-2">
                                            <p class="summery-table-header">VO<sub>2peak</sub></p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="stepTestData in stepTest" :key="stepTestData.id">
                                        <td class="summery-border"><span class="dot" v-bind:style="{backgroundColor: stepTestData['color_code']}"></span></td>
                                        <td class="summery-border">
                                            <p class="summery-table-body">{{formatDate(stepTestData['x'],'DD/MM/Y')}}</p>
                                        </td>
                                        <td class="summery-border">
                                            <p class="summery-table-body"><b>{{CustomDecimal(stepTestData['y'])}}</b></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>

        </section>
        <!-- Section C | Append New Program -->
        <!-- <section id="section-c" class="row grid">

            <div class="new-program">
                <form class="form-inline" style="width: inherit; align-items: end; justify-content: space-between;">
                    <button type="button" class="btn btn-warning btn-lg btn-block" @click="clearComparedData()">Clear Compared Data</button>
                </form>
            </div>

        </section> -->

        <!-- Modal -->
        <div v-if="showModal" class="modal fade show" id="responseModal" tabindex="-1" role="dialog"
             aria-labelledby="responseModalLabel" style="display:block">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #47c55d26;">
                        <h5 class="modal-title" id="responseModalLabel">Success</h5>
                    </div>
                    <div class="modal-body">
                        Compared data successfully erased. Now you can start a new comparison.
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="showModal=false" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import ClientCard from '../components/ClientCard';
    import BarChart from '../components/BarChart.js';
    import moment from "moment";
    import jsPDF from 'jspdf';
    import LineChart from '../components/LineChart.js';
    import FemaleNormsChart from '../components/FemaleNormsChart.js';


    export default ({
        name: 'compare',
        weight: null,
        hrp: null,
        bpp: null,
        props: {
            comparedata: {
                type: Array
            },
        },
        mounted() {
            this.arrangeData();
            this.fillData2();
            this.fillData1();
            this.fillData3();
            this.fillData4();
            // console.log(this.comparedata);
        },
        components: {
            BarChart,
            LineChart,
            FemaleNormsChart,
        },
        data() {
            return {
                datacollectionCycle: null,
                datacollectionWalk: null,
                datacollectionRun: null,
                datacollectionStep: null,

                collectionCycle :{},
                collectionWalk :{},
                collectionRun:{},
                collectionStep:{},

                datacollection2: {},
                cycleTest: [],
                walkTest: [],
                runTest: [],
                stepTest: [],
                cycleLabals: [],
                walkLabals: [],
                runLabals: [],
                stepLabals: [],
                showCycle: false,
                showWalk: false,
                showRun: false,
                showStep: false,
                error: null,
                loading: false,
                showModal: false,
                items: [],
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'
                        }]
                    }
                },
                print_status: true,
                age:this.comparedata[0].client.age
            }
        },
        created() {

        },
        watch: {},
        computed: {
            datasetsfull() {
                return {
                    label: 'graph',
                    type: 'line',
                    datasets: [
                        {
                            label: '/data',
                            backgroundColor: '#E1F5CA',
                            data: this.graphY // a getter from Vuex
                        },
                        {
                            label: '/analytics',
                            backgroundColor: '#67C6AE',
                            data: this.graphX
                        }
                    ]
                }
            },
        },
        methods: {
            CustomDecimal(value, cnt = 1) {
                if (value != null && value != '') {
                    if (!isNaN(value)) {
                        /* if(value==Math.floor(value)){
                             return parseFloat(value).toFixed(0);
                         }else{
                             return parseFloat(value).toFixed(cnt);
                         }*/

                        return value;

                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
            },
            fillDataCycle() {
                this.datacollectionCycle = {
                    labels: this.cycleLabals,
                    datasets: [
                        {
                            label: 'VO2peak',
                            backgroundColor: '#008000',
                            data: this.cycleData, // send date and vo2peak here
                            borderColor: '#53565e',
                            // pointBackgroundColor: "#53565e",
                            // pointStyle: 'rect',
                            // rotation: 45,
                        }
                    ]
                }
            },
            fillDataWalk() {
                this.datacollectionWalk = {
                    labels: this.walkLabals,
                    datasets: [
                        {
                            label: 'VO2peak',
                            backgroundColor: '#008000',
                            data: this.walkData, // send date and vo2peak here
                            borderColor: '#53565e',
                            // pointBackgroundColor: "#53565e",
                            // pointStyle: 'rect',
                            // rotation: 45,
                        }
                    ]
                }
            },
            fillDataRun() {
                this.datacollectionRun = {
                    labels: this.runLabals,
                    datasets: [
                        {
                            label: 'VO2peak',
                            backgroundColor: '#008000',
                            data: this.runData, // send date and vo2peak here
                            borderColor: '#53565e',
                            // pointBackgroundColor: "#53565e",
                            // pointStyle: 'rect',
                            // rotation: 45,
                        }
                    ]
                }
            },
            fillDataStep() {
                this.datacollectionStep = {
                    labels: this.stepLabals,
                    datasets: [
                        {
                            label: 'VO2peak',
                            backgroundColor: '#008000',
                            data: this.stepData, // send date and vo2peak here
                            borderColor: '#53565e',
                            // pointBackgroundColor: "#53565e",
                            // pointStyle: 'rect',
                            // rotation: 45,
                        }
                    ]
                }
            },
            proccessAllGraphs() {
                // cycle
                this.cycleGraphY = [];
                this.cycleGraphX = [];
                this.cycleLabals = [];
                this.cycleData = [];
                // walk
                this.walkGraphY = [];
                this.walkGraphX = [];
                this.walkLabals = [];
                this.walkData = [];
                // run
                this.runGraphY = [];
                this.runGraphX = [];
                this.runLabals = [];
                this.runData = [];
                // step
                this.stepGraphY = [];
                this.stepGraphX = [];
                this.stepLabals = [];
                this.stepData = [];

                for (var i = 0; i < this.cycleTest.length; i++) { // create array
                    this.cycleData.push({y: parseFloat(this.cycleTest[i]['y']), x: this.cycleTest[i]['x'],color_code:this.cycleTest[i]['color_code']});
                    this.cycleLabals.push(this.formatDate(this.cycleTest[i]['x'], 'DD/MM/Y'));
                }
                for (var i = 0; i < this.walkTest.length; i++) { // create array
                    this.walkData.push({y: parseFloat(this.walkTest[i]['y']), x: this.walkTest[i]['x'],color_code:this.walkTest[i]['color_code']});
                    this.walkLabals.push(this.formatDate(this.walkTest[i]['x'], 'DD/MM/Y'));
                }
                for (var i = 0; i < this.runTest.length; i++) { // create array
                    this.runData.push({y: parseFloat(this.runTest[i]['y']), x: this.runTest[i]['x'],color_code:this.runTest[i]['color_code']});
                    this.runLabals.push(this.formatDate(this.runTest[i]['x'], 'DD/MM/Y'));
                }
                for (var i = 0; i < this.stepTest.length; i++) { // create array
                    this.stepData.push({y: parseFloat(this.stepTest[i]['y']), x: this.stepTest[i]['x'],color_code:this.stepTest[i]['color_code']});
                    this.stepLabals.push(this.formatDate(this.stepTest[i]['x'], 'DD/MM/Y'));
                }
                //   console.log(this.cycleData);
                if (this.cycleData.length > 0) {
                    this.fillDataCycle();
                }
                if (this.walkData.length > 0) {
                    this.fillDataWalk();
                }
                if (this.runData.length > 0) {
                    this.fillDataRun();
                }
                if (this.stepData.length > 0) {
                    this.fillDataStep();
                }

            },
            arrangeData() {
                console.log(this.comparedata[0].compare_data);
                this.cycleTest = [];
                this.walkTest = [];
                this.runTest = [];
                this.stepTest = [];
                this.comparedata[0].compare_data.forEach(element => {
                    let date1 = new Date(element.x);
                    let date2 = new Date(this.comparedata[0].client.dob);
                    let diff = parseFloat(Math.floor((date1 - date2)/86400000)/365.25).toFixed(4);
                    element.ageTest = diff;

                    if (element.test_type == '1') {
                        this.cycleTest.push(element);
                    }
                    if (element.test_type == '2') {
                        this.walkTest.push(element);
                    }
                    if (element.test_type == '3') {
                        this.runTest.push(element);
                    }
                    if (element.test_type == '4') {
                        this.stepTest.push(element);
                    }
                });
                this.proccessAllGraphs();
            },
            clearComparedData() {
                // window.axios.delete('http://localhost:8000/compare-test/'+(1)).then((res) => {
                window.axios.delete(this.$config.BASE_URL + '/compare-test/' + (1)).then((res) => {
                    self.showModal = true;
                })
                    .then(function (response) {
                        self.showModal = true;
                        window.location.href = this.$config.BASE_URL + '/clients';
                        //    window.location.href = 'http://localhost:8000';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            checkUndefineds(val) {
                return (typeof val !== 'undefined') ? true : false;
            },
            formatDate(value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY-MM-DD').format(fmt)
            },
            printPdf() {
                this.disablePrintBtn(true, 0);

                let data = {
                    client: this.comparedata[0].client,
                };

                if(this.walkTest.length > 0){
                    data.walk_test=document.getElementById('walk_test').children[1].toDataURL();
                    data.walk_table=this.walkTest;
                }
                if(this.runTest.length>0){
                    data.run_test= document.getElementById('run_test').children[1].toDataURL();
                    data.run_table=this.runTest;
                }
                if(this.stepTest.length>0){
                    data.step_test=document.getElementById('step_test').children[1].toDataURL();
                    data.step_table = this.stepTest;
                }
                if(this.cycleTest.length>0){
                    data.cycle_test =document.getElementById('cycle_test').children[1].toDataURL();
                    data.cycle_table = this.cycleTest;
                }

                window.axios.post(`${this.$config.BASE_URL}/compare-test/downloadPDF`, data)
                    .then((res) => {
                        const link = document.createElement('a');

                        link.href = res.data.url;
                        link.download = res.data.url.substr(res.data.url.lastIndexOf('/') + 1);
                        link.click();
                        this.disablePrintBtn(false, 0);
                    }).catch(function (error) {
                    console.log(error);
                    this.disablePrintBtn(false, 0);
                });
            },
            disablePrintBtn(status, time) {
                let milliseconds = typeof time === 'undefined' ? 3000 : time;

                setTimeout(() => {
                    this.print_status = status;
                }, milliseconds);
            },
            fillData1() { //  norms for VO2 peak
                var cycleGraphData = [];
                let age = this.comparedata[0].client.age;
                var pointcolor =[];

                this.cycleTest.forEach(function(element){
                    var stepData = {'x':element.ageTest, 'y':element.y,'date':element.x};
                    cycleGraphData.push(stepData);
                    pointcolor.push(element.color_code);
                })

                if (this.comparedata[0].client.gender=='Male') {
                    this.collectionCycle= {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 62.5}, {'x': 12.5, 'y': 66}, {'x': 75, 'y': 31}, {
                                    'x': 99,
                                    'y': 18
                                }],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 57}, {'x': 12.5, 'y': 60}, {'x': 75, 'y': 28}, {'x': 99, 'y': 16}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 50.5}, {'x': 12.5, 'y': 53}, {'x': 75, 'y': 25}, {
                                    'x': 99,
                                    'y': 14
                                }],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45}, {'x': 12.5, 'y': 47}, {'x': 75, 'y': 22.5}, {
                                    'x': 99,
                                    'y': 12
                                }],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 38}, {'x': 12.5, 'y': 40.7}, {'x': 75, 'y': 19}, {
                                    'x': 99,
                                    'y': 10
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 32.5}, {'x': 12.5, 'y': 34.5}, {'x': 75, 'y': 16.5}, {
                                    'x': 99,
                                    'y': 7
                                }],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data:cycleGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                } else {
                    this.collectionCycle = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 56}, {'x': 9, 'y': 57.5}, {'x': 75, 'y': 23}, {'x': 99, 'y': 10}],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 51}, {'x': 9, 'y': 53}, {'x': 75, 'y': 21.5}, {'x': 99, 'y': 9}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45.5}, {'x': 9, 'y': 47}, {'x': 75, 'y': 20}, {'x': 99, 'y': 8}],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 40}, {'x': 9, 'y': 41.7}, {'x': 75, 'y': 17}, {'x': 99, 'y': 7}],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 34.7}, {'x': 9, 'y': 35.8}, {'x': 75, 'y': 14.7}, {
                                    'x': 99,
                                    'y': 6
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 29}, {'x': 9, 'y': 30.2}, {'x': 75, 'y': 12.4}, {'x': 99, 'y': 5}],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data:cycleGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                }

            },
            fillData2() { //  norms for VO2 peak
                var walkGraphData = [];
                let age = this.comparedata[0].client.age;
                var pointcolor =[];

                this.walkTest.forEach(function(element){
                    var stepData = {'x':element.ageTest, 'y':element.y,'date':element.x};
                    walkGraphData.push(stepData);
                    pointcolor.push(element.color_code);
                })

                if (this.comparedata[0].client.gender=='Male') {
                    this.collectionWalk = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 62.5}, {'x': 12.5, 'y': 66}, {'x': 75, 'y': 31}, {
                                    'x': 99,
                                    'y': 18
                                }],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 57}, {'x': 12.5, 'y': 60}, {'x': 75, 'y': 28}, {'x': 99, 'y': 16}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 50.5}, {'x': 12.5, 'y': 53}, {'x': 75, 'y': 25}, {
                                    'x': 99,
                                    'y': 14
                                }],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45}, {'x': 12.5, 'y': 47}, {'x': 75, 'y': 22.5}, {
                                    'x': 99,
                                    'y': 12
                                }],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 38}, {'x': 12.5, 'y': 40.7}, {'x': 75, 'y': 19}, {
                                    'x': 99,
                                    'y': 10
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 32.5}, {'x': 12.5, 'y': 34.5}, {'x': 75, 'y': 16.5}, {
                                    'x': 99,
                                    'y': 7
                                }],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data:walkGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                } else {
                    this.collectionWalk = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 56}, {'x': 9, 'y': 57.5}, {'x': 75, 'y': 23}, {'x': 99, 'y': 10}],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 51}, {'x': 9, 'y': 53}, {'x': 75, 'y': 21.5}, {'x': 99, 'y': 9}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45.5}, {'x': 9, 'y': 47}, {'x': 75, 'y': 20}, {'x': 99, 'y': 8}],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 40}, {'x': 9, 'y': 41.7}, {'x': 75, 'y': 17}, {'x': 99, 'y': 7}],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 34.7}, {'x': 9, 'y': 35.8}, {'x': 75, 'y': 14.7}, {
                                    'x': 99,
                                    'y': 6
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 29}, {'x': 9, 'y': 30.2}, {'x': 75, 'y': 12.4}, {'x': 99, 'y': 5}],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data:walkGraphData,  // send age and VO2 peak here
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                }

            },
            fillData3() { //  norms for VO2 peak
                var runGraphData = [];
                let age = this.comparedata[0].client.age;
                var pointcolor =[];

                this.runTest.forEach(function(element){
                    var stepData = {'x':element.ageTest, 'y':element.y,'date':element.x};
                    runGraphData.push(stepData);
                    pointcolor.push(element.color_code);
                })


                if (this.comparedata[0].client.gender=='Male') {
                    this.collectionRun = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 62.5}, {'x': 12.5, 'y': 66}, {'x': 75, 'y': 31}, {
                                    'x': 99,
                                    'y': 18
                                }],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 57}, {'x': 12.5, 'y': 60}, {'x': 75, 'y': 28}, {'x': 99, 'y': 16}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 50.5}, {'x': 12.5, 'y': 53}, {'x': 75, 'y': 25}, {
                                    'x': 99,
                                    'y': 14
                                }],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45}, {'x': 12.5, 'y': 47}, {'x': 75, 'y': 22.5}, {
                                    'x': 99,
                                    'y': 12
                                }],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 38}, {'x': 12.5, 'y': 40.7}, {'x': 75, 'y': 19}, {
                                    'x': 99,
                                    'y': 10
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 32.5}, {'x': 12.5, 'y': 34.5}, {'x': 75, 'y': 16.5}, {
                                    'x': 99,
                                    'y': 7
                                }],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data: runGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                } else {
                    this.collectionRun = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 56}, {'x': 9, 'y': 57.5}, {'x': 75, 'y': 23}, {'x': 99, 'y': 10}],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 51}, {'x': 9, 'y': 53}, {'x': 75, 'y': 21.5}, {'x': 99, 'y': 9}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45.5}, {'x': 9, 'y': 47}, {'x': 75, 'y': 20}, {'x': 99, 'y': 8}],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 40}, {'x': 9, 'y': 41.7}, {'x': 75, 'y': 17}, {'x': 99, 'y': 7}],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 34.7}, {'x': 9, 'y': 35.8}, {'x': 75, 'y': 14.7}, {
                                    'x': 99,
                                    'y': 6
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 29}, {'x': 9, 'y': 30.2}, {'x': 75, 'y': 12.4}, {'x': 99, 'y': 5}],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data:runGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                }

            },
            fillData4() { //  norms for VO2 peak

                var stepGraphData = [];
                var pointcolor =[];
                let age = this.comparedata[0].client.age;

                this.stepTest.forEach(function(element){
                    var stepData = {'x':element.ageTest, 'y':element.y,'date':element.x};
                    stepGraphData.push(stepData);
                    pointcolor.push(element.color_code);
                })

                if (this.comparedata[0].client.gender=='Male') {
                    this.collectionStep = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 62.5}, {'x': 12.5, 'y': 66}, {'x': 75, 'y': 31}, {
                                    'x': 99,
                                    'y': 18
                                }],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 57}, {'x': 12.5, 'y': 60}, {'x': 75, 'y': 28}, {'x': 99, 'y': 16}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 50.5}, {'x': 12.5, 'y': 53}, {'x': 75, 'y': 25}, {
                                    'x': 99,
                                    'y': 14
                                }],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45}, {'x': 12.5, 'y': 47}, {'x': 75, 'y': 22.5}, {
                                    'x': 99,
                                    'y': 12
                                }],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 38}, {'x': 12.5, 'y': 40.7}, {'x': 75, 'y': 19}, {
                                    'x': 99,
                                    'y': 10
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 32.5}, {'x': 12.5, 'y': 34.5}, {'x': 75, 'y': 16.5}, {
                                    'x': 99,
                                    'y': 7
                                }],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data: stepGraphData,
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false,
                            }
                        ]
                    }
                } else {
                    this.collectionStep = {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                        datasets: [
                            {
                                label: 'Excellent',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 56}, {'x': 9, 'y': 57.5}, {'x': 75, 'y': 23}, {'x': 99, 'y': 10}],
                                borderColor: '#dd4b45',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Very Good',
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 51}, {'x': 9, 'y': 53}, {'x': 75, 'y': 21.5}, {'x': 99, 'y': 9}],
                                borderColor: '#84d14e',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Good',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 45.5}, {'x': 9, 'y': 47}, {'x': 75, 'y': 20}, {'x': 99, 'y': 8}],
                                borderColor: '#3259b7',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Average',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 40}, {'x': 9, 'y': 41.7}, {'x': 75, 'y': 17}, {'x': 99, 'y': 7}],
                                borderColor: '#b466dc',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Fair',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 34.7}, {'x': 9, 'y': 35.8}, {'x': 75, 'y': 14.7}, {
                                    'x': 99,
                                    'y': 6
                                }],
                                borderColor: '#527429',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: 'Needs Improvement',
                                showLabel: false,
                                backgroundColor: '#f5f5f500',
                                data: [{'x': 1, 'y': 29}, {'x': 9, 'y': 30.2}, {'x': 75, 'y': 12.4}, {'x': 99, 'y': 5}],
                                borderColor: '#8b66ef',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                showLabel: true,
                                filltext: 'testing text',
                                labelTextColor: '#e68a51',
                                backgroundColor: '#f5f5f500',
                                data: stepGraphData,  // send age and VO2 peak here
                                borderColor: pointcolor,
                                borderWidth: 6,
                                pointBackgroundColor: pointcolor,
                                pointStyle: 'circle',
                                showLine: false
                            }
                        ]
                    }
                }

            },
        }

    })
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .container-full-width {
        width: 100vw !important;
        max-width: 100vw !important;
    }

    .box {
        padding: 1em;
        color: #fff;
    }

    #section-a {
        background-color: #bfc8d7;
        padding: 1em;
        margin-bottom: 1em;
        justify-content: space-between;
    }

    #section-b {
        margin-bottom: 1em;
    }

    #section-b-1 {
        background-color: #bfc8d7;
        width: 100%;
    }

    #section-b-2 {
        background-color: #fafafb;
        padding: 25px;
        width: 100%;
    }

    #section-b-3 {
        background-color: #fafafb;
        padding: 25px;
        width: 100%;
    }

    #section-b-2 .input {
        max-width: 146px !important;
    }

    .input {
        max-width: 146px !important;
    }

    #section-c {
        background-color: #bfc8d7;
        padding: 20px;
    }

    #section-d {
        background-color: #ffffff;
        padding: 20px;
        height: 200px;
    }

    #section-d .program-data {
        background-color: #eef1f9;
        padding: 20px;
        border-style: dashed;
        border-color: #bfc8d7;
        text-align: center;
    }

    #section-c .client-list {
        padding-left: 0;
        padding-right: 0;
    }

    .col-centered {
        text-align: center;
        margin: 0 auto;
        margin-left: 0;
    }

    #test-drop-down {
        padding-left: 0px;
        padding-right: 0px;
    }

    #inputState {
        width: inherit;
    }

    #colWeight, #colHR, #colBP {
        width: inherit;
    }

    .legend {
        padding: 5px;
        background-color: #eef1f9;
        border-radius: 5px;
        height: 80px;
        display: flex;
    }

    .legend-1 {
        border-right: black;
        border-right-style: groove;
        border-right-width: 1px;
        margin-right: 5px;
        padding-right: 5px;
        padding: 5px;
    }

    .legend-2 {
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .new-program {
        width: 100%;
        display: flex;
    }

    .small {
        /* max-width: 1000px; */
        margin: 100px auto;
    }

    .compare-chart {
        background-color: #EEF1F9;
        margin: 15px;
    }

    .compare-summery-box {
        /* height: 194px;	 */
        width: 320px;
        background-color: #EEF1F9;
    }

    .compare-summery-box-col-1 {
        width: 120px;
    }

    .compare-summery-box-col-2 {
        width: 200px;
    }

    .summery-table-header {
        color: #000;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.19px;
        margin: auto;
        line-height: 30px;
    }

    .summery-table-body {
        color: #1B2031;
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.19px;
        margin: auto;
        line-height: 20px;
    }

    .compare-summery-table {
        padding: 8px;
        border-width: 1px;
        border-style: solid;
        border-color: rgb(214, 221, 234);
    }

    .summery-border {
        border: 1px solid #ddd;
        padding: 8px;
    }

    @media (max-width: 700px) {
        #section-a .form-inline {
            display: grid;
        }

        .col-centered {
            text-align: center;
            margin: 0;
        }

        #section-a .form-control-lg {
            width: 100%;
        }
    }

    .compare-test-report {
        height: 22px;
        width: auto;
        color: #000;
        font-family: Montserrat !important;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 0.22px;
        line-height: 22px;
    }

    .report_date {
        height: 18px;
        width: 300px;
        color: #000;
        font-family: Montserrat;
        font-size: 14px;
        letter-spacing: 0.17px;
        line-height: 18px;
    }

    .name-text {
        height: 20px;
        width: 128px;
        color: #1B2031;
        font-family: Montserrat;
        font-size: 17px;
        letter-spacing: 0.2px;
        line-height: 20px;
    }

    .gender-text {
        height: 19px;
        width: 62px;
        color: #000;
        font-family: Montserrat;
        font-size: 16px;
        letter-spacing: 0.19px;
        line-height: 19px;
        margin-left: 70px;
    }

    .years-old {
        margin-left: 80px;
        font-family: Montserrat;
    }

    .dob-28-02-1991 {
        height: 18px;
        width: 118px;
        color: #000;
        font-family: Montserrat;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.17px;
        line-height: 18px;
    }

    .chart-text {
        color: #1B2031;
        font-family: Montserrat;
        font-size: 21px;
        font-weight: 600;
        letter-spacing: 0.25px;
        line-height: 25px;
    }
    .dot {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        display: inline-block;
    }
    .jsChart{
        width: 728px;
        height: 526px;
    }
    /*@media only screen and (max-width:750px) {*/
    /*    body {*/
    /*        width: 528px;*/
    /*        height: 426px;*/
    /*    }*/
    /*}*/
</style>