<template>
    <div class="container">
        <!-- Section A | Client Card, Search, Select Test -->
        <section id="section-a" class="row grid">
            <ClientCard :client="client"></ClientCard>
            <div class="grid col-md-6" style="display:grid;align-items: center;">
                <div class="form-group mx-sm-3 mb-2 col-md-12" id="testNameInput" style="padding: 0px;">
                    <input type="text" class="form-control-lg" id="testNameInput" placeholder="Type some test name here"
                           style="width:inherit;">
                </div>
                <div class="form-group mx-sm-3 mb-2 col-md-12" id="test-drop-down">
                    <select v-model="selected" id="inputState" class="form-control-lg bg-light"
                            @change="getTableData(1)">
                        <option :value="null">Select test</option>
                        <option v-for="testtype in testtypes" :key="testtype.id" v-bind:value="testtype.id">{{
                            testtype.name }}
                        </option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Section B | Test Inputs, Output Tables, Output Charts -->
        <section id="section-b" class="row grid">

            <!-- Section B-1 | Input Fields -->
            <section id="section-b-1">

                <div class="row grid" style="margin-right: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px;">
                        <label for="colWeight" class="col-sm-2 col-form-label col-form-label-lg">Weight (kg) </label>
                        <div class="col-md-2">
                            <input v-model="weight" type="text" class="form-control form-control-lg" id="colWeight"
                                   placeholder="Weight (kg)">
                        </div>
                        <label for="colHR" class="col-sm-2 col-form-label col-form-label-lg">HR Peak</label>
                        <div class="col-md-2">
                            <input v-model="hrp" type="text" class="form-control form-control-lg" id="colHR"
                                   placeholder="HR Peak">
                        </div>
                        <label for="colBP" class="col-sm-2 col-form-label col-form-label-lg">BP Peak</label>
                        <div class="col-md-2">
                            <input v-model="bpp" type="text" class="form-control form-control-lg" id="colBP"
                                   placeholder="BP Peak">
                        </div>
                    </form>
                </div>

            </section>

            <!-- Section B-2 | Chart -->
            <section id="section-b-2">
                <label for="correl" class="col-sm-2 col-form-label col-form-label-lg">Linear Correlation</label>
                <input type="text" v-model="correlation" id="correl">
                <div class="row" style="display:flex;">
                    <div class="col-md-3">
                        <div class="legend">
                            <div class="legend-1">
                                <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2
                                    Peak</p>
                                <p style="margin-bottom: 0px;">ml/kg/min</p>
                            </div>
                            <div class="legend-2">
                                <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">
                                    {{vo2PeakEST}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores ut vel ad nihil impedit
                            numquam sunt alias totam molestias sapiente.</p>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="small">
                        <line-chart :width="800" :height="400" :options="options" :chart-data="datacollection"></line-chart>
                        <button @click="fillData()">Randomize</button>
                    </div>
                </div> -->

                <div class="linechart">
                    <scatter-chart :chart-data="datacollection" :test="datasetsfull"></scatter-chart>
                </div>

                <div class="linechart">
                    <female-norms-chart :chart-data="datacollection2" :test="datasetsfull"></female-norms-chart>
                </div>

                <div class="">
                    <table class="table-responsive"
                           style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                        <thead style="background-color:#eef1f9;">
                        <tr>
                            <th v-for="tableCol in tableData" :key="tableCol.id" style="padding: 10px;">
                                <p style="margin-bottom: 0px;">{{tableCol.heading}}</p>
                                <p style="margin-bottom: 0px;font-size: 12px; font-weight: lighter;">
                                    {{tableCol.sub_heading}}</p>
                            </th>
                        </tr>
                        </thead>
                        <tbody style="background-color:#eef1f9;">
                        <!-- <tr> -->
                        <!-- foreach item array here -->
                        <!-- <td v-for="testDataCol in testData" :key="testDataCol" @change="onEditorChange($event)" contenteditable="true" style="padding: 10px;">{{testDataCol}}</td> -->
                        <!-- </tr> -->
                        <tr v-for="(row, idx1) in items" :key="idx1" @remove="removeRow">
                            <td class="table-success" v-for="(col, idx2) in row" :key="idx2">
                                <input v-model="col.value" type="text" @change="onEditorChange($event)"
                                       style="max-width: 146px;"/>
                            </td>
                            <button v-on:click="remove(idx1,1)"> X</button>
                        </tr>
                        </tbody>
                    </table>
                    <!-- <button @click="addRow(1)">add row</button> -->
                    <!-- <button @click="calculateSlope()">cal slop</button> -->
                    <!-- <button @click="calculateSpeed()">cal speed</button> -->
                    <!-- <button @click="proccessGraph()"> graph</button> -->
                    <!-- <button @click="calculateVO2Peak();">cal vo2peak</button> -->
                </div>

            </section>

            <!-- Section B-3 | Available Data -->
            <!-- <section id="section-b-3">
                <div class="form-group mx-sm-3 mb-2 col-md-12" id="test-drop-down">
                    <select v-model="selectedavl" id="inputState1" class="form-control-lg bg-light" @change="getTableData(2)">
                        <option :value="null">Select..</option>
                        <option v-for="avlDatum in avlData" :key="avlDatum.id" v-bind:value="avlDatum.id">{{ avlDatum.name }}</option>
                    </select>
                </div>
            </section> -->

            <!-- Secction B-4 | Available Data table -->
            <Section id="section-b-4">
                <table class="table-responsive" style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                    <thead style="background-color:#eef1f9;">
                    <tr>
                        <th v-for="tableColb in tableAvailData" :key="tableColb.id" style="padding: 10px;">
                            <p style="margin-bottom: 0px;">{{tableColb.heading}}</p>
                            <p style="margin-bottom: 0px;font-size: 12px; font-weight: lighter;">
                                {{tableColb.sub_heading}}</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="background-color:#eef1f9;">
                    <tr v-for="(rowb, idx1b) in avlDataItems" :key="idx1b" @remove="removeRow">
                        <td class="table-success" v-for="(colb, idx2b) in rowb" :key="idx2b"
                            @change="calculateVO2Gen(colb,idx1b)">
                            <input v-model="colb.value" type="text" style="max-width: 146px;"/>
                        </td>
                        <button v-on:click="remove(idx1b,2)"> X</button>
                    </tr>
                    </tbody>
                </table>
                <button v-if="visibleAddRow" @click="addRow(2)">add row</button>
            </Section>

        </section>

        <!-- Section C | Append New Program -->
        <section id="section-c" class="row grid">

            <h2>Append new program to the above test</h2>
            <div class="new-program">
                <form class="form-inline" style="width: inherit; align-items: end; justify-content: space-between;">
                    <label for="program-drop-down" class="col-sm-1 col-form-label col-form-label-lg"
                           style="padding-left: 0px;">Program</label>
                    <div class="form-group mx-sm-3 mb-2 col-md-4 float-left" id="program-drop-down">
                        <select id="inputStatepro" class="form-control-lg bg-light">
                            <option selected>Select program...</option>
                            <option value="1">Cycle Test</option>
                        </select>
                    </div>
                    <label for="colBP" class="col-sm-2 col-form-label col-form-label-lg">Number of Rows</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control form-control-lg" id="colBP" placeholder="10">
                    </div>
                    <button type="submit" class="btn btn-success mb-2 btn-lg">Start Program</button>
                </form>
            </div>

        </section>

        <!-- Section D | Program Data -->
        <section id="section-d" class="row grid">

            <div class="col-md-12 program-data">
                <p>You haven't selected a program yet!</p>
                <p>Start a program from above to load the program data</p>
            </div>

        </section>

    </div>
</template>

<script>
    import ClientCard from '../components/ClientCard';
    import Chart from '../components/Chart';
    // import { Bar } from 'vue-chartjs'
    import LineChart from '../components/LineChart.js';
    import ScatterChart from '../components/ScatterChart.js';
    import FemaleNormsChart from '../components/FemaleNormsChart.js';

    export default ({
        name: 'test',
        weight: null,
        hrp: null,
        bpp: null,
        props: {
            testtypes: {
                type: Array
            },
            client: {
                type: Object
            },
        },
        //   extends: Bar,
        mounted() {
            this.fillData(),
                this.fillData2()
            //     this.renderChart(data, options)
        },
        components: {
            //   SelectTest,
            ClientCard,
            LineChart,
            ScatterChart,
            FemaleNormsChart
            //   ClientTest
        },
        data() {
            return {
                //   name: 'test',
                datacollection: null,
                datacollection2: null,
                tableData: [],
                tableAvailData: [],
                testData: [],
                error: null,
                loading: false,
                selected: '',
                selectedavl: '',
                items: [],
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'
                        }]
                    }
                },
                avlDataItems: [],
                avlData: [],
                tempArray: [],
                obj: Object,
                scatterObj: Object,
                Intercept: null,
                InterceptB: null,
                slopeB: null,
                SX: 0,
                SY: 0,
                SXX: 0,
                SXY: 0,
                SYY: 0,
                SXB: 0,
                SYB: 0,
                SXXB: 0,
                SXYB: 0,
                SYYB: 0,
                X: null,
                Y: null,
                Xvo2: null,
                Yvo2: null,
                SumProduct: 0,
                N: null,
                Nvo2: null,
                weight: null,
                hrp: 146,
                bpp: null,
                power: 201,
                speed: null,
                metsPeak: null,
                vo2Peak: null,
                vo2PeakEST: null,
                vo2Range: null,
                hrPeak: 146,
                hrPeakPredicted: null,
                age: null,
                vo2Gen: 2.76,
                graphY: [],
                graphX: [],
                scatterData: [],
                rpeArray: [],
                vo2Array: [],
                correlation: null,
                startPoint: null,
                endPoint: null,
                trendLineData: [],
                visibleAddRow: false,
            }
        },
        watch: {
            // call again the method if the route changes
            // '$route': 'getTableData'
        },
        computed: {
            filteredNames() {
            },
            // calculateVo2 () {
            // (HRpeak===“”,“”,Vo2peak(l.min-1)/Weight(kg)*1000)
            // },
            createRPEArray() {
                // for (var i = 0; i < this.N; i++) {
                //     this.rpeArray[i] = this.avlDataItems[i]['heart_rate'];
                // }
            },
            createVO2Array() {
                // for (var i = 0; i < this.N; i++) {
                //     this.vo2Array[i] = this.avlDataItems[i]['vo2gen'];
                // }
                // console.log('working as expected');
            },
            datasetsfull() {
                return {
                    label: 'graph',
                    type: 'scatter',
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
            fillData() {
                this.datacollection = {
                    labels: this.graphX,
                    datasets: [
                        {
                            label: 'Heart Rate',
                            backgroundColor: '#f5f5f500',
                            data: this.scatterData,
                            // data: this.graphY,
                            borderColor: '#82cd4d',
                            borderWidth: 1,
                            showLine: false,
                            pointBackgroundColor: "#82cd4d",
                        },
                        {
                            label: 'Trend',
                            backgroundColor: '#f5f5f500',
                            data: this.trendLineData,
                            borderColor: '#82cd4d',
                            borderWidth: 4,
                            showLine: true,
                        },
                        {
                            label: 'VO2peak',
                            backgroundColor: '#f5f5f500',
                            data: [{x: this.items[0]['vo2peakEst'].value, y: this.items[0]['HRpeak'].value}], // send VO2 peak and hrpeak here
                            borderColor: '#dd4b45',
                            borderWidth: 10,
                            pointBackgroundColor: "#dd4b45",
                            pointStyle: 'rect',
                            rotation: 45
                        }
                    ]
                }
            },
            fillData2() { // female norms for VO2 peak
                this.datacollection2 = {
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
                            data: [{'x': 1, 'y': 34.7}, {'x': 9, 'y': 35.8}, {'x': 75, 'y': 14.7}, {'x': 99, 'y': 6}],
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
                            label: 'You are here',
                            showLabel: true,
                            filltext: 'testing text',
                            labelTextColor: '#e68a51',
                            backgroundColor: '#f5f5f500',
                            data: [{'x': this.client.age, 'y': this.vo2PeakEST}], // send age and VO2 peak here
                            borderColor: '#000000',
                            borderWidth: 1,
                            pointBackgroundColor: "#000000",
                            pointStyle: 'rect',
                        }
                    ]
                }
            },
            getRandomInt() {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            },
            getTableData(type) {
                this.loading = true
                if (type == 1) {
                    // window.axios.get('http://localhost:8000/tables/'+this.selected).then((res) => {
                    window.axios.get(this.$config.BASE_URL + '/tables/' + this.selected).then((res) => {
                        // window.axios.get(env('APP_URL')+'/tables/'+this.selected).then((res) => {
                        this.tableData = res.data.data.columns,
                            this.getAvailableData()
                        console.log(this.tableData);
                        this.obj = this.tableData.reduce((o, key) => ({...o, [key.name]: {value: 0}}), {});
                        this.addRow(1);
                    });
                }
                // if(type == 2) {
                // window.axios.get('http://localhost:8000/tables/'+'2').then((res) => {
                window.axios.get(this.$config.BASE_URL + '/tables/' + '2').then((res) => {
                    // window.axios.get(env('APP_URL')+'/tables/'+'2').then((res) => {
                    this.tableAvailData = res.data.data.columns,
                        this.obj1 = this.tableAvailData.reduce((o, key) => ({...o, [key.name]: {value: 0}}), {});
                    // for(var i=0; i < 25; i++) {
                    this.addRow(2);
                    // }
                    this.visibleAddRow = true;
                });
                // }
            },
            getAvailableData() {
                // window.axios.get(env('APP_URL')+'/availabledata/'+this.selectedavl).then((res) => {
                window.axios.get(this.$config.BASE_URL + '/availabledata/' + this.selectedavl).then((res) => {
                    // window.axios.get('http://localhost:8000/availabledata/'+this.selectedavl).then((res) => {
                    this.avlData = res.data;
                });
            },
            proccessGraph() {
                // console.log('incoming');
                this.graphY = [];
                this.graphX = [];
                this.scatterData = [];
                for (var i = 0; i < this.avlDataItems.length; i++) {
                    if (i == 0) {
                        this.graphX.push(parseFloat(this.avlDataItems[i]['vo2gen'].value));
                    } else {
                        this.graphX.push.apply(this.graphX, [parseFloat(this.avlDataItems[i]['vo2gen'].value)])
                    }
                }
                for (var i = 0; i < this.avlDataItems.length; i++) {
                    if (i == 0) {
                        this.graphY.push(parseFloat(this.avlDataItems[i]['heart_rate'].value));
                    } else {
                        this.graphY.push.apply(this.graphY, [parseFloat(this.avlDataItems[i]['heart_rate'].value)])
                    }
                }
                for (var i = 0; i < this.avlDataItems.length; i++) {
                    if (i == 0) {
                        this.scatterData.push({
                            y: parseFloat(this.avlDataItems[i]['heart_rate'].value),
                            x: parseFloat(this.avlDataItems[i]['vo2gen'].value)
                        });
                    } else {
                        this.scatterData.push({
                            y: parseFloat(this.avlDataItems[i]['heart_rate'].value),
                            x: parseFloat(this.avlDataItems[i]['vo2gen'].value)
                        })
                    }
                }
                // console.log(this.scatterData);
                this.trendLine();
            },
            addRow(type) {
                if (type == 1) {
                    this.items.push(JSON.parse(JSON.stringify(this.obj)));
                }
                if (type == 2) {
                    this.avlDataItems.push(JSON.parse(JSON.stringify(this.obj1)));
                }
            },
            removeRow(index) {
                this.items.splice(index, 1)
            },
            onEditorChange($event) {
            },
            remove(index, type) {
                if (type == 1) {
                    this.items.splice(index, 1);
                } else if (type == 2) {
                    this.avlDataItems.splice(index, 1);
                    this.calculateVO2Gen('', 0);
                }
                // this.$emit('removeRow');
                // this.$emit('remove');
            },
            updateCol(idx1, idx2, event) {

            },
            calculatePower() {
                this.power = (this.hrp - this.Intercept) / this.Slope;
                // console.log(this.power);
                return this.power;
            },
            calculateHRPeak() {
                if (hrPeak == null) {
                    this.hrPeak = 208 - 0.7;
                }
            },
            addColumn() {

            },
            // This should implement as reusable - soon
            calculateSlope() {

                this.N = this.avlDataItems.length;
                this.X = this.avlDataItems;
                this.Y = this.avlDataItems;

                this.SX = this.SY = this.SXY = this.SXX = this.SYY = 0;

                for (var i = 0; i < this.N; i++) {
                    this.SX = this.SX + parseFloat(this.X[i]['t_name'].value);
                    this.SY = this.SY + parseFloat(this.Y[i]['heart_rate'].value);
                    this.SXY = this.SXY + parseFloat(this.X[i]['t_name'].value) * parseFloat(this.Y[i]['heart_rate'].value);
                    this.SXX = this.SXX + parseFloat(this.X[i]['t_name'].value) * parseFloat(this.X[i]['t_name'].value);
                    this.SYY = this.SYY + parseFloat(this.Y[i]['heart_rate'].value) * parseFloat(this.Y[i]['heart_rate'].value);
                }

                this.Slope = ((this.N * this.SXY) - (this.SX * this.SY)) / ((this.N * this.SXX) - (this.SX * this.SX));
                this.calculateIntercept();

            },
            calculateIntercept() {
                this.Intercept = (this.SY - (this.Slope * this.SX)) / this.N;
            },
            calculateSpeed(i) {
                if (parseFloat(this.avlDataItems[i]['t_name'].value) < 30) {
                    this.avlDataItems[i]['speed'].value = 0;
                } else {
                    this.avlDataItems[i]['speed'].value = Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2);
                }
                this.speed = Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2);
            },
            calculateVO2Gen(col, i) {
                if (this.avlDataItems[i]['t_name'].value == "") {
                    this.avlDataItems[i]['vo2gen'] = 0;
                } else {
                    this.avlDataItems[i]['vo2gen'].value = (3.5 + 3.5 + 1.8 * (parseFloat(this.avlDataItems[i]['t_name'].value)) * 6 / this.weight).toFixed(1);
                }

                // not optimized | speed
                if (parseFloat(this.avlDataItems[i]['t_name'].value) < 30) {
                    this.avlDataItems[i]['speed'].value = 0;
                } else {
                    this.avlDataItems[i]['speed'].value = (Math.round((Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100).toFixed(1);
                }

                // not optimized | mets percentage
                if (parseFloat(this.avlDataItems[i]['vo2gen'].value) == "") {
                    this.avlDataItems[i]['metsGen'].value = 0;
                } else {
                    this.avlDataItems[i]['metsGen'].value = (Math.round(((parseFloat(this.avlDataItems[i]['vo2gen'].value) / 3.5)) * 100) / 100).toFixed(1);
                }

                // not optimized | set vo2peak
                if (this.hrp == "") {
                    this.items[0]['VO2peak'].value = "";
                } else {
                    this.items[0]['VO2peak'].value = Math.round(this.calculateVO2Peak(parseFloat(this.items[0]['HRpeak'].value)) * 100) / 100;
                }

                // not optimized | set vo2peak estimated
                if (this.hrp == "") {
                    this.items[0]['vo2peakEst'].value = "";
                    this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value);
                } else {
                    this.items[0]['vo2peakEst'].value = (Math.round((parseFloat(this.items[0]['VO2peak'].value) / this.weight * 1000) * 100) / 100).toFixed(1);
                    this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value);
                }

                // not optimized | vo2 percentage
                if (this.hrp == "" || this.hrp == 0) {
                    this.avlDataItems[i]['vo2genpercent'].value = "";
                } else {
                    if (parseFloat(this.avlDataItems[i]['heart_rate'].value) == "") {
                        this.avlDataItems[i]['vo2genpercent'].value = "";
                    } else {
                        // this.avlDataItems[i]['vo2genpercent'].value = ((parseFloat(this.avlDataItems[i]['vo2gen'].value)  / parseFloat(this.items[0]['vo2peakEst'].value)).toFixed(4));
                        // this.avlDataItems[i]['vo2genpercent'].value = Math.round(((parseFloat(this.avlDataItems[i]['vo2gen'].value)  / 32.7 ) * 100)*100) / 100;
                        this.calPercentv();
                    }
                }

                // not optimized | mets
                if (parseFloat(this.items[0]['vo2peakEst'].value) == "") {
                    this.items[0]['METspeak'].value = "";
                } else {
                    this.items[0]['METspeak'].value = (Math.round((parseFloat(this.items[0]['vo2peakEst'].value) / 3.5) * 100) / 100).toFixed(1);
                }

                // not optimized | rpe mak
                if (this.calculateRPEPeak() == 0) {
                    this.items[0]['RPEpeak'].value = "";
                } else {
                    this.items[0]['RPEpeak'].value = this.calculateRPEPeak();
                }

                // not optimized | set vo2 range
                if (this.hrp == "") {
                    this.items[0]['VO2range'].value = "";
                } else {
                    this.items[0]['VO2range'].value = (Math.round((parseFloat(this.items[0]['vo2peakEst'].value) - 3.5) * 100) / 100).toFixed(1);
                }

                // not optimized | set power peak
                if (this.hrp == "") {
                    this.items[0]['Powerpeak'].value = "";
                } else {
                    this.calculateSlope();
                    this.items[0]['Powerpeak'].value = this.calculatePower().toFixed(0);
                }

                // not optimized | set hr peak
                if (isNaN(parseFloat(this.hrp))) {
                    this.items[0]['HRpeak'].value = (208 - 0.7 * this.client.age).toFixed(0);
                } else {
                    this.items[0]['HRpeak'].value = this.hrp;
                }

                // not optimized | set predicted hr peak
                this.items[0]['predHrp'].value = (208 - 0.7 * this.client.age).toFixed(0);

                // not optimized | set speed
                this.items[0]['Speedpeak'].value = (Math.round(this.calculateSpeedPeak(parseFloat(this.items[0]['Powerpeak'].value)) * 100) / 100).toFixed(1);

                // var datanew = new Array(
                //     new Array(17.2,18.4,19.7,21.0),
                //     new Array(85,90,95,100)
                // );
                // this.correlation = parseFloat(this.pearsonCorrelation(this.scatterData,0,1)).toFixed(2);
                // Math.correlation

                // Proccess graph
                // this.proccessGraph();
                // Proccess graph
                this.proccessGraph();
                this.fillData();
                this.fillData2();
                this.correlation = parseFloat(this.pearson(this.scatterData)).toFixed(3);

            },
            calPercentv() {
                for (let i = 0; i < this.avlDataItems.length; i++) {
                    this.avlDataItems[i]['vo2genpercent'].value = (((parseFloat(this.avlDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)).toFixed(3)) * 100).toFixed(0);
                    // this.avlDataItems[i]['vo2genpercent'].value = (Math.round(((parseFloat(this.avlDataItems[i]['vo2gen'].value)  / parseFloat(this.items[0]['vo2peakEst'].value)) * 100)*100) / 100).toFixed(0);
                }
            },
            calculateMETsPeak() {
                this.metsPeak = this.vo2Peak / 3.5;
            },
            calculateSpeedPeak(power) {

                return Math.round((Math.sqrt((power - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100;

            },
            calculateRPEPeak() {

                // process vo2 array
                for (var i = 0; i < this.Nvo2; i++) {
                    this.rpeArray.push(this.avlDataItems[i]['rpe'].value);
                }
                var max = this.rpeArray.reduce(function (a, b) {
                    return Math.max(a, b);
                });
                return max;
            },
            calculateVO2Range() {
                this.vo2Range = this.vo2Peak - 3.5;
            },
            calculatePredictedHRPeak() {
                this.hrPeakPredicted = 208 - (0.7 * this.age);
            },
            calculateVO2PeakEst() {
                this.vo2Peak = Math.round((this.vo2Gen / this.weight * 1000) * 100) / 100;
            },
            calculateVO2Peak(hrp) {
                // cal slope
                this.Nvo2 = this.avlDataItems.length;
                this.Xvo2 = this.avlDataItems;
                this.Yvo2 = this.avlDataItems;

                this.SXB = this.SYB = this.SXYB = this.SXXB = this.SYYB = 0;

                // can use array reduce instead of for loop, it's pretty | lakmal
                // this.SXB = this.Xvo2.reduce((a, b) => a['vo2gen'] + b['vo2gen'], 0);

                for (var i = 0; i < this.Nvo2; i++) {
                    this.SXB = this.SXB + parseFloat(this.Xvo2[i]['vo2gen'].value);
                    this.SYB = this.SYB + parseFloat(this.Yvo2[i]['heart_rate'].value);
                    this.SXYB = this.SXYB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                    this.SXXB = this.SXXB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Xvo2[i]['vo2gen'].value);
                    this.SYYB = this.SYYB + parseFloat(this.Yvo2[i]['heart_rate'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                }

                this.slopeB = ((this.Nvo2 * this.SXYB) - (this.SXB * this.SYB)) / ((this.Nvo2 * this.SXXB) - (this.SXB * this.SXB));
                this.InterceptB = (this.SYB - (this.slopeB * this.SXB)) / this.Nvo2;

                this.vo2Gen = ((hrp - this.InterceptB)) / (this.slopeB) * this.weight / 1000;
                // console.log(this.vo2Gen);
                return Math.round(this.vo2Gen * 100) / 100;
            },
            /**
             *  Calculate the person correlation score between two items in a dataset.
             *
             *  @param  {object}  prefs The dataset containing data about both items that
             *                    are being compared.
             *  @param  {string}  p1 Item one for comparison.
             *  @param  {string}  p2 Item two for comparison.
             *  @return {float}  The pearson correlation score.
             */
            pearsonCorrelation(prefs, p1, p2) {
                var si = [];

                for (var key in prefs[p1]) {
                    if (prefs[p2][key]) si.push(key);
                }

                var n = si.length;

                if (n == 0) return 0;

                var sum1 = 0;
                for (var i = 0; i < si.length; i++) sum1 += prefs[p1][si[i]];

                var sum2 = 0;
                for (var i = 0; i < si.length; i++) sum2 += prefs[p2][si[i]];

                var sum1Sq = 0;
                for (var i = 0; i < si.length; i++) {
                    sum1Sq += Math.pow(prefs[p1][si[i]], 2);
                }

                var sum2Sq = 0;
                for (var i = 0; i < si.length; i++) {
                    sum2Sq += Math.pow(prefs[p2][si[i]], 2);
                }

                var pSum = 0;
                for (var i = 0; i < si.length; i++) {
                    pSum += prefs[p1][si[i]] * prefs[p2][si[i]];
                }

                var num = pSum - (sum1 * sum2 / n);
                var den = Math.sqrt((sum1Sq - Math.pow(sum1, 2) / n) *
                    (sum2Sq - Math.pow(sum2, 2) / n));

                if (den == 0) return 0;

                return num / den;
            },
            pearson(values) {
                const n = values.length;

                if (n == 0) return 0;

                let meanX = 0;
                let meanY = 0;
                for (var i = 0; i < n; i++) {
                    meanX += values[i].x / n
                    meanY += values[i].y / n
                }

                let num = 0;
                let den1 = 0;
                let den2 = 0;

                for (var i = 0; i < n; i++) {
                    let dx = (values[i].x - meanX);
                    let dy = (values[i].y - meanY);
                    num += dx * dy
                    den1 += dx * dx
                    den2 += dy * dy
                }

                const den = Math.sqrt(den1) * Math.sqrt(den2);

                if (den == 0) return 0;

                return num / den;
            },
            // calculate trend line
            trendLine() {
                // initialize data
                // already initialized

                // calculate slope
                // already calculated in vo2 peak function
                // return ((this.count*this.xySum) - (this.xAxisValuesSum*this.yAxisValuesSum))/((this.count*this.xxSum) - (this.xAxisValuesSum*this.xAxisValuesSum));

                // calculate intercept
                // already calculated in vo2 peak function
                // return (this.yAxisValuesSum - (this.Slope*this.xAxisValuesSum))/this.count;

                // calculate start point
                // return (this.Slope*this.xAxisValues.First()) + this.Intercept;
                this.startPoint = (this.slopeB * this.graphX[0]) + this.InterceptB;

                // calculate end point
                // return (this.Slope*this.xAxisValues.Last()) + this.Intercept;
                this.endPoint = (this.slopeB * this.graphX[(this.Nvo2 - 1)]) + this.InterceptB;

                // console.log(this.startPoint,this.endPoint);
                this.trendLineData = [{y: this.startPoint, x: this.graphX[0]}, {
                    y: this.endPoint,
                    x: this.graphX[(this.Nvo2 - 1)]
                }]
                // this.trendLineData = [this.startPoint,this.endPoint];
            }

        }

    })
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat");

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
    }

    #section-b-2 {
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
</style>


