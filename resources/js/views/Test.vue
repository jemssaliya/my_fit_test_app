<template>
    <div>
        <!-- Section A | Client Card, Search, Select Test -->
        <section id="section-a">
            <div class="row">
                <div class="col-md-4">
                    <ClientCard :client="client"></ClientCard>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="testNameInput">
                        <input v-model="test_name" type="text" class="form-control form-control-lg test-dropdown w-100"
                               id="testNameInput" placeholder="Type some test name here">
                    </div>
                    <div class="form-group" id="test-drop-down">
                        <select v-model="selected" id="inputState"
                                class="form-control form-control-lg bg-light test-dropdown w-100"
                                @change="getTableData(1);adjustInputs()">
                            <option :value="null">Select test</option>
                            <option v-for="testtype in testtypes" :key="testtype.id" v-bind:value="testtype.id">{{
                                testtype.name }}
                            </option>
                        </select>
                    </div>
                    <div v-if="showProtocol" class="form-group" id="test-drop-down">
                        <select v-model="selectedProtocol" id="inputState"
                                class="form-control form-control-lg bg-light w-100"
                                @change="getProtocolData(1);adjustInputs()">
                            <option :value="null">Select protocol</option>
                            <option v-for="protocol in protocols" :key="protocol.id"
                                    v-bind:value="protocol.protocols.id">{{ protocol.protocols.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section B | Test Inputs, Output Tables, Output Charts -->
        <section id="section-b">

            <!-- Section B-1 | Input Fields -->
            <section id="section-b-1" class="table-responsive">

                <div v-if="showForm1 || showForm2" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="width: 100%;">
                        <table>
                            <tr>
                                <td v-if="showForm1">
                                    <label for="colWeight"
                                           class="col-sm-12 col-form-label col-form-label-lg input-labal">Weight
                                        (kg) </label>
                                </td>
                                <td v-if="showForm1">
                                    <div class="col-md-12">
                                        <input v-model="weight" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input" id="colWeight"
                                               placeholder="Weight (kg)"
                                               @change="createInputArray($event, weight)">
                                    </div>
                                </td>

                                <td v-if="showForm1">
                                    <label for="colHR" class="col-sm-12 col-form-label col-form-label-lg input-labal">HR
                                        Peak</label>
                                </td>
                                <td v-if="showForm1">
                                    <div class="col-md-12">
                                        <input v-model="hrp" type="number" step="0.1"
                                               class="form-control bg-white form-control-sm test-input" id="colHR"
                                               placeholder="HR Peak" @change="createInputArray($event, hrp)">
                                    </div>
                                </td>

                                <td v-if="showForm2">
                                    <label for="hrRest" class="col-sm-12 col-form-label col-form-label-lg input-labal">HR
                                        Rest</label>
                                </td>
                                <td v-if="showForm2">
                                    <div class="col-md-12">
                                        <input v-model="hrRest" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input" id="hrRest"
                                               placeholder="HR Rest" @change="createInputArray($event, hrRest)">
                                    </div>
                                </td>

                                <td v-if="showForm3">
                                    <label for="extraWeight"
                                           class="col-sm-12 col-form-label col-form-label-lg input-labal">Extra
                                        Weight</label>
                                </td>
                                <td v-if="showForm3">
                                    <div class="col-md-12">
                                        <input v-model="extraWeight" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input" id="extraWeight"
                                               placeholder="Extra Weight"
                                               @change="createInputArray($event, extraWeight)">
                                    </div>
                                </td>

                            </tr>
                        </table>
                    </form>
                </div>

                <div v-if="showForm4" class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="margin-bottom: 0px; width: 100%;">
                        <table>
                            <tr>
                                <td>
                                    <label for="colHeight"
                                           class="col-sm-12 col-form-label col-form-label-lg input-labal-1">Height
                                        (cm) </label>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <input v-model="height" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input-1" id="colHeight"
                                               placeholder="Height (cm)"
                                               @change="createInputArray($event, height);calculateRecStepHeight();">
                                    </div>
                                </td>
                                <td>
                                    <label for="colRSH"
                                           class="col-sm-12 col-form-label col-form-label-lg input-labal-1">Recommended
                                        Step Height (cm)</label>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <input v-model="recomStepHeight" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input-1" id="colRSH"
                                               placeholder="Recommended Step Height (cm)"
                                               @change="checkStepHeight();createInputArray($event, recomStepHeight)"
                                               disabled>
                                    </div>
                                </td>
                                <td>
                                    <label for="colPSH"
                                           class="col-sm-12 col-form-label col-form-label-lg input-labal-1">Preferred
                                        Step Height (cm)</label>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <input v-model="prefStepHeight" type="number" step="0.01"
                                               class="form-control bg-white form-control-sm test-input-1" id="colPSH"
                                               placeholder="Preferred Step Height (cm)"
                                               @change="checkStepHeight();createInputArray($event, prefStepHeight)">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </section>

            <!-- Section B-2 | Chart -->
            <section id="section-b-2">
                <div class="row legend-collection">
                    <!-- <div class="row test-legend-name">
                        <div class="">
                        <h3 style="height: 18px;width: 100%;font-family: Montserrat !important;"></h3>
                        <p style="height: 18px;width: 100%;;color: #000;font-family: Montserrat !important;font-size: 14px;letter-spacing: 0.17px;line-height: 25px;"></p>
                        </div>
                    </div> -->
                    <div class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">VO2 peak</p>
                            <p class="legend-subheading">ml/kg/min</p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{this.CustomDecimal(vo2PeakEST,1)}}</p>
                        </div>
                    </div>
                    <div class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">HR peak</p>
                            <p class="legend-subheading">%predicted = <span style="color: #0474C8; font-weight: bold;">{{this.CustomDecimal(predictedHrRPeakPercentage,0)}}%</span>
                            </p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{ hrp }}</p>
                            <!-- <p class="legend-value">{{ items[0] ? (items[0]['predHrp'] ? items[0]['predHrp'].value : '') : ''}}</p> -->
                        </div>
                    </div>
                    <div v-if="items[0] ? (items[0]['Powerpeak']) : false" class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">Power peak</p>
                            <p class="legend-subheading">watts</p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{ items[0] ? (items[0]['Powerpeak'] ? items[0]['Powerpeak'].value :
                                '') : ''}}</p>
                        </div>
                    </div>
                    <div class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">Speed peak</p>
                            <p class="legend-subheading" v-if="showForm4">steps per min</p>
                            <p class="legend-subheading" v-if="!showForm4">kph</p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value" v-if="!showForm4">{{ items[0] ? (items[0]['Speedpeak'] ?
                                this.CustomDecimal(items[0]['Speedpeak'].value,1) : '') : ''}}</p>
                            <p class="legend-value" v-if="showForm4">{{ items[0] ? (items[0]['Speedpeak'] ?
                                this.CustomDecimal(items[0]['Speedpeak'].value,0) : '') : ''}}</p>
                        </div>
                    </div>
                    <div v-if="items[0] ? (items[0]['gradient']) : false" class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">Gradient peak</p>
                            <p class="legend-subheading">%</p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{ items[0] ? (items[0]['gradient'] ?
                                this.CustomDecimal(items[0]['gradient'].value,0) : '') : ''}}</p>
                        </div>
                    </div>
                    <div v-if="items[0] ? (items[0]['stepHeight']) : false" class="row test-legend">
                        <div class="legend-1">
                            <p class="legend-heading">Step Height</p>
                            <p class="legend-subheading">cm</p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{ items[0] ? (items[0]['stepHeight'] ? items[0]['stepHeight'].value
                                : '') : ''}}</p>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                        <thead style="background-color:#eef1f9;">
                        <tr>
                            <th v-for="tableCol in tableData" :key="tableCol.id" style="padding: 10px;"
                                :style="{ background: tableCol.pivot.color_code, display: tableCol.pivot.display}"
                                v-if="!hiddenFields.includes(tableCol.name)"
                            >
                                <p class="table-heading-text"><b> {{tableCol.heading}} </b></p>
                                <p class="table-subheading-text">{{tableCol.sub_heading}}</p>
                            </th>
                        </tr>
                        </thead>
                        <tbody style="background-color:#eef1f9;">
                        <tr v-for="(row, idx1) in items" :key="idx1" @remove="removeRow">
                            <td class="table-success td-height" v-for="(col, idx2) in row" :key="idx2"
                                v-if="col.is_hidden"
                                :style="{ background: col.customStyles.color_code, display: col.customStyles.display}">
                                <input v-model="col.value" type="text" @change="onEditorChange($event)"
                                       class="output-table-text"
                                       :style="{ background: col.customStyles.color_code, display: col.customStyles.display}"
                                       disabled/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 2px;margin-top: 10px;">
                        <thead style="background-color:#eef1f9;">
                        <tr>
                            <th><i class="fas fa-marker"></i></th>
                            <th v-for="tableColb in tableAvailData" :key="tableColb.id" style="padding: 10px;"
                                v-if="!hiddenFields.includes(tableColb.name)"
                                :style="{ background: tableColb.pivot.color_code, display: tableColb.pivot.display}">
                                <p class="table-heading-text"><b>{{tableColb.heading}} </b></p>
                                <p class="table-subheading-text">{{tableColb.sub_heading}}</p>
                            </th>
                        </tr>
                        </thead>
                        <tbody style="background-color:#eef1f9;">
                        <tr v-for="(rowb, idx1b) in avlDataItems" :key="idx1b" @remove="removeRow">
                            <button class="btn-remove-row" v-on:click="remove(idx1b,2)">
                                <img src="/images/ic_remove_row.png" alt="">
                            </button>
                            <td class="table-success td-height" v-for="(colb, idx2b) in rowb" :key="idx2b"
                                @change="adjustCalculations(colb,idx1b)" v-if="colb.is_hidden"
                                :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}">
                                <!-- <input v-model="colb.value" type="number" step="any" class="input-table-text" style="display:none" v-if="colb.customStyles.column_id == 1" disabled/> -->
                                <input v-model="colb.value" type="number" step="2" class="input-table-text"
                                       :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}"
                                       v-if="colb.customStyles.is_protected == 1" disabled/>
                                <input v-model="colb.value" type="number" step="2" class="input-table-text"
                                       :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}"
                                       v-if="colb.customStyles.is_protected !== 1"/>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

                <button v-if="visibleAddRow" @click="addRow(1,1)" style="background-color: transparent; border: none;">
                    <img src="/images/plus-flat-bule.png" style="width: 35px;" alt="">
                </button>

                <!--chart-->

                <div class="row" style="margin-bottom:50px;">

                    <div class="col-md-6">
                        <div class="linechart">
                            <div class="text-left mx-2">
                                <p>Linear Correlation: <b>{{this.CustomDecimal(correlation,3)}}</b></p>
                            </div>
                            <scatter-chart :chart-data="datacollection" :test="datasetsfull"></scatter-chart>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="linechart">
                            <div class="mt-3" style="height: 22px;">
                            </div>
                            <female-norms-chart :chart-data="datacollection2" :test="datasetsfull"></female-norms-chart>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Secction B-4 | Available Data table -->
            <Section id="section-b-3">

                <div v-if="testEnabled" class="row"
                     style="display: flex; justify-content: center; margin-top: 10px;font-size: 14px;">
                    <button type="button" class="btn btn-success btn-lg btn-save-program" @click="saveTest()">Generate
                        Test Report
                    </button>
                </div>
                <div v-if="programEnabled" class="row"
                     style="display: flex; justify-content: center; margin-top: 10px;font-size: 14px;">
                    <button type="button" class="btn btn-danger btn-lg btn-start-program" @click="startProgram()">Start
                        Program
                    </button>
                </div>
            </Section>

        </section>

        <!-- Modal -->
        <div v-if="showModal" class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" style="display:block">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #47c55d26;">
                        <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    </div>
                    <div class="modal-body">
                        Test data successfully saved. Now you can start a program.
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="showModal=false" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <a class="btn btn-success" :href="'view-test?client_id=' + client.id+'&test_id='+testId">Show Test Report</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import ClientCard from '../components/ClientCard';
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
        mounted() {
            this.fillData2()
        },
        components: {
            ClientCard,
            LineChart,
            ScatterChart,
            FemaleNormsChart
        },
        data() {
            return {
                datacollection: {},
                datacollection2: {},
                tableData: [],
                protocols: [],
                tableAvailData: [],
                testData: [],
                error: null,
                loading: false,
                selected: '',
                selectedProtocol: '',
                showProtocol: false,
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
                predictedHrRPeakPercentage: 0,
                N: null,
                Nvo2: null,
                weight: null,
                extraWeight: 0,
                height: null,
                recomStepHeight: null,
                prefStepHeight: null,
                hrp: null,
                hrRest: null,
                bpRest: null,
                bpp: null,
                power: 201,
                speed: null,
                metsPeak: null,
                vo2Peak: null,
                vo2PeakEST: null,
                vo2Range: null,
                hrPeak: null,
                hrPeakPredicted: null,
                age: null,
                vo2Gen: 0,
                graphY: [],
                graphX: [],
                scatterData: [],
                speedPeakArray: [],
                rpeArray: [],
                speedArray: [],
                vo2Array: [],
                correlation: null,
                startPoint: null,
                endPoint: null,
                trendLineData: [],
                visibleAddRow: false,
                gradient: null,
                vo2GenWalk: null,
                vo2GenRun: null,
                tables: null,
                objTest: Object,
                test_name: '',
                table1_id: 0,
                table2_id: 0,
                testId: 0,
                showModal: false,
                showForm1: false,
                showForm2: false,
                showForm3: false,
                showForm4: false,
                programEnabled: false,
                testEnabled: true,
                inputFields: [],
                slopeToSave: 0,
                interceptToSave: 0,
                hiddenFields: ['stepHeight']
            }
        },
        watch: {
            // call again the method if the route changes
            // '$route': 'getTableData'
        },
        computed: {
            filteredNames() {
            },
            createRPEArray() {
            },
            createVO2Array() {
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
        filters: {
            CustomDecimal1: function (value) {
                console.log('in 1');
                if (typeof value !== "undefined") {
                    var cnt = 1;
                    console.log('in 2');
                    if (typeof value !== "number") {
                        console.log('not number');
                        return value;
                    }
                    if (!isNaN(parseFloat(value))) {
                        console.log('in 3');
                        return this.value.toFixed(cnt);
                    }
                }
            }
        },
        methods: {
            CustomDecimal(value, cnt = 1) {
                if (value != null && value != '') {
                    if (!isNaN(value)) {
                        if (value == Math.floor(value)) {
                            return value;
                        } else {
                            return parseFloat(value).toFixed(cnt);
                        }
                        return value;
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
            },
            fillData() {
                this.datacollection = {
                    labels: this.graphX,
                    datasets: [
                        {
                            label: 'VO2peak',
                            backgroundColor: '#f5f5f500',
                            data: [{
                                x: (this.items[0]['vo2peakEst'].value ? this.items[0]['vo2peakEst'].value : 0),
                                y: (this.items[0]['HRpeak'].value ? this.items[0]['HRpeak'].value : 0)
                            }], // send VO2 peak and hrpeak here
                            borderColor: '#dd4b45',
                            borderWidth: 10,
                            pointBackgroundColor: "#dd4b45",
                            pointStyle: 'circle',
                            rotation: 45,
                            showLabel: true
                        },
                        {
                            label: 'Heart Rate',
                            backgroundColor: '#f5f5f500',
                            data: this.scatterData,
                            // data: this.graphY,
                            borderColor: '#82cd4d',
                            borderWidth: 1,
                            showLine: false,
                            pointBackgroundColor: "#82cd4d"
                        },
                        {
                            label: 'Trend',
                            backgroundColor: '#f5f5f500',
                            data: this.trendLineData,
                            borderColor: '#82cd4d',
                            borderWidth: 4,
                            showLine: true,
                        }
                    ]
                }
            },
            fillData2() { //  norms for VO2 peak
                if (this.client.gender == 'Male') {
                    this.datacollection2 = {
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
                } else {
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
                }

            },
            getRandomInt() {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            },
            getTableData(type) {
                this.loading = true;
                // initializing arrays
                this.tableData = [];
                this.tableAvailData = [];
                this.items = [];
                this.avlDataItems = [];
                // need optimization to remove these codes
                var param1 = this.selected;

                // New implementation for table manipulation
                //   window.axios.get('http://localhost:8000/api/test-types/'+(param1)).then((res) => {
                window.axios.get(this.$config.BASE_URL + '/api/test-types/' + (param1)).then((res) => {
                    // console.log(res.data.data)
                    this.tables = res.data.data.tables;
                    this.protocols = res.data.data.protocols;
                    for (var i = 0; i < this.tables.length; i++) {
                        if (i === 0) {
                            this.tableData = this.tables[i].columns;
                            this.obj = this.tables[i].columns.reduce((o, key) => ({
                                ...o,
                                [key.name]: {
                                    value: null,
                                    customStyles: key.pivot,
                                    column_id: key.id,
                                    is_hidden: !this.hiddenFields.includes(key.name)
                                }
                            }), {});
                            this.addRow(i, 1);
                            this.table1_id = this.tables[i].id;
                            //console.log(this.table1_id);
                            // console.log(this.obj);
                        } else if (i == 1) {
                            this.tableAvailData = this.tables[i].columns;
                            this.obj1 = this.tables[i].columns.reduce((o, key) => ({
                                ...o,
                                [key.name]: {
                                    value: null,
                                    customStyles: key.pivot,
                                    column_id: key.id,
                                    is_hidden: !this.hiddenFields.includes(key.name)
                                }
                            }), {});
                            this.addRow(i, 12);
                            this.table2_id = this.tables[i].id;
                            //  console.log(this.table2_id);
                            //  console.log(this.obj1);
                            this.visibleAddRow = true;
                        }
                    }
                    this.selectedProtocol = '';
                    if (this.protocols.length < 1) {
                        this.showProtocol = false;
                    } else {
                        this.showProtocol = true;
                    }
                    this.fillData();
                });

            },
            getProtocolData() {
                var param1 = this.selectedProtocol;
                window.axios.get(this.$config.BASE_URL + '/protocols/' + (param1)).then((res) => {
                    const {table1: protocolDatas} = res.data;

                    for (var i = 0; i < Object.keys(protocolDatas).length; i++) {
                        if (i == 0) {
                            for (var ix = 0; ix < protocolDatas[i].length; ix++) {
                                console.log(protocolDatas[i][ix]);
                                this.avlDataItems[i][protocolDatas[i][ix].column_name].value = parseFloat(protocolDatas[i][ix].value).toFixed(2);
                            }
                        } else {

                            if (typeof this.avlDataItems[i] == 'undefined') {
                                this.addRow(1, 1);
                            }
                            for (var ix = 0; ix < protocolDatas[i].length; ix++) {
                                this.avlDataItems[i][protocolDatas[i][ix].column_name].value = parseFloat(protocolDatas[i][ix].value).toFixed(2);
                                this.calculateVO2Gen('', 0);
                            }

                        }
                    }
                    this.adjustCalculations(1, 1);

                });
            },
            getAvailableData() {
                window.axios.get(this.$config.BASE_URL + '/availabledata/' + this.selectedavl).then((res) => {
                    //   window.axios.get('http://localhost:8000/availabledata/'+this.selectedavl).then((res) => {
                    this.avlData = res.data;
                });
            },
            proccessGraph() {
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
                        });
                    }
                }
                this.trendLine();
            },
            addRow(type, count) {
                if (type == 0) {
                    this.items.push(JSON.parse(JSON.stringify(this.obj)));
                    for (var i = 0; i < this.items.length; i++) {
                        this.items[i]['row_id'].value = i;
                    }
                }
                if (type == 1) {
                    for (var i = 0; i < count; i++) {
                        this.avlDataItems.push(JSON.parse(JSON.stringify(this.obj1)));
                    }
                }
                // this.addColor();
                this.adjustRowNumbers();
            },
            addColor() {
                let rowCount = 0;
                this.avlDataItems.forEach(element => {
                    //  console.log(element);
                    for (var property in element) {
                        this.avlDataItems.concat(['background']);
                        // console.log(this.avlDataItems);
                        // console.log(property);
                        // this.avlDataItems.push();
                    }
                    rowCount++;
                });
            },
            adjustCalculations(col, x) {
                for (var i = 0; i < this.avlDataItems.length; i++) {
                    this.calculateVO2Gen(1, i);
                }
                this.adjustRowNumbers();
                if (typeof this.items[0]['hrRest'] !== 'undefined') {
                    this.items[0]['hrRest'].value = this.hrRest;
                }

                var hrp = isNaN(parseFloat(this.hrp)) ? 0 : this.hrp;
                var predHrp = this.items.length && this.items[0]['predHrp'] ? parseFloat(this.items[0]['predHrp'].value) : 0;

                this.predictedHrRPeakPercentage = isNaN(predHrp) || predHrp == 0 ? 0 : Math.floor((hrp / predHrp) * 100);
                // this.predictedHrRPeakPercentage = isNaN(parseFloat(this.predictedHrRPeakPercentage)) ? 0 : (this.predictedHrRPeakPercentage * 100).toFixed(1);
            },
            removeRow(index) {
                this.items.splice(index, 1)
                this.adjustRowNumbers();
            },
            onEditorChange($event) {
            },
            adjustRowNumbers() {
                for (var i = 0; i < this.avlDataItems.length; i++) {
                    this.avlDataItems[i]['row_id'].value = i;
                }
            },
            // adjustRowNumbers () {
            //     for (var i = 0; i < this.items.length; i++) {
            //         this.items[i]['row_id'].value = i;
            //     }
            // },
            remove(index, type) {
                if (type == 1) {
                    this.items.splice(index, 1);
                } else if (type == 2) {
                    this.avlDataItems.splice(index, 1);
                    this.calculateVO2Gen('', 0);
                }
                this.adjustRowNumbers();
                // this.$emit('removeRow');
                // this.$emit('remove');
            },
            updateCol(idx1, idx2, event) {

            },
            calculatePower() {
                this.power = (this.hrp - this.Intercept) / this.Slope;
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
                    if (parseFloat(this.X[i]['t_name'].value) != 0) {
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
            calculateIntercept() {
                this.Intercept = (this.SY - (this.Slope * this.SX)) / this.N;
                // console.log(this.Intercept);
                if (this.selected == 1) {
                    // if(!isNaN(parseFloat(this.Slope)) || parseFloat(this.Slope !== 0)) {
                    this.slopeToSave = this.Slope;
                    this.interceptToSave = this.Intercept;
                    // }
                }
                // if(!isNaN(parseFloat(this.Slope)) || parseFloat(this.Slope !== 0)) {
                //     // this.slopeToSave = this.Slope;
                //     // this.interceptToSave = this.Intercept;
                // }
                if (this.selected == 2 || this.selected == 3 || this.selected == 4) {
                    // if(!isNaN(parseFloat(this.slopeB)) || parseFloat(this.slopeB !== 0)) {
                    this.slopeToSave = this.slopeB;
                    this.interceptToSave = this.InterceptB;
                    // }
                }
            },
            calculateSpeed(i) {
                var floatVal = 0;
                floatVal = parseFloat(this.avlProgramDataItems[i]['t_name'].value);
                if (isNaN(floatVal) || floatVal < 30) {
                    this.avlDataItems[i]['speed'].value = '';
                } else {
                    floatVal = Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2);
                    this.avlDataItems[i]['speed'].value = isNaN(floatVal) ? '' : (floatVal).toFixed(1);
                }
                this.speed = isNaN(floatVal) ? '' : (floatVal).toFixed(1);
            },
            calculateVO2Gen(col, i) {
                var floatVal = 0;
                // Calculate vo2Gen - cycle test
                if (this.selected == 1) {
                    floatVal = parseFloat(this.avlDataItems[i]['t_name'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2gen'].value = '';
                    } else {
                        floatVal = (3.5 + 3.5 + 1.8 * (parseFloat(this.avlDataItems[i]['t_name'].value)) * 6 / this.weight).toFixed(1);
                        this.avlDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal;
                    }
                }

                // Calculate vo2Gen - walk test
                if (this.selected == 2) {
                    floatVal = parseFloat(this.avlDataItems[i]['speed'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2gen'].value = '';
                    } else {
                        floatVal = parseFloat(this.avlDataItems[i]['heart_rate'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.avlDataItems[i]['vo2gen'].value = '';
                        } else {
                            floatVal = ((parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.1 + 3.5) + (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8)) * (parseFloat(this.weight) + parseFloat(this.extraWeight)) / parseFloat(this.weight);
                            this.avlDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : (floatVal).toFixed(1);
                        }
                    }
                }

                // Calculate vo2Gen - run test
                if (this.selected == 3) {
                    floatVal = parseFloat(this.avlDataItems[i]['speed'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2gen'].value = '';
                    } else {
                        floatVal = parseFloat(this.avlDataItems[i]['heart_rate'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.avlDataItems[i]['vo2gen'].value = '';
                        } else {
                            floatVal = ((parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.2 + 3.5) + (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8 * 0.5)) * (parseFloat(this.weight) + parseFloat(this.extraWeight)) / parseFloat(this.weight);
                            this.avlDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : (floatVal).toFixed(1);
                        }
                    }
                }

                // Calculate vo2Gen - step test
                if (this.selected == 4) {
                    floatVal = parseFloat(this.avlDataItems[i]['speed'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2gen'].value = '';
                    } else {
                        floatVal = ((0.2 * parseFloat(this.avlDataItems[i]['speed'].value) + 2.394 * 0.01 * parseFloat(this.avlDataItems[i]['stepHeight'].value) * parseFloat(this.avlDataItems[i]['speed'].value) + 3.5)) * (parseFloat(this.weight) + parseFloat(this.extraWeight)) / parseFloat(this.weight);
                        this.avlDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : (floatVal).toFixed(1);
                        // this.avlDataItems[i]['vo2gen'].value = ((parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.2 + 3.5) + (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100)* 1.8*0.5 )) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                    }
                }

                // not optimized | speed
                if (this.selected == 1) {
                    floatVal = parseFloat(this.avlDataItems[i]['t_name'].value);
                    if (isNaN(floatVal) || floatVal < 30) {
                        this.avlDataItems[i]['speed'].value = '';
                    } else {
                        floatVal = (Math.round((Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100).toFixed(1);
                        this.avlDataItems[i]['speed'].value = isNaN(floatVal) ? '' : floatVal;
                    }
                }

                // not optimized | mets percentage
                floatVal = parseFloat(this.avlDataItems[i]['vo2gen'].value);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.avlDataItems[i]['metsGen'].value = '';
                } else {
                    floatVal = (Math.round(((parseFloat(this.avlDataItems[i]['vo2gen'].value) / 3.5)) * 100) / 100).toFixed(1);
                    this.avlDataItems[i]['metsGen'].value = isNaN(floatVal) ? '' : floatVal;
                }

                // not optimized | set vo2peak
                floatVal = parseFloat(this.hrp);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.items[0]['VO2peak'].value = '';
                } else {
                    floatVal = Math.round(this.calculateVO2Peak(parseFloat(this.items[0]['HRpeak'].value)) * 100) / 100;
                    this.items[0]['VO2peak'].value = (isNaN(floatVal) ? '' : (floatVal).toFixed(2));
                }

                // not optimized | set vo2peak estimated
                floatVal = parseFloat(this.hrp);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.items[0]['vo2peakEst'].value = '';
                    this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value);
                } else {
                    floatVal = (Math.round((parseFloat(this.items[0]['VO2peak'].value) / this.weight * 1000) * 100) / 100).toFixed(2);
                    this.items[0]['vo2peakEst'].value = (isNaN(floatVal) ? '' : floatVal);
                    this.vo2PeakEST = (parseFloat(this.items[0]['vo2peakEst'].value));
                }

                // not optimized | vo2 percentage
                floatVal = parseFloat(this.hrp);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.avlDataItems[i]['vo2genpercent'].value = '';
                } else {
                    // floatVal = parseFloat(this.avlDataItems[i]['t_name'].value);
                    floatVal = parseFloat((typeof this.avlDataItems[i]['t_name'] !== 'undefined') ? this.avlDataItems[i]['t_name'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2genpercent'].value = '';
                    } else {
                        this.calPercentv();
                    }
                }
                //  console.log(this.selected);
                if (this.selected == 2 || this.selected == 3) {
                    // console.log(this.hrp);
                    floatVal = parseFloat(this.hrp);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2genpercent'].value = '';
                    } else {
                        // floatVal = parseFloat(this.avlDataItems[i]['t_name'].value);
                        floatVal = parseFloat((typeof this.avlDataItems[i]['heart_rate'] !== 'undefined') ? this.avlDataItems[i]['heart_rate'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.avlDataItems[i]['vo2genpercent'].value = '';
                        } else {
                            this.calPercentv();
                        }
                    }
                }

                // not optimized | set vo2 percentage step test
                if (this.selected == 4) {
                    floatVal = parseFloat(this.avlDataItems[i]['speed'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['vo2genpercent'].value = '';
                    } else {
                        floatVal = parseFloat(this.avlDataItems[i]['heart_rate'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.avlDataItems[i]['vo2genpercent'].value = '';
                        } else {
                            this.calPercentv();
                            // this.avlDataItems[i]['vo2genpercent'].value = Math.round(this.calculateVO2Peak(this.avlDataItems[i]['vo2gen'].value)) * 100 ) / 100;
                        }
                    }
                }

                // not optimized | mets
                floatVal = parseFloat(this.items[0]['vo2peakEst'].value);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.items[0]['METspeak'].value = "";
                } else {
                    floatVal = (Math.round((parseFloat(this.items[0]['vo2peakEst'].value) / 3.5) * 100) / 100).toFixed(1);
                    this.items[0]['METspeak'].value = (isNaN(floatVal) ? '' : floatVal);
                }

                // not optimized | rpe mak
                floatVal = parseFloat(this.calculateRPEPeak());
                if (isNaN(floatVal) || floatVal < 1) {
                    this.items[0]['RPEpeak'].value = '';
                } else {
                    this.items[0]['RPEpeak'].value = this.calculateRPEPeak();
                }

                // not optimized | speed max
                if (this.selected == 2) {
                    floatVal = parseFloat(this.calculateSpeedPeakWalk());
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.items[0]['Speedpeak'].value = '';
                    } else {
                        this.items[0]['Speedpeak'].value = this.calculateSpeedPeakWalk();
                    }
                }

                // not optimized | setvo2 range
                floatVal = parseFloat(this.hrp);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.items[0]['VO2range'].value = '';
                } else {
                    floatVal = (Math.round((parseFloat(this.items[0]['vo2peakEst'].value) - 3.5) * 100) / 100).toFixed(1);
                    this.items[0]['VO2range'].value = isNaN(floatVal) ? '' : floatVal;
                }

                // not optimized | set power peak
                if (this.selected == 1) {
                    floatVal = parseFloat(this.hrp);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.items[0]['Powerpeak'].value = "";
                    } else {
                        this.calculateSlope();
                        floatVal = this.calculatePower().toFixed(0);
                        this.items[0]['Powerpeak'].value = isNaN(floatVal) ? '' : floatVal;
                    }
                }

                // not optimized | set hr peak
                // console.log(this.hrp);
                floatVal = parseFloat(this.hrp);
                // console.log(isNaN(floatVal)); //false
                //  console.log(parseFloat(floatVal) < 1); // false
                //  console.log(Number(floatVal) < 1); // false
                //  console.log(floatVal);
                if (isNaN(floatVal) || parseFloat(floatVal) < 1) {
                    //  console.log('inside');
                    this.items[0]['HRpeak'].value = (208 - 0.7 * this.client.age).toFixed(0);
                } else {
                    //  console.log('inside out');
                    this.items[0]['HRpeak'].value = this.hrp;
                }

                // not optimized | set predicted hr peak
                if (this.items.length) {
                    this.items[0]['predHrp'].value = (208 - 0.7 * this.client.age).toFixed(0);
                }

                // not optimized | set speed
                if (this.selected == 1) {
                    this.items[0]['Speedpeak'].value = (Math.round(this.calculateSpeedPeak(parseFloat(this.items[0]['Powerpeak'].value)) * 100) / 100).toFixed(1);
                }

                // not optimized | set step height
                if (this.selected == 4) {
                    floatVal = parseFloat(this.avlDataItems[i]['heart_rate'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.avlDataItems[i]['stepHeight'].value = (this.items[0]['stepHeight'].value);
                    }

                    (this.items[0]['VO2range'].value < 0) ? (this.items[0]['VO2range'].value = 0) : '';
                }

                if (this.selected == 3 || this.selected == 4) {
                    floatVal = parseFloat(this.calculateSpeedPeakWalk());
                    this.items[0]['Speedpeak'].value = floatVal;
                }

                // Proccess graph
                this.proccessGraph();
                this.fillData();
                this.fillData2();
                this.correlation = parseFloat(this.pearson(this.scatterData)).toFixed(3);
                if (this.selected == 2) {
                    this.gradientWalk();
                }
                if (this.selected == 3) {
                    this.gradientRun();
                }

                this.removeDecimalPoints();
            },
            calPercentv() {
                // console.log('calculate perc')
                for (let i = 0; i < this.avlDataItems.length; i++) {
                    var floatVal = (((parseFloat(this.avlDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)).toFixed(3)) * 100);
                    this.avlDataItems[i]['vo2genpercent'].value = (isNaN(floatVal) || floatVal < 0) ? '' : floatVal.toFixed(0);
                    // this.avlDataItems[i]['vo2genpercent'].value = (Math.round(((parseFloat(this.avlDataItems[i]['vo2gen'].value)  / parseFloat(this.items[0]['vo2peakEst'].value)) * 100)*100) / 100).toFixed(0);
                }
            },
            calculateMETsPeak() {
                var floatVal = this.vo2Peak / 3.5;
                this.metsPeak = isNaN(floatVal) ? '' : floatVal;
            },
            calculateSpeedPeak(power) {

                return Math.round((Math.sqrt((power - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100;

            },
            calculateRPEPeak() {
                var max = '';
                this.rpeArray = [];
                // process vo2 array
                if (this.avlDataItems.length > 0) {
                    for (var i = 0; i < this.Nvo2; i++) {
                        this.rpeArray.push(this.avlDataItems[i]['rpe'].value);
                    }
                    if (this.rpeArray.length > 0) {
                        max = this.rpeArray.reduce(function (a, b) {
                            return Math.max(a, b);
                        });
                    }
                }
                return max;
            },
            // calculateSpeedPeak () {
            // var max = '';
            // this.rpeArray = [];
            // // process vo2 array
            // if (this.avlDataItems.length > 0) {
            //     for (var i = 0; i < this.Nvo2; i++) {
            //         this.rpeArray.push(this.avlDataItems[i]['speed'].value);
            //     }
            //     if (this.rpeArray.length > 0) {
            //         max = this.rpeArray.reduce(function(a, b) {
            //             return Math.max(a, b);
            //         });
            //     }
            // }
            // return max;
            // },
            calculateSpeedPeakWalk() {
                // process vo2 array
                var max = '';
                this.speedArray = [];
                if (this.avlDataItems.length > 0) {
                    for (var i = 0; i < this.Nvo2; i++) {
                        this.speedArray.push(this.avlDataItems[i]['speed'].value);
                    }
                    if (this.speedArray.length > 0) {
                        var max = this.speedArray.reduce(function (a, b) {
                            return Math.max(a, b);
                        });
                    }
                }
                return max;
            },
            calculateVO2Range() {
                this.vo2Range = isNaN(this.vo2Peak - 3.5) ? '' : (this.vo2Peak - 3.5);
            },
            calculatePredictedHRPeak() {
                this.hrPeakPredicted = 208 - (0.7 * this.client.age);
                // this.hrPeakPredicted = 208 - (0.7 * this.age);
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

                // can use array reduce instead of for loop, it's pretty |
                // this.SXB = this.Xvo2.reduce((a, b) => a['vo2gen'] + b['vo2gen'], 0);
                // console.log(this.Xvo2);
                // console.log(this.Nvo2);
                for (var i = 0; i < this.Nvo2; i++) {

                    if (parseFloat(this.Xvo2[i]['heart_rate'].value) != 0) {
                        this.SXB = this.SXB + parseFloat(this.Xvo2[i]['vo2gen'].value);
                        this.SYB = this.SYB + parseFloat(this.Yvo2[i]['heart_rate'].value);
                        this.SXYB = this.SXYB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                        this.SXXB = this.SXXB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Xvo2[i]['vo2gen'].value);
                        this.SYYB = this.SYYB + parseFloat(this.Yvo2[i]['heart_rate'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                    }
                }

                this.slopeB = ((this.Nvo2 * this.SXYB) - (this.SXB * this.SYB)) / ((this.Nvo2 * this.SXXB) - (this.SXB * this.SXB));
                this.InterceptB = (this.SYB - (this.slopeB * this.SXB)) / this.Nvo2;
                if (!isNaN(parseFloat(this.slopeB)) || parseFloat(this.slopeB !== 0)) {
                    this.slopeToSave = this.slopeB;
                    this.interceptToSave = this.InterceptB;
                }

                this.vo2Gen = ((hrp - this.InterceptB)) / (this.slopeB) * this.weight / 1000;
                return Math.round(this.vo2Gen * 100) / 100;
            },
            // Calculate Gradient - walk test
            gradientWalk() {
                if (this.hrPeak == "") {
                    this.items[0]['gradient'].value = 0;
                } else {
                    var floatVal = ((parseFloat(this.items[0]['vo2peakEst'].value) * (parseFloat(this.weight) / (parseFloat(this.weight) + parseFloat(this.extraWeight))) - (parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 0.1 + 3.5)) / ((parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 1.8))).toFixed(2) * 100;
                    this.items[0]['gradient'].value = isNaN(floatVal) ? '' : floatVal;
                }
            },
            gradientRun() {
                if (this.hrPeak == "") {
                    this.items[0]['gradient'].value = 0;
                } else {
                    var floatVal = ((parseFloat(this.items[0]['vo2peakEst'].value) * (parseFloat(this.weight) / (parseFloat(this.weight) + parseFloat(this.extraWeight))) - (parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 0.2 + 3.5)) / ((parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 0.9))).toFixed(2) * 100;
                    this.items[0]['gradient'].value = isNaN(floatVal) ? '' : floatVal;
                }
            },
            /**
             *  Calculate the pearson correlation score between two items in a dataset.
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

                this.trendLineData = [{y: this.startPoint, x: this.graphX[0]}, {
                    y: this.endPoint,
                    x: this.graphX[(this.Nvo2 - 1)]
                }]
                // this.trendLineData = [this.startPoint,this.endPoint];
            },
            checkStepHeight() {
                // not optimized | set step height
                if (this.prefStepHeight == "") {
                    this.items[0]['stepHeight'].value = this.recomStepHeight;
                } else {
                    this.items[0]['stepHeight'].value = this.prefStepHeight;
                }
            },
            calculateVolume() {
                // volume = intensity * weight * atHR / 60 * 4.185;
            },
            calculateSetsToLose() {
                // setsToLose = 9000 * 4.185 / volume;
            },
            saveTest() {
                let self = this;
                // var testIdReturned = '';
                if (!this.validateData()) {

                } else {
                    //   window.axios.post('http://localhost:8000/tests', {
                    window.axios.post(this.$config.BASE_URL + '/tests', {
                        name: this.test_name,
                        age: this.client.age,
                        client_id: this.client.id,
                        client_id: this.client.id,
                        test_type: this.selected,
                        table1: this.items,
                        table2: this.avlDataItems,
                        table1_id: this.table1_id,
                        table2_id: this.table2_id,
                        inputFields: this.inputFields,
                        slope: this.slopeToSave,
                        intercept: this.interceptToSave,
                    })
                        .then(function (response) {
                            //  console.log(response.data.data.id);
                            self.testId = response.data.data.id;
                            self.showModal = true;
                            self.programEnabled = true;
                            self.testEnabled = false;
                        })
                        .catch(function (error) {
                            // console.log(error);
                        });
                }

            },
            startProgram() {
                //  window.location.href = 'http://localhost:8000/new-program?client_id='+this.client.id+'&test_id='+this.testId;
                if (this.testId > 0) {
                    window.location.href = this.$config.BASE_URL + '/new-program?client_id=' + this.client.id + '&test_id=' + this.testId;
                }
            },
            validateData() {
                if (this.avlDataItems.length < 1) {
                    alert('feed some data to table');
                    return false;
                }
                return true;
            },
            calculateRecStepHeight() {
                if (this.height > 1) {
                    this.recomStepHeight = 0.125 * this.height;
                }
            },
            adjustInputs() {
                // initialize
                this.showForm1 = false;
                this.showForm2 = false;
                this.showForm3 = false;
                this.showForm4 = false;

                if (this.selected == 1) {
                    this.showForm1 = true;
                    this.showForm2 = true;
                } else if (this.selected == 2) {
                    this.showForm1 = true;
                    this.showForm2 = true;
                    this.showForm3 = false;
                } else if (this.selected == 3) {
                    this.showForm1 = true;
                    this.showForm2 = true;
                    this.showForm3 = false;
                } else if (this.selected == 4) {
                    this.showForm1 = true;
                    this.showForm2 = true;
                    this.showForm3 = false;
                    this.showForm4 = true;
                }
            },
            createInputArray(event, value) {
                if (this.inputFields.length > 0) {
                    var i = 0;
                    var found = false;
                    this.inputFields.forEach(element => {
                        if (element['name'] == event.target.id) {
                            this.inputFields[i].value = value;
                            found = true;
                        }
                        i++;
                    });
                    if (!found) {
                        this.inputFields.push({
                            labal: event.target.placeholder,
                            name: event.target.id,
                            fieldId: event.target.id,
                            value: value
                        });
                    }
                    //  console.log(this.inputFields);
                } else {
                    this.inputFields.push({
                        labal: event.target.placeholder,
                        name: event.target.id,
                        fieldId: event.target.id,
                        value: value
                    });
                }

                this.adjustCalculations(1, 1);
                // <p v-html="title"></p>
            },
            // steppedLine: true,
            removeEmptyRows() {
                for (var i = 0; i < this.avlDataItems; i++) {
                    if (this.avlDataItems[i] == null) {
                        this.avlDataItems.splice(i, 1);
                    }
                }
                this.calculateVO2Gen('', 0);
                this.adjustRowNumbers();
            },
            removeDecimalPoints() {

                // if (this.avlDataItems.length > 0) {
                //     for (var i = 0; i < this.avlDataItems.length; i++) {
                //         this.avlDataItems[i]['vo2gen'].value = this.CustomDecimal(this.avlDataItems[i]['vo2gen'].value, 1);
                //         this.avlDataItems[i]['vo2genpercent'].value = this.CustomDecimal(this.avlDataItems[i]['vo2genpercent'].value, 1);
                //     }
                // }
            }

        }

    })
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .container-full-width {
        width: 100vw !important;
        max-width: 100vw !important;
    }

    .threshold:before {
        content: "\00b0"
    }

    .box {
        padding: 1em;
        color: #fff;
    }

    #section-a {
        background-color: #bfc8d7;
        margin: 0 -15px 1rem;
        padding: 2em;
    }

    #section-b {
        margin-bottom: 1em;
    }

    #section-b-1 {
        background-color: #bfc8d7;
        width: 100%;
        border-top-left-radius: 1em;
        border-top-right-radius: 1em;
        margin-bottom: 4px !important;
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

    #colWeight, #colHR, #colBP {
        /* width: inherit;*/
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

    .linechart {
        height: 470px;
        border-radius: 6px;
        background-color: #EEF1F9;
        margin: auto;
        margin-top: 30px;
        padding: 20px 20px 20px;
    }

    .test-legend {
        height: 74px;
        width: 280px;
        border-radius: 6px;
        background-color: #EEF1F9;
        padding: 8px;
        margin: auto;
    }

    .test-legend-name {
        height: 74px;
        width: 220px;
        background-color: white;
        margin: auto;
    }

    .legend-value {
        height: 37px;
        color: #0474C8;
        font-size: 30px;
        font-weight: 600;
        letter-spacing: 0.36px;
        line-height: 37px;
        margin: auto;
    }

    .legend-heading {
        height: 29px;
        color: #0474C8;
        font-size: 24px;
        font-weight: 600;
        letter-spacing: 0.29px;
        line-height: 29px;
        margin-bottom: auto;
        font-family: Montserrat !important;
    }

    .legend-subheading {
        height: 18px;
        color: #000;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.17px;
        line-height: 18px;
        font-family: Montserrat !important;
        margin: auto;
    }

    .legend-collection {
        /* margin-right: 0px;
        margin-left: 0px; */
        padding: 8px;
    }

    .detail-row {
        margin: -12px;
        padding: 10px;
        background-color: #D6DDEA;
    }

    .legend {
        padding: 5px;
        background-color: #ffffff87;
        border-radius: 5px;
        position: absolute;
        right: 15px;
        height: 70px;
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

    .input-labal {
        height: 19px;
        width: 130px !important;
        color: #000;
        font-family: Montserrat !important;
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.19px;
        line-height: 19px;
    }

    .test-input {
        height: 44px;
        /* width: 100px !important; */
        font-size: 19px;
        border: 1px solid #989AA1;
        border-radius: 6px;
        background-color: #EEF1F9;
        margin-top: 10px
    }

    .input-labal-1 {
        height: 19px;
        width: 130px !important;
        color: #000;
        font-family: Montserrat !important;
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.19px;
        line-height: 19px;
    }

    .test-input-1 {
        height: 44px;
        /* width: 100px !important; */
        font-size: 19px;
        border: 1px solid #989AA1;
        border-radius: 6px;
        background-color: #EEF1F9;
        margin-top: 10px
    }

    .table-heading-text {
        height: 19px;
        width: 170px;
        color: #000;
        font-family: Montserrat !important;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.19px;
        line-height: 19px;
        max-width: 170px;
        margin: auto;
    }

    .table-subheading-text {
        height: 18px;
        color: #000;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.17px;
        line-height: 18px;
        max-width: 160px;
        margin: auto;
    }

    .output-table-text {
        height: 20px;
        color: #1B2031;
        font-size: 19px;
        text-align: center;
        font-weight: bold;
        letter-spacing: 0.2px;
        line-height: 20px;
        /* max-width: 160px; */
        height: 31px;
        width: 100%;
        background-color: rgb(238, 241, 249);
    }

    .input-table-text {
        height: 19px;
        color: #1B2031;
        font-size: 19px;
        text-align: center;
        font-weight: bold;
        letter-spacing: 0.19px;
        line-height: 19px;
        height: 31px;
        /* max-width: 160px; */
        height: 31px;
        width: 100%;
    }

    .td-height {
        height: 34px;
        background-color: rgba(255, 255, 249, 0.7);
    }

    .btn-remove-row {
        background: #f0f8ff00;
        border: none;
        height: 31px;
    }

    .btn-save-program {
        height: 44px;
        width: 315px;
        border: 1px solid #36A036;
        border-radius: 3px;
        background-color: #5ABF5A;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.14px;
        text-align: center;
        margin-bottom: 30px !important;
    }

    .btn-start-program {
        height: 44px;
        width: 315px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.14px;
        text-align: center;
        margin-bottom: 30px !important;
    }

    .test-dropdown {
        border: 1px solid #989AA1;
        border-radius: 6px;
        background-color: #EEF1F9;
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
