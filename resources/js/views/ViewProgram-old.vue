<template>
    <div class>
        <!-- Section A | Client Card, Search, Select Test -->
        <section id="section-a" class="row grid">
            <ClientCard :client="client"></ClientCard>
            <div class="grid col-md-6" style="display:grid;align-items: center;">
                <div class="form-group mx-sm-3 mb-2 col-md-12" id="testNameInput" style="padding: 0px;">
                    <input v-model="test_name" type="text" class="form-control-lg" id="testNameInput" placeholder="Type some test name here" style="width:inherit;" disabled>
                </div>
                <div class="form-group mx-sm-3 mb-2 col-md-12" id="test-drop-down">
                    <select v-model="selected" id="inputState" class="form-control-lg bg-light" @change="getTableData(1);adjustInputs()" disabled>
                        <option :value="null">Select test</option>
                        <option v-for="testtype in testtypes" :key="testtype.id" v-bind:value="testtype.id">{{ testtype.name }}</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Section B | Test Inputs, Output Tables, Output Charts -->
        <section id="section-b" class="row grid">
            
            <!-- Section B-1 | Input Fields -->
            <section id="section-b-1">

                <div v-if="showForm1" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px; width: 100%;">
                        <label for="colWeight" class="col-sm-2 col-form-label col-form-label-lg">Weight (kg) </label>
                        <div class="col-md-2">
                            <input v-model="weight" type="text" class="form-control form-control-lg" id="colWeight" track-by="$index" placeholder="Weight (kg)" @change="createInputArray($event, weight)">
                        </div>
                        <label for="colHR" class="col-sm-2 col-form-label col-form-label-lg">HR Peak</label>
                        <div class="col-md-2">
                            <input v-model="hrp" type="text" class="form-control form-control-lg" id="colHR" placeholder="HR Peak" @change="createInputArray($event, hrp)">
                        </div>
                        <label for="colBP" class="col-sm-2 col-form-label col-form-label-lg">BP Peak</label>
                        <div class="col-md-2">
                            <input v-model="bpp" type="text" class="form-control form-control-lg" id="colBP" placeholder="BP Peak" @change="createInputArray($event, bpp)">
                        </div>
                    </form>
                </div>
                <div v-if="showForm2" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px; width: 100%;">
                        <label for="hrRest" class="col-sm-2 col-form-label col-form-label-lg">HR Rest</label>
                        <div class="col-md-2">
                            <input v-model="hrRest" type="text" class="form-control form-control-lg" id="hrRest" placeholder="HR Rest" @change="createInputArray($event, hrRest)">
                        </div>
                        <label for="bpRest" class="col-sm-2 col-form-label col-form-label-lg">BP rest</label>
                        <div class="col-md-2">
                            <input v-model="bpRest" type="text" class="form-control form-control-lg" id="bpRest" placeholder="BP rest" @change="createInputArray($event, bpRest)">
                        </div>
                    </form>
                </div>
                <div v-if="showForm3" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px; width: 100%;">
                        <label for="extraWeight" class="col-sm-2 col-form-label col-form-label-lg">Extra Weight</label>
                        <div class="col-md-2">
                            <input v-model="extraWeight" type="text" class="form-control form-control-lg" id="extraWeight" placeholder="Extra Weight" @change="createInputArray($event, extraWeight)">
                        </div>
                    </form>
                </div>
                <div v-if="showForm4" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px; width: 100%;">
                        <label for="colHeight" class="col-sm-2 col-form-label col-form-label-lg">Height (cm) </label>
                        <div class="col-md-2">
                            <input v-model="height" type="text" class="form-control form-control-lg" id="colHeight" placeholder="Height (cm)" @change="createInputArray($event, height)">
                        </div>
                        <label for="colRSH" class="col-sm-2 col-form-label col-form-label-lg">Recommended Step Height (cm)</label>
                        <div class="col-md-2">
                            <input v-model="recomStepHeight" type="text" class="form-control form-control-lg" id="colRSH" placeholder="Recommended Step Height (cm)" @change="checkStepHeight();createInputArray($event, recomStepHeight)">
                        </div>
                        <label for="colPSH" class="col-sm-2 col-form-label col-form-label-lg">Preferred Step Height (cm)</label>
                        <div class="col-md-2">
                            <input v-model="prefStepHeight" type="text" class="form-control form-control-lg" id="colPSH" placeholder="Preferred Step Height (cm)" @change="checkStepHeight();createInputArray($event, prefStepHeight)">
                        </div>
                    </form>
                </div>
                
            </section>

            <!-- Section B-2 | Chart -->
            <section id="section-b-2">
                <label for="correl" class="col-sm-2 col-form-label col-form-label-lg">Linear Correlation</label>
                <input type="text" v-model="correlation" id="correl" disabled>
                <div class="row" style="display:flex;"> 
                    <div class="col-md-3">
                        <div class="legend">
                            <div class="legend-1">
                                <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                                <p style="margin-bottom: 0px;">ml/kg/min</p>
                            </div>
                            <div class="legend-2">
                                <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{vo2PeakEST}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores ut vel ad nihil impedit numquam sunt alias totam molestias sapiente.</p>
                    </div>
                </div>

                <div class="linechart">
                    <scatter-chart :chart-data="datacollection" :test="datasetsfull"></scatter-chart>
                </div>

                <div class="linechart">
                    <female-norms-chart :chart-data="datacollection2" :test="datasetsfull"></female-norms-chart>
                </div>

                <div class="">
                    <table class="table-responsive" style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                        <thead style="background-color:#eef1f9;">
                            <tr>
                                <th v-for="tableCol in tableData" :key="tableCol.id" style="padding: 10px;">
                                    <p style="margin-bottom: 0px;">{{tableCol.heading}}</p>
                                    <p style="margin-bottom: 0px;font-size: 12px; font-weight: lighter;">{{tableCol.sub_heading}}</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#eef1f9;">
                            <tr v-for="(row, idx1) in items" :key="idx1">
                                <td class="table-success" v-for="(col, idx2) in row" :key="idx2">                     
                                    <input v-model="col.value" type="text" @change="onEditorChange($event)" style="max-width: 146px;" disabled/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </section>

            <!-- Secction B-4 | Available Data table -->
            <Section  id="section-b-3">
                <table class="table-responsive" style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                    <thead style="background-color:#eef1f9;">
                        <tr>
                            <th v-for="tableColb in tableAvailData" :key="tableColb.id" style="padding: 10px;">
                                <p style="margin-bottom: 0px;">{{tableColb.heading}}</p>
                                <p style="margin-bottom: 0px;font-size: 12px; font-weight: lighter;">{{tableColb.sub_heading}}</p>
                            </th>
                            <th><i class="fas fa-marker"></i></th>
                        </tr>
                    </thead>
                    <tbody style="background-color:#eef1f9;">
                        <tr v-for="(rowb, idx1b) in avlDataItems" :key="idx1b">
                            <td class="table-success" v-for="(colb, idx2b) in rowb" :key="idx2b" @change="calculateVO2Gen(colb,idx1b)">                     
                                <input v-model="colb.value" type="text" style="max-width: 146px;" disabled/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button v-if="visibleAddRow" @click="addRow(1,1)">add row</button>
            </Section>

        </section>

        <!-- Section C | Append New Program -->
        <section id="section-c" class="row grid">

            <h2>Append new program to the above test</h2>
            <div class="new-program">
                <form class="form-inline" style="width: inherit; align-items: end; justify-content: space-between;">
                    <button type="button" class="btn btn-danger btn-lg btn-block" @click="startProgram()">Start Program</button>
                </form>
            </div>
            
        </section>

        <!-- Section D | Program Data -->
        <section id="section-d" class="row grid">

            <table class="table client-list">
                <thead>
                    <tr class="bg-light client-list-heading">
                        <th scope="col">Programs</th>
                        <th scope="col" class="text-center">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-light" v-for="program in programs" :key="program.id">
                        <td class="td-client-list" colspan="2">
                            <p class="client-name p-l-2">Program ID : {{ program.id }}</p>
                            <p class="d-inline p-l-2">Program Name : {{ program.name }}</p>
                            <p class="d-inline p-l-2">Created at : {{ program.created_at }}</p>
                            <p class="d-inline p-l-2">Test ID : {{ program.test_id }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

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
        testdata: {
            type: Object
        },
        testid:0,
        test_type:0,
    },
    mounted () {
        this.getTestData()
        // this.fillData(),
        // this.fillData2()
    },
    components: {
        ClientCard,
        LineChart,
        ScatterChart,
        FemaleNormsChart
    },
    data () {
        return {
            datacollection: null,
            datacollection2: null,
            tableData: [],
            tableAvailData: [],
            testData: [],
            error: null,
            loading: false,
            selected: '',
            selectedavl: '',
            items:[],
            options:  {
                scales: {
                    yAxes: [{
                        type: 'logarithmic'
                    }]
                }
            },
            avlDataItems:[],
            avlData:[],
            tempArray:[],
            obj: Object,
            scatterObj: Object,
            Intercept:null, 
            InterceptB:null, 
            slopeB:null, 
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
            weight:null,
            extraWeight: 0,
            height:null,
            recomStepHeight:null,
            prefStepHeight:null,
            hrp:null,
            hrRest:null,
            bpRest:null,
            bpp:null,
            power:201,
            speed:null,
            metsPeak:null,
            vo2Peak:null,
            vo2PeakEST:null,
            vo2Range:null,
            hrPeak:null,
            hrPeakPredicted:null,
            age:null,
            vo2Gen:2.76,
            graphY: [],
            graphX: [],
            scatterData: [],
            rpeArray: [],
            speedArray: [],
            vo2Array: [],
            correlation: null,
            startPoint: null,
            endPoint: null,
            trendLineData: [],
            visibleAddRow:false,
            gradient:null,
            vo2GenWalk:null,
            vo2GenRun:null,
            tables:null,
            objTest: Object,
            test_name: '',
            table1_id: 0,
            table2_id: 0,
            testId:0,
            showModal:false,
            showForm1:false,
            showForm2:false,
            showForm3:false,
            showForm4:false,
            programEnabled:false,
            inputFields: [],
            programs: [],
        }
    },
    watch: {
    },
    computed: {
        datasetsfull () {
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
        fillData () {
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
                        data: [{x:(this.items.length > 0 ? this.items[0]['vo2peakEst'].value:0),y:(this.items.length > 0 ? this.items[0]['HRpeak'].value : 0)}], // send VO2 peak and hrpeak here 
                        borderColor: '#dd4b45',
                        borderWidth: 10,
                        pointBackgroundColor: "#dd4b45",
                        pointStyle: 'rect',
                        rotation: 45
                    }
                ]
            }
        },
        fillData2 () { //  norms for VO2 peak
            if (this.client.gender == 'male') {
                this.datacollection2 = {
                    labels: [0,10,20,30,40,50,60,70,80,90,100,110,120],
                    datasets: [
                        {
                            label: 'Excellent',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':62.5},{'x':12.5,'y':66},{'x':75,'y':31},{'x':99,'y':18}],
                            borderColor: '#dd4b45',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Very Good',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':57},{'x':12.5,'y':60},{'x':75,'y':28},{'x':99,'y':16}],
                            borderColor: '#84d14e',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Good',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':50.5},{'x':12.5,'y':53},{'x':75,'y':25},{'x':99,'y':14}],
                            borderColor: '#3259b7',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Average',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':45},{'x':12.5,'y':47},{'x':75,'y':22.5},{'x':99,'y':12}],
                            borderColor: '#b466dc',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Fair',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':38},{'x':12.5,'y':40.7},{'x':75,'y':19},{'x':99,'y':10}],
                            borderColor: '#527429',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Needs Improvement',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':32.5},{'x':12.5,'y':34.5},{'x':75,'y':16.5},{'x':99,'y':7}],
                            borderColor: '#8b66ef',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'You are here',
                            showLabel:true,
                            filltext: 'testing text',
                            labelTextColor: '#e68a51',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':this.client.age,'y':this.vo2PeakEST}], // send age and VO2 peak here
                            borderColor: '#000000',
                            borderWidth: 1,
                            pointBackgroundColor: "#000000",
                            pointStyle: 'rect',
                        }
                    ]
                }
            } else {
                this.datacollection2 = {
                    labels: [0,10,20,30,40,50,60,70,80,90,100,110,120],
                    datasets: [
                        {
                            label: 'Excellent',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':56},{'x':9,'y':57.5},{'x':75,'y':23},{'x':99,'y':10}],
                            borderColor: '#dd4b45',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Very Good',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':51},{'x':9,'y':53},{'x':75,'y':21.5},{'x':99,'y':9}],
                            borderColor: '#84d14e',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Good',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':45.5},{'x':9,'y':47},{'x':75,'y':20},{'x':99,'y':8}],
                            borderColor: '#3259b7',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Average',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':40},{'x':9,'y':41.7},{'x':75,'y':17},{'x':99,'y':7}],
                            borderColor: '#b466dc',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Fair',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':34.7},{'x':9,'y':35.8},{'x':75,'y':14.7},{'x':99,'y':6}],
                            borderColor: '#527429',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'Needs Improvement',
                            showLabel:false,
                            backgroundColor: '#f5f5f500',
                            data: [{'x':1,'y':29},{'x':9,'y':30.2},{'x':75,'y':12.4},{'x':99,'y':5}],
                            borderColor: '#8b66ef',
                            borderWidth: 1,
                            radius:0
                        },
                        {
                            label: 'You are here',
                            showLabel:true,
                            filltext: 'testing text',
                            labelTextColor: '#e68a51',
                            backgroundColor: '#f5f5f500',
                            data: [{'x':this.client.age,'y':this.vo2PeakEST}], // send age and VO2 peak here
                            borderColor: '#000000',
                            borderWidth: 1,
                            pointBackgroundColor: "#000000",
                            pointStyle: 'rect',
                        }
                    ]
                }
            }
            
        },
        getRandomInt () {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        },
        getTestData (type) {
            this.selected = this.test_type;
            var param1 = this.selected;
            console.log('*');
            console.log(param1);
            console.log('*');
            // window.axios.get('http://localhost:8000/api/test-types/'+(param1)).then((res) => {
            window.axios.get(this.$config.BASE_URL + '/api/test-types/'+(param1)).then((res) => {
                this.tables = res.data.data.tables;
                // console.log(res.data.data);
                // console.log(this.tables);
                for (var i = 0; i < this.tables.length; i++) {
                    if(i == 0) {
                        this.tableData = this.tables[i].columns;
                    } else if(i == 1) {
                        this.tableAvailData = this.tables[i].columns;
                    }
                }
            });

            var testIdPara = this.testid;
            // window.axios.get('http://localhost:8000/tests/'+(testIdPara)).then((res) => {
            window.axios.get(this.$config.BASE_URL + '/tests/'+(testIdPara)).then((res) => {
                this.items = res.data.table1,
                this.avlDataItems = res.data.table2,
                this.programs = res.data.programs,
                this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value),
                this.calculateSlopB();
                this.proccessGraph(),
                this.fillData2()
            });
        },
        proccessGraph () {
            this.graphY = [];
            this.graphX = [];
            this.scatterData = [];
            for (var i = 0; i < this.avlDataItems.length; i++) {
                if(i == 0){
                    this.graphX.push(parseFloat(this.avlDataItems[i]['vo2gen'].value));
                } else {
                    this.graphX.push.apply(this.graphX,[parseFloat(this.avlDataItems[i]['vo2gen'].value)])
                }
            }
            for (var i = 0; i < this.avlDataItems.length; i++) {
                if(i == 0){
                    this.graphY.push(parseFloat(this.avlDataItems[i]['heart_rate'].value));
                } else {
                    this.graphY.push.apply(this.graphY,[parseFloat(this.avlDataItems[i]['heart_rate'].value)])
                }
            }
            for (var i = 0; i < this.avlDataItems.length; i++) {
                if(i == 0){
                    this.scatterData.push({y:parseFloat(this.avlDataItems[i]['heart_rate'].value),x:parseFloat(this.avlDataItems[i]['vo2gen'].value)});
                } else {
                    this.scatterData.push({y:parseFloat(this.avlDataItems[i]['heart_rate'].value),x:parseFloat(this.avlDataItems[i]['vo2gen'].value)});
                }
            }
            this.trendLine();
            this.fillData();
            this.correlation = parseFloat(this.pearson(this.scatterData)).toFixed(3);

        },
        // This should implement as reusable - soon
        calculateSlope() {

            this.N = this.avlDataItems.length;
            this.X = this.avlDataItems;
            this.Y = this.avlDataItems;

            this.SX = this.SY = this.SXY = this.SXX = this.SYY =0;

            for (var i = 0; i < this.N; i++) {
                if(parseFloat(this.X[i]['t_name'].value) != 0) {
                    this.SX = this.SX + parseFloat(this.X[i]['t_name'].value);
                    this.SY = this.SY + parseFloat(this.Y[i]['heart_rate'].value);
                    this.SXY = this.SXY + parseFloat(this.X[i]['t_name'].value) * parseFloat(this.Y[i]['heart_rate'].value);
                    this.SXX = this.SXX + parseFloat(this.X[i]['t_name'].value) * parseFloat(this.X[i]['t_name'].value);
                    this.SYY = this.SYY + parseFloat(this.Y[i]['heart_rate'].value) * parseFloat(this.Y[i]['heart_rate'].value);
                }
            }

            this.Slope = ((this.N * this.SXY) - (this.SX * this.SY)) / ((this.N * this.SXX) - (this.SX * this.SX));
            this.calculateIntercept();
            
        },
        calculateIntercept () {
            this.Intercept = (this.SY - (this.Slope * this.SX)) / this.N;
            console.log(this.Intercept);
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
        trendLine () {
            this.startPoint = (this.slopeB  * this.graphX[0]) + this.InterceptB;

            this.endPoint = (this.slopeB  * this.graphX[(this.Nvo2-1)]) + this.InterceptB;

            this.trendLineData = [{y:this.startPoint,x:this.graphX[0]},{y:this.endPoint,x:this.graphX[(this.Nvo2-1)]}]
        },
        calculateSlopB () {
            // cal slope
            this.Nvo2 = this.avlDataItems.length;
            this.Xvo2 = this.avlDataItems;
            this.Yvo2 = this.avlDataItems;

            this.SXB = this.SYB = this.SXYB = this.SXXB = this.SYYB = 0;

            for (var i = 0; i < this.Nvo2; i++) {
                if(parseFloat(this.Xvo2[i]['t_name'].value) != 0) {
                    // console.log(parseFloat(this.Xvo2[i]['t_name'].value));
                    this.SXB  = this.SXB + parseFloat(this.Xvo2[i]['vo2gen'].value);
                    this.SYB  = this.SYB + parseFloat(this.Yvo2[i]['heart_rate'].value);
                    this.SXYB = this.SXYB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                    this.SXXB = this.SXXB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Xvo2[i]['vo2gen'].value);
                    this.SYYB = this.SYYB + parseFloat(this.Yvo2[i]['heart_rate'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                }
            }

            this.slopeB = ((this.Nvo2 * this.SXYB) - (this.SXB * this.SYB)) / ((this.Nvo2 * this.SXXB) - (this.SXB * this.SXB));
            this.InterceptB = (this.SYB - (this.slopeB * this.SXB)) / this.Nvo2;

        },
        startProgram() {
            // window.location.href = 'http://localhost:8000/new-program?user_id=2&test_id='+this.testId;
            window.location.href = this.$config.BASE_URL + '/new-program?user_id=2&test_id='+this.testid;
        },
        validateData() {
            if(this.avlDataItems.length < 1){
                alert('feed some data to table');
                return false;
            }
            return true;
        },
    }
    
})
</script>

<style scoped>

    .container-full-width {
        width: 100vw!important;
        max-width: 100vw!important;
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
        max-width: 146px!important;
    }

    .input {
        max-width: 146px!important;
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

    .client-list {
        border-collapse: separate;
        border-spacing: 0em 0.5em;
    }

    .new-program {
        width: 100%;
        display: flex;
    }

    .small {
        /* max-width: 1000px; */
        margin:  100px auto;
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