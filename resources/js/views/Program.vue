<template>
    <div class>
        <!-- Section B | Test Inputs, Output Tables, Output Charts -->
        <section id="section-b" class="row grid">

            <!-- Section B-1 | Input Fields -->
            <!--<section id="section-b-1">
                <div class="row grid" style="margin-right: 0px; margin-left: 0px;">
                    <form class="form-inline" style="padding: 20px; margin-bottom: 0px; width: 100%;">
                        <div style="display:flex; margin:auto;" v-for="inputField in inputFields" v-bind:key="inputField.fieldId">
                            <label  v-bind:key="inputField.fieldId" class="col-form-label col-form-label-lg">{{inputField.labal}} </label>
                            <div class="col-md-2">
                                <input v-model="inputField.value" type="text" class="form-control form-control-lg" v-bind:key="inputField.fieldId" disabled>
                            </div>
                        </div>
                    </form>
                </div>-->

        </section>

        <!-- Section B-2 | Chart -->
        <section id="section-b-2">
            <div class="row legend-collection">
                <div class="row test-legend-name">
                    <div class="">
                        <h3 class="test-name">{{testname ? testname : 'Unnamed'}}</h3>
                        <p class="test-type">{{testtypename}}</p>
                    </div>
                </div>
                <div class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">VO2 peak</p>
                        <p class="legend-subheading">ml/kg/min</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{this.CustomDecimal(vo2PeakEST)}}</p>
                    </div>
                </div>
                <div class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">HR peak</p>
                        <p class="legend-subheading">%predicted =
                            <span style="color: #0474C8; font-weight: bold;">
                                {{this.CustomDecimal(predictedHrRPeakPercentage,0)}}%
                            </span>
                        </p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['HRpeak'] ?
                            this.CustomDecimal(items[0]['HRpeak'].value) : '') : ''}}</p>
                        <!-- <p class="legend-value">{{ items[0] ? (items[0]['HRpeak'] ? items[0]['HRpeak'].value : '') : ''}}</p> -->
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['Powerpeak']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Power peak</p>
                        <p class="legend-subheading">watts</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['Powerpeak'] ?
                            this.CustomDecimal(items[0]['Powerpeak'].value) : '') : ''}}</p>
                    </div>
                </div>
                <div class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Speed peak</p>
                        <p class="legend-subheading" v-if="isSpeedTest">steps per min</p>
                        <p class="legend-subheading" v-if="!isSpeedTest">kph</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['Speedpeak'] ?
                            this.CustomDecimal(items[0]['Speedpeak'].value) : '') : ''}}</p>
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['gradient']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Gradient peak</p>
                        <p class="legend-subheading">%</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['gradient'] ?
                            this.CustomDecimal(items[0]['gradient'].value) : '') : ''}}</p>
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['stepHeight']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Step Height</p>
                        <p class="legend-subheading">cm</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['stepHeight'] ?
                            this.CustomDecimal(items[0]['stepHeight'].value) : '') : ''}}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="form-inline" style="background-color: #fafafb;width: 100%;">
            <div class="form-inline" style="padding: 25px;" v-for="inputField in inputFieldsNew">
                <span
                    style="height: 19px;width: 125px;color: #000;font-family: Montserrat;font-size: 16px;font-weight: 500;letter-spacing: 0.19px;line-height: 19px;">{{inputField.labal}} </span>
                <span
                    style="height: 22px;width: 66px;color: #1B2031;font-family: Montserrat;font-size: 18px;font-weight: bold;letter-spacing: 0.22px;line-height: 22px;">{{inputField.value}} </span>
            </div>
        </section>

        <!-- Section C | Select Program -->
        <section id="section-b-1" class="row grid" style="margin-left: 0; padding-top: 15px; padding-right: 10px;">

            <!-- <div class="new-program">
                    <form class="form-inline" style="width: inherit; align-items: end;">
                        <label for="test-type" class="col-sm-2 col-form-label col-form-label-lg" style="padding-left: 0px; margin:auto;">Type of Test</label>
                        <div style="margin: auto;" id="test-type">
                            <select v-model="selectedTest" id="inputState" class="form-control-lg bg-light program-dropdown" @change="getTableData(1)" disabled>
                                <option selected>Test Type</option>
                                <option v-for="testtype in testtypes" :key="testtype.id" v-bind:value="testtype.id">{{ testtype.name }}</option>
                            </select>
                        </div>
                    </form>
                    <form class="form-inline" style="width: inherit; align-items: end;">
                        <label for="program-drop-down" class="col-sm-1 col-form-label col-form-label-lg" style="padding-left: 0px; margin:auto;">Program</label>
                        <div style="margin: auto;" id="program-drop-down">
                            <select v-model="selected" id="inputState" class="form-control-lg bg-light program-dropdown" @change="getTableData(1)">
                                <option selected>Select program...</option>
                                <option v-for="programtype in programtypes" :key="programtype.id" v-bind:value="programtype.id">{{ programtype.name }}</option>
                            </select>
                        </div>
                    </form>
                </div>-->

            <div class="new-program" style="margin-left: 40px !important;">
                <form class="" style="width: 32%; align-items: end;">
                    <label for="test-type"
                           class="col-sm-4 col-form-label col-form-label-lg pull-left type-of-test-labels"
                           style="padding-left: 0px; margin:auto;">Type of Test</label>
                    <div style="margin: auto;" class="col-md-6 pull-left" id="test-type">
                        <select v-model="selectedTest" id="inputState" class="form-control-lg bg-light program-dropdown"
                                disabled>
                            <option selected>Test Type</option>
                            <option v-for="testtype in testtypes" :key="testtype.id" v-bind:value="testtype.id">{{
                                testtype.name }}
                            </option>
                        </select>
                    </div>
                </form>
                <form class="" style="width: 40%; align-items: end;">
                    <label for="program-drop-down"
                           class="col-sm-2 col-form-label col-form-label-lg pull-left type-of-test-labels"
                           style="padding-left: 0px; margin:auto;">Program</label>
                    <div class="col-md-8 pull-left" style="margin: auto;" id="program-drop-down">
                        <select v-model="selected" id="inputState" class="form-control-lg bg-light program-dropdown"
                                @change="getTableData(1)">
                            <option selected>Select program...</option>
                            <option v-for="programtype in programtypes" :key="programtype.id"
                                    v-bind:value="programtype.id">{{ programtype.name }}
                            </option>
                        </select>
                    </div>
                </form>
                <form class="pull-right" style="width: 22%; align-items: end;">
                    <!-- <label for="program-drop-down" class="col-sm-8 pull-left col-form-label col-form-label-lg type-of-test-labels" style="padding-left: 0px; margin:auto;">Number of Rows</label>
                        <div class="col-md-4 pull-left" style="margin: auto;" id="program-drop-down">
                            <input type="text" class="form-control-lg bg-light" value="" name="" size="4">
                        </div> -->
                </form>
            </div>

        </section>

        <!-- Secction B-4 | Available Data table -->
        <Section id="section-b-3">
            <table class="table-responsive" style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                <thead style="background-color:#eef1f9;">
                <tr>
                    <th><i class="fas fa-marker"></i></th>
                    <th v-for="tableColb in tableProgram" :key="tableColb.id" style="padding: 10px;"
                        v-if="!hiddenFields.includes(tableColb.name)"
                        :style="{ background: tableColb.pivot.color_code, display: tableColb.pivot.display}">
                        <p class="table-heading-text">{{tableColb.heading}}</p>
                        <p class="table-subheading-text">{{tableColb.sub_heading}}</p>
                    </th>
                </tr>
                </thead>
                <tbody style="background-color:#eef1f9;">
                <tr v-for="(rowb, idx1b) in avlProgramDataItems" :key="idx1b" @remove="removeRow">
                    <button class="btn-remove-row" v-on:click="remove(idx1b,2)"
                            style="background-color: transparent; border: none;">
                        <img src="/images/ic_remove_row.png" alt="">
                    </button>
                    <td class="table-success td-height" v-for="(colb, idx2b) in rowb" :key="idx2b"
                        @change="adjustCalculations(colb,idx1b)" v-if="colb.is_hidden"
                        :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}">
                        <input v-model="colb.value" type="number" step="2" class="input-table-text"
                               :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}"
                               v-if="colb.customStyles.is_protected == 1" disabled/>
                        <input v-model="colb.value" type="number" step="0.01" class="input-table-text"
                               @keyup="idx2b ==='duration'?timeFormat($event,colb):null"
                               :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}"
                               v-if="colb.customStyles.is_protected !== 1"/>
                    </td>

                </tr>
                </tbody>
            </table>
            <button v-if="visibleAddRow" @click="addRow(1)" style="background-color: transparent; border: none;">
                <img src="/images/plus-flat-bule.png" style="width: 35px;" alt="">
            </button>
        </Section>

        <section id="section-b-1-1">
            <div class="row" style="margin-bottom:20px;">
                <div class="summery-box mx-0">
                    <table class="table-output">
                        <tbody>
                        <tr style="display: flex;">
                            <td class="summery-header-box">
                                <p class="summery-text">Total kJ for the table above </p>
                            </td>
                            <td class="summery-value-box-1">
                                <p class="summery-value-text">{{this.CustomDecimal(totKJ)}}</p>
                            </td>
                        </tr>
                        <hr>
                        <tr style="display: flex;">
                            <td class="summery-header-box">
                                <p class="summery-text">No. of times the table needs to be repeated to lose 1 kg
                                    fat </p>
                            </td>
                            <td class="summery-value-box-1">
                                <p class="summery-value-text">{{this.CustomDecimal(cycleCount)}}</p>
                            </td>
                        </tr>
                        <hr>
                        <tr style="display: flex;">
                            <td class="summery-header-box">
                                <p class="summery-text">Maximum Intensity: METs </p>
                            </td>
                            <td class="summery-value-box-2">
                                <p class="summery-value-text">{{maxIntensity}}</p>
                            </td>
                        </tr>
                        <hr>
                        <tr style="display: flex;">
                            <td class="summery-header-box">
                                <p class="summery-text">Average Intensity: METs </p>
                            </td>
                            <td class="summery-value-box-2">
                                <p class="summery-value-text">{{this.CustomDecimal(avgIntensity)}}</p>
                            </td>
                        </tr>
                        <hr>
                        <tr style="display: flex;">
                            <td class="summery-header-box">
                                <p class="summery-text">Total time: minutes </p>
                            </td>
                            <td class="summery-value-box-1">
                                <p class="summery-value-text">{{this.CustomDecimal(totTime, 2)}}</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="linechart px-4">
                    <step-chart :chart-data="datacollection" :yLabel="yLabel"></step-chart>
                </div>
            </div>
            <div class="row"
                 style="display: flex; justify-content: center; margin-top: 10px;margin-bottom: 10px !important;">
                <button type="button" class="btn btn-success btn-lg btn-save-program" @click="saveProgram()">Save
                    Program
                </button>
            </div>
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
                        Program data successfully saved.
                    </div>
                    <div class="modal-footer">
                        <a :href="'/view-program?client_id=' + client.id + '&program_id=' + this.programid"
                           class="btn btn-info">View Program Report</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import StepChart from '../components/StepChart.js';

export default ({
    name: 'program',
    weight: null,
    hrp: null,
    bpp: null,
    props: {
        programtypes: {
            type: Array
        },
        client: {
            type: Object
        },
        testdata: {
            type: Object
        },
        testid: 0,
        programid: 0,
        testtypes: {
            type: Array
        },
        testtypeid: 0,
        testname: null,
        testtypename: null,
    },
    mounted() {
        this.getTestData();
        // console.log(programtypes);
        // console.log(testdata);
    },
    components: {
        StepChart,
    },
    data() {
        return {
            datacollection: {},
            datacollection2: {},
            tableData: [],
            tableAvailData: [],
            tableProgram: [],
            testData: [],
            yLabel: "% of VO2 peak",
            error: null,
            loading: false,
            isSpeedTest: false,
            selected: '',
            selectedTest: '',
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
            avlProgramDataItems: [],
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
            extraWeight: 0,
            height: null,
            recomStepHeight: null,
            prefStepHeight: null,
            hrp: 146,
            hrRest: null,
            bpRest: null,
            bpp: null,
            power: 201,
            speed: null,
            metsPeak: null,
            vo2Peak: null,
            vo2PeakEST: null,
            hrPeakCol: 'N/A',
            speedPeakCol: 'N/A',
            powerPeakCol: 'N/A',
            vo2Range: null,
            hrPeak: 146,
            hrPeakPredicted: null,
            age: null,
            vo2Gen: 2.76,
            graphY: [],
            graphX: [],
            labels: [],
            scatterData: [],
            stepData: [],
            rpeArray: [],
            intensityArray: [],
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
            program_name: '',
            table1_id: 0,
            table2_id: 0,
            totKJ: 0,
            cycleCount: 0,
            maxIntensity: 0,
            avgIntensity: 0,
            totIntensity: 0,
            totTime: 0,
            rowCount: 0,
            inputFields: [],
            // inputFieldsNew: [],
            outputFields: [],
            showModal: false,
            emptyRowsCount: 0,
            drawChart: false,
            predictedHrRPeakPercentage: 0,
            // testIdPara: 0,
            hiddenFields: ['intensityEW']
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
        inputFieldsNew: function () {
            return this.inputFields.filter(function (u) {
                return u.name != 'colHR';
            })
        }
    },
    methods: {
        CustomDecimal(value, cnt = 1) {
            if (value != null && value != '') {
                if (!isNaN(value)) {
                    if (value == Math.floor(value)) {
                        return parseFloat(value).toFixed(0);
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
                labels: this.labels,
                datasets: [
                    {
                        label: 'duration',
                        backgroundColor: '#f5f5f500',
                        data: this.stepData, // send VO2 peak and hrpeak here
                        borderColor: '#53565e',
                        pointBackgroundColor: "#53565e",
                        pointStyle: 'rect',
                        rotation: 45,
                        steppedLine: true
                    }
                ]
            }
        },
        getTestData() {
            let testIdPara = this.testid;
            this.selectedTest = this.testtypeid;

            window.axios.get(this.$config.BASE_URL + '/tests/' + (testIdPara)).then((res) => {
                this.items = res.data.table1,
                    this.avlDataItems = res.data.table2,
                    this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value),
                    // this.hrPeakCol = parseFloat(this.items[0]['vo2peakEst'].value),
                    // this.powerPeakCol = parseFloat(this.items[0]['vo2peakEst'].value),
                    // this.speedPeakCol = parseFloat(this.items[0]['vo2peakEst'].value),
                    this.inputFields = res.data.inputFields,
                    this.assignValues();
                this.Slope = parseFloat(res.data.slope);
                // this.slopeB = parseFloat(res.data.slope);
                this.Intercept = parseFloat(res.data.intercept);
                // this.InterceptB = parseFloat(res.data.intercept);
                this.calculateSlopeB();

                let hrPeakFromTest = 0;
                this.inputFields.forEach(element => {
                    if (element.fieldId == 'colHR') {
                        hrPeakFromTest = element.value;
                    }
                });

                this.predictedHrRPeakPercentage = (isNaN(parseFloat(hrPeakFromTest)) ? 0 : hrPeakFromTest) / (isNaN(parseFloat((this.items[0]['predHrp'] ? this.items[0]['predHrp'].value : 0))) ? 0 : this.items[0]['predHrp'].value);
                this.predictedHrRPeakPercentage = isNaN(parseFloat(this.predictedHrRPeakPercentage)) ? 0 : (this.predictedHrRPeakPercentage * 100).toFixed(1);
            });

            if (this.testtypename == 'Step Test') {
                this.isSpeedTest = true;
            }
        },
        getTableData(type) {
            this.loading = true;
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            this.tableProgram = [];
            this.avlProgramDataItems = [];
            // need optimization to remove these codes
            let param1 = this.selected;

            // New implementation for table manipulation
            window.axios.get(this.$config.BASE_URL + '/api/program-types/' + (param1)).then((res) => {
                // console.log(res.data.data)
                this.tables = res.data.data.tables;
                for (let i = 0; i < this.tables.length; i++) {
                    this.tableProgram = this.tables[i].columns;

                    this.tableProgram.map((data, key) => {
                        if(data.sub_heading === "min"){
                            data.sub_heading = "min.sec";
                            return data.sub_heading;
                        }
                    });

                    this.obj1 = this.tables[i].columns.reduce((o, key) => ({
                        ...o,
                        [key.name]: {
                            value: null,
                            customStyles: key.pivot,
                            is_hidden: !this.hiddenFields.includes(key.name)
                        }
                    }), {});

                    this.addRow(16);
                    this.table2_id = this.tables[i].id;
                    this.visibleAddRow = true;
                }

                let program_name = res.data.data.name;

                this.yLabel = program_name.includes("%VO2R")
                    ? "% of VO2 R"
                    : (program_name.includes("%HRR")
                        ? "% of HRR" : "% of VO2 peak");
            });
        },
        calculateSlopeB() {
            // cal slope
            this.Nvo2 = this.avlDataItems.length;
            this.Xvo2 = this.avlDataItems;
            this.Yvo2 = this.avlDataItems;

            this.SXB = this.SYB = this.SXYB = this.SXXB = this.SYYB = 0;

            // can use array reduce instead of for loop, it's pretty | lakmal
            // this.SXB = this.Xvo2.reduce((a, b) => a['vo2gen'] + b['vo2gen'], 0);
            /* console.log(this.Xvo2);
            console.log(this.Nvo2);*/
            for (let i = 0; i < this.Nvo2; i++) {

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
        },
        processGraph() {
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            let prevTime = 0, floatVal = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value)).toFixed(2);
                } else {
                    this.graphX.push.apply(this.graphX, [isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['vo2P'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['vo2P'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.addTimes(this.avlProgramDataItems[i]['duration'].value, this.totTime);
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['duration'].value) : 0;
                    this.labels.push(label);
                    this.labels.push(parseFloat(this.avlProgramDataItems[i]['totDuration'].value));
                }
            }

            //Remove Duplicate Elements
            this.labels = [...new Set(this.labels)];

            //X axis Data Sort
            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                let yVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);
                yVal = isNaN(yVal) ? 0 : yVal;

                if (i === 0 && yVal < 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                } else {
                    this.stepData.push({y: yVal, x: this.timeToDecimal(prevTime)});
                }

                let timeVal = this.avlProgramDataItems[i]['duration'].value;
                if (isNaN(timeVal)) {
                    timeVal = 0;
                }

                prevTime = parseFloat(this.addTimes(prevTime, timeVal));

                if (isNaN(yVal) || yVal < 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                } else {
                    // console.log(`2 Y: ${yVal} <=> X:${prevTime}`)
                    this.stepData.push({y: yVal, x: this.timeToDecimal(prevTime)});
                }

                if (i === (this.avlProgramDataItems.length - 1)) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }
            this.rowCount = this.avlProgramDataItems.length;
        },
        processGraph1() {
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            let prevTime = 0, floatVal = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value));
                } else {
                    this.graphX.push.apply(this.graphX, [isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.addTimes(this.avlProgramDataItems[i]['duration'].value, this.totTime);
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['duration'].value) : 0;
                    this.labels.push(label);
                    this.labels.push(parseFloat(this.avlProgramDataItems[i]['totDuration'].value));
                }
            }

            //Remove Duplicate Labels
            this.labels = [...new Set(this.labels)];

            //Sort the label data
            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0));
                    if (isNaN(floatVal) || floatVal < 0) {
                        this.stepData.push({y: 0, x: 0});
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0));
                        prevTime = isNaN(floatVal) ? 0 : floatVal;

                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        } else {
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
                                x: 0
                            });
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
                                x: this.timeToDecimal(prevTime)
                            });
                        }
                    }
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value);

                    this.stepData.push({
                        y: (isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value)),
                        x: this.timeToDecimal(prevTime)
                    });

                    //Duration Subtotal
                    const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : this.avlProgramDataItems[i]['duration'].value;
                    prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                }

                if (i === this.avlProgramDataItems.length - 1) {
                    // (this.avlProgramDataItems.length - 1 == 0) ? this.stepData.push({y:0,x:0}) : this.stepData.push({y:0,x:prevTime});
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
                // }
            }
            this.rowCount = this.avlProgramDataItems.length;
            this.yLabel = '% of VO2 R';
        },
        processGraph2() {
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            let prevTime = 0, floatVal = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value));
                } else {
                    this.graphX.push.apply(this.graphX, [isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.addTimes(this.avlProgramDataItems[i]['duration'].value, this.totTime);
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['duration'].value) : 0;
                    this.labels.push(label);
                    this.labels.push(parseFloat(this.avlProgramDataItems[i]['totDuration'].value));
                }
            }

            this.labels = [...new Set(this.labels)];

            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    floatVal = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value);

                    if (isNaN(floatVal) || floatVal < 0) {
                        this.drawChart = false;
                    } else {
                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        } else {
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value),
                                x: this.timeToDecimal(prevTime)
                            });
                        }

                        //Duration Subtotal
                        const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : this.avlProgramDataItems[i]['duration'].value;
                        prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        } else {
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value),
                                x: this.timeToDecimal(prevTime)
                            });
                        }
                        this.drawChart = true;
                    }
                } else {
                    floatVal = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value);
                    this.drawChart = !(isNaN(floatVal) || floatVal < 0);
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);

                    this.stepData.push({
                        y: (isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value)),
                        x: this.timeToDecimal(prevTime)
                    });

                    //Duration Subtotal
                    const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : this.avlProgramDataItems[i]['duration'].value;
                    prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                }

                if (i === (this.avlProgramDataItems.length - 1)) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }
            this.rowCount = this.avlProgramDataItems.length;
        },
        processGraph3() {
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            let prevTime = 0, floatVal = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value));
                } else {
                    this.graphX.push.apply(this.graphX, [isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.addTimes(this.avlProgramDataItems[i]['duration'].value, this.totTime);
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['duration'].value) : 0;
                    this.labels.push(label);
                    this.labels.push(parseFloat(this.avlProgramDataItems[i]['totDuration'].value));
                }
            }

            this.labels = [...new Set(this.labels)];

            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    floatVal = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value);
                    if (isNaN(floatVal) || floatVal < 0) {
                        this.stepData.push({y: 0, x: 0});
                    } else {
                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        } else {
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value),
                                x: this.timeToDecimal(prevTime)
                            });
                        }

                        //Duration Subtotal
                        const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : this.avlProgramDataItems[i]['duration'].value;
                        prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value);
                        if (isNaN(floatVal) || floatVal < 1) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        } else {
                            this.stepData.push({
                                y: parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value),
                                x: this.timeToDecimal(prevTime)
                            });
                        }
                    }
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value);

                    this.stepData.push({
                        y: (isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value)),
                        x: this.timeToDecimal(prevTime)
                    });

                    //Duration Subtotal
                    const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : this.avlProgramDataItems[i]['duration'].value;
                    prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition


                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                }
                if (i === (this.avlProgramDataItems.length - 1)) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }
            this.rowCount = this.avlProgramDataItems.length;
            this.yLabel = '% of HRR';
        },
        processGraph4() {
            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;
            let prevTime = 0, floatVal = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['durationT'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['durationT'].value));
                } else {
                    this.graphX.push.apply(this.graphX, [isNaN(parseFloat(this.avlProgramDataItems[i]['durationT'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['durationT'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['vo2P'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['vo2P'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.addTimes(this.avlProgramDataItems[i]['durationT'].value, this.totTime);
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['durationT'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['durationT'].value) : 0;
                    this.labels.push(label);
                    this.labels.push(parseFloat(this.avlProgramDataItems[i]['totDuration'].value));
                }
            }

            this.labels = [...new Set(this.labels)];

            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }

                    //Duration Subtotal
                    const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['durationT'].value)) ? 0 : this.avlProgramDataItems[i]['durationT'].value;
                    prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);

                    this.stepData.push({
                        y: (isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['vo2P'].value)),
                        x: this.timeToDecimal(prevTime)
                    });

                    //Duration Subtotal
                    const current_duration = isNaN(parseFloat(this.avlProgramDataItems[i]['durationT'].value)) ? 0 : this.avlProgramDataItems[i]['durationT'].value;
                    prevTime = parseFloat(this.addTimes(prevTime, current_duration)); //Time addition

                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                }
                if (i === (this.avlProgramDataItems.length - 1)) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }
            this.rowCount = this.avlProgramDataItems.length;
        },
        /**
         * Add Row to datatable
         *
         * @param count
         */
        addRow(count) {
            // if(type == 0) {
            //     this.items.push(JSON.parse(JSON.stringify(this.obj)));
            // }
            // if(type == 1) {
            for (let i = 0; i < count; i++) {
                this.avlProgramDataItems.push(JSON.parse(JSON.stringify(this.obj1)));
            }
            // }
            this.adjustRowNumbers();
            // this.adjustCalculations();
        },
        adjustCalculations(col, x) {
            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.calculateProgramData(1, i);
            }
        },
        removeRow(index) {
            this.items.splice(index, 1)
            this.adjustRowNumbers();
        },
        onEditorChange($event) {
        },
        adjustRowNumbers() {
            for (var i = 0; i < this.avlProgramDataItems.length; i++) {
                this.avlProgramDataItems[i]['row_id'].value = i;
            }
        },
        remove(index, type) {
            if (type == 1) {
                this.items.splice(index, 1);
            } else if (type == 2) {
                this.avlProgramDataItems.splice(index, 1);
                this.calculateProgramData('', 0);
            }
            this.adjustRowNumbers();
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

            for (let i = 0; i < this.N; i++) {
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
            // Calculate vo2Gen - cycle test
            if (this.selected === 1) {
                if (this.avlDataItems[i]['t_name'].value == "") {
                    this.avlDataItems[i]['vo2gen'] = 0;
                } else {
                    this.avlDataItems[i]['vo2gen'].value = (3.5 + 3.5 + 1.8 * (parseFloat(this.avlDataItems[i]['t_name'].value)) * 6 / this.weight).toFixed(1);
                }
            }

            // Calculate vo2Gen - walk test
            if (this.selected === 2) {
                if (this.avlDataItems[i]['speed'].value == "") {
                    // this.avlDataItems[i]['vo2gen'] = null;
                } else {
                    if (this.avlDataItems[i]['heart_rate'].value == "") {
                        // this.avlDataItems[i]['vo2gen'] = null;
                    } else {
                        this.avlDataItems[i]['vo2gen'].value = ((parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.1 + 3.5) + (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8)) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                    }
                }
            }

            // Calculate vo2Gen - run test
            if (this.selected === 3) {
                if (this.avlDataItems[i]['speed'].value == "") {
                    // this.avlDataItems[i]['vo2gen'] = null;
                } else {
                    if (this.avlDataItems[i]['heart_rate'].value == "") {
                        // this.avlDataItems[i]['vo2gen'] = null;
                    } else {
                        this.avlDataItems[i]['vo2gen'].value = ((parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.2 + 3.5) + (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8 * 0.5)) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                    }
                }
            }

            // Calculate vo2Gen - step test
            if (this.selected === 4) {
                if (this.avlDataItems[i]['speed'].value == "") {
                    // this.avlDataItems[i]['vo2gen'] = null;
                } else {
                    this.avlDataItems[i]['vo2gen'].value = ((0.2 * parseFloat(this.avlDataItems[i]['speed'].value) + 2.394 * 0.01 * parseFloat(this.avlDataItems[i]['stepHeight'].value) * parseFloat(this.avlDataItems[i]['speed'].value) + 3.5)) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                }
            }

            // not optimized | speed
            if (this.selected === 1) {
                if (parseFloat(this.avlDataItems[i]['t_name'].value) < 30) {
                    this.avlDataItems[i]['speed'].value = 0;
                } else {
                    this.avlDataItems[i]['speed'].value = (Math.round((Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100).toFixed(1);
                }
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
                    this.calPercentv();
                }
            }

            // not optimized | set vo2 percentage step test
            if (this.selected === 4) {
                if (this.avlDataItems[i]['speed'].value == "") {
                    //
                } else {
                    if (this.avlDataItems[i]['heart_rate'].value == "") {
                        this.avlDataItems[i]['vo2genpercent'].value = "";
                    } else {
                        this.calPercentv();
                    }
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

            // not optimized | speed max
            if (this.calculateSpeedPeakWalk() == 0) {
                this.items[0]['Speedpeak'].value = "";
            } else {
                this.items[0]['Speedpeak'].value = this.calculateSpeedPeakWalk();
            }

            // not optimized | set vo2 range
            if (this.hrp == "") {
                this.items[0]['VO2range'].value = "";
            } else {
                this.items[0]['VO2range'].value = (Math.round((parseFloat(this.items[0]['vo2peakEst'].value) - 3.5) * 100) / 100).toFixed(1);
            }

            // not optimized | set power peak
            if (this.selected === 1) {
                if (this.hrp == "") {
                    this.items[0]['Powerpeak'].value = "";
                } else {
                    this.calculateSlope();
                    this.items[0]['Powerpeak'].value = this.calculatePower().toFixed(0);
                }
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
            if (this.selected === 1) {
                this.items[0]['Speedpeak'].value = (Math.round(this.calculateSpeedPeak(parseFloat(this.items[0]['Powerpeak'].value)) * 100) / 100).toFixed(1);
            }

            // not optimized | set step height
            if (this.selected === 4) {
                if (this.avlDataItems[i]['heart_rate'].value == "") {
                    this.avlDataItems[i]['stepHeight'].value = this.items[0]['stepHeight'].value;
                }
            }

            // Proccess graph
            // this.processGraph();
            // this.fillData();
            // this.fillData2();
            // this.correlation = parseFloat(this.pearson(this.scatterData)).toFixed(3);
            // this.gradientWalk();
            // this.adjustCalculations();

        },
        calPercentv() {
            for (let i = 0; i < this.avlDataItems.length; i++) {
                this.avlDataItems[i]['vo2genpercent'].value = (((parseFloat(this.avlDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)).toFixed(3)) * 100).toFixed(0);
            }
        },
        calculateMETsPeak() {
            this.metsPeak = this.vo2Peak / 3.5;
        },
        calculateSpeedPeak(power) {
            return Math.round((Math.sqrt((power - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100;
        },

        /**
         * Calculate RRE Peak
         */
        calculateRPEPeak() {
            this.rpeArray = [];
            // process vo2 array
            for (let i = 0; i < this.Nvo2; i++) {
                this.rpeArray.push(this.avlDataItems[i]['rpe'].value);
            }

            return this.rpeArray.reduce(function (a, b) {
                return Math.max(a, b);
            });
        },
        calculateSpeedPeakWalk() {

            // process vo2 array
            this.speedArray = [];
            for (var i = 0; i < this.Nvo2; i++) {
                this.speedArray.push(this.avlDataItems[i]['speed'].value);
            }
            var max = this.speedArray.reduce(function (a, b) {
                return Math.max(a, b);
            });
            return max;
        },
        calculateVO2Range() {
            this.vo2Range = this.vo2Peak - 3.5;
        },
        calculatePredictedHRPeak() {
            this.hrPeakPredicted = 208 - (0.7 * this.client.age);
        },
        calculateVO2PeakEst() {
            this.vo2Peak = Math.round((this.vo2Gen / this.weight * 1000) * 100) / 100;
        },
        calculateVO2Peak() {
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

            // this.vo2Gen = ((hrp - this.InterceptB)) /  (this.slopeB) * this.weight / 1000;
            // return Math.round(this.vo2Gen * 100) / 100;
        },
        // Calculate Gradient - walk test
        gradientWalk() {
            if (this.hrPeak == "") {
                this.items[0]['gradient'].value = 0;
            } else {
                this.items[0]['gradient'].value = ((parseFloat(this.items[0]['vo2peakEst'].value) * (parseFloat(this.weight) / (parseFloat(this.weight) + this.extraWeight)) - (parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 0.1 + 3.5)) / ((parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 1.8))).toFixed(2) * 100;
            }
        },

        // calculate trend line
        checkStepHeight() {
            // not optimized | set step height
            if (this.prefStepHeight == "") {
                this.items[0]['stepHeight'].value = this.recomStepHeight;
            } else {
                this.items[0]['stepHeight'].value = this.prefStepHeight;
            }
        },
        calculateTotKj() {
            this.totKJ = 0;
            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (parseFloat(this.avlProgramDataItems[i]['volume'].value) > 0) {
                    this.totKJ += parseFloat(this.avlProgramDataItems[i]['volume'].value);
                }
            }

            this.createOutputArray("totKJ", this.totKJ, "Total kJ for the table above");
        },
        calculateTotIntensity() {
            var floatVal = 0;
            this.totIntensity = 0;
            this.emptyRowsCount = 0;
            for (var i = 0; i < this.avlProgramDataItems.length; i++) {
                floatVal = parseFloat(this.avlProgramDataItems[i]['intensityM'].value);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.emptyRowsCount += 1;
                } else {
                    this.totIntensity += parseFloat(this.avlProgramDataItems[i]['intensityM'].value);
                }
            }
            // a.reduce(function(a, b) { return a + b; }, 0);
            // if(parseFloat(this.avlProgramDataItems[i]['intensityM'].value) > 0) {
            //     this.totIntensity += parseFloat(this.avlProgramDataItems[i]['intensityM'].value);
            // }
        },
        calculateIntensityMax() {
            this.intensityArray = [];
            // process program data array
            for (var i = 0; i < this.avlProgramDataItems.length; i++) {
                this.intensityArray.push(this.avlProgramDataItems[i]['intensityM'].value);
            }
            var max = this.intensityArray.reduce(function (a, b) {
                return Math.max(a, b);
            });
            return parseFloat(max);
        },
        calculateCycleCount() {
            if (this.totKJ == "") {
                this.cycleCount = '';
            } else {
                this.cycleCount = (9000 * 4.185 / this.totKJ).toFixed(0);
            }
            this.createOutputArray("cycleCount", this.cycleCount, "No. of times the table needs to be repeated to lose 1 kg fat");
        },
        calculateMaxIntensity() {
            //  this.maxIntensity = ((Math.round(this.calculateIntensityMax()) * 100 ) / 100).toFixed(1);
            this.maxIntensity = this.calculateIntensityMax().toFixed(1);
            this.createOutputArray("maxIntensity", this.maxIntensity, "Maximum Intensity: METS");
        },
        calculateAvgIntensity() {
            this.avgIntensity = (this.totIntensity / (this.avlProgramDataItems.length - this.emptyRowsCount)).toFixed(1);
            this.createOutputArray("avgIntensity", this.avgIntensity, "Average Intensity:  METS");
        },
        calculateProgramData(col, i) {
            let floatVal = 0, varTotTime = 0, varPrevTime = 0, varCurrTime = 0;

            // calculate total duration
            if (i == 0) {
                if (this.selected == 7) {
                    if (typeof this.avlProgramDataItems[i]['totDuration'] !== 'undefined') {
                        const varCurrTime = this.avlProgramDataItems[i]['totDuration'].value = isNaN((typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0) ? 0 : this.avlProgramDataItems[i]['durationT'].value;
                        this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(varCurrTime, 0);
                    }
                } else if (this.selected == 12) {
                    if (typeof this.avlProgramDataItems[i]['totDuration'] !== 'undefined') {
                        const varCurrTime = isNaN((typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0) ? 0 : this.avlProgramDataItems[i]['durationT'].value;
                        this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(varCurrTime, 0);
                    }
                } else {
                    if (typeof this.avlProgramDataItems[i]['totDuration'] !== 'undefined') {
                        const duration = (typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0;

                        this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(duration, 0);
                    }
                }
            } else {
                if (this.selected == 7) {
                    // varPrevTime = parseFloat((typeof this.avlProgramDataItems[i - 1]['totDuration'] !== 'undefined') ? this.avlProgramDataItems[i - 1]['totDuration'].value : 0);
                    // varCurrTime = parseFloat((typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0);
                    // varTotTime = (isNaN(varPrevTime) ? 0 : varPrevTime) + (isNaN(varCurrTime) ? 0 : varCurrTime);
                    // this.avlProgramDataItems[i]['totDuration'].value = varTotTime;

                    varPrevTime = this.avlProgramDataItems[i - 1]['totDuration'].value;
                    varCurrTime = this.avlProgramDataItems[i]['durationT'].value;
                    this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(varPrevTime, varCurrTime);
                } else if (this.selected == 12) {
                    varPrevTime = (typeof this.avlProgramDataItems[i - 1]['totDuration'] !== 'undefined') ? this.avlProgramDataItems[i - 1]['totDuration'].value : 0;
                    varCurrTime = (typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0;
                    this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(varPrevTime, varCurrTime);

                } else {
                    varPrevTime = this.avlProgramDataItems[i - 1]['totDuration'].value;
                    varCurrTime = this.avlProgramDataItems[i]['duration'].value;
                    this.avlProgramDataItems[i]['totDuration'].value = this.addTimes(varPrevTime, varCurrTime);
                }
            }

            if (this.selected === 1) {
                // Calculate power -
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.avlProgramDataItems[i]['power'].value = '';
                } else {
                    floatVal = ((parseFloat(this.avlProgramDataItems[i]['intensity'].value) - this.Intercept) / this.Slope).toFixed(2);
                    this.avlProgramDataItems[i]['power'].value = isNaN(floatVal) ? '' : floatVal;
                }

                // Calculate speed -
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.checkUndefineds(this.avlProgramDataItems[i]['speed']) ? (this.avlProgramDataItems[i]['speed'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['power'].value);
                    if (isNaN(floatVal) || floatVal < 30) {
                        (typeof this.avlProgramDataItems[i]['speed'] !== 'undefined') ? (this.avlProgramDataItems[i]['speed'].value = '') : '';
                    } else {
                        this.avlProgramDataItems[i]['speed'].value = (Math.sqrt((parseFloat(this.avlProgramDataItems[i]['power'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)).toFixed(1);
                    }
                }

                // Calculate vo2 -> mlkg-1
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    this.avlProgramDataItems[i]['vo2gen'].value = ((parseFloat(this.avlProgramDataItems[i]['intensity'].value) - parseFloat(this.InterceptB)) / this.slopeB).toFixed(1);
                }

                // Calculate intensity -> mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    this.avlProgramDataItems[i]['intensityM'].value = (parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / 3.5).toFixed(1);
                }

                // Calculate volume -> kJ
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['duration'].value);

                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        this.avlProgramDataItems[i]['volume'].value = (Math.round((parseFloat(this.avlProgramDataItems[i]['intensityM'].value) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185).toFixed(1)) * 100) / 100;
                    }
                }

                // Calculate sets to lose -> 1kg fat
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['setsToLose'] !== 'undefined') ? (this.avlProgramDataItems[i]['setsToLose'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['duration'].value);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['setsToLose'] !== 'undefined') ? (this.avlProgramDataItems[i]['setsToLose'].value = '') : '';
                    } else {
                        this.avlProgramDataItems[i]['setsToLose'].value = (9000 * 4.185 / parseFloat(this.avlProgramDataItems[i]['volume'].value)).toFixed(1);
                    }
                }

                // Calculate intensity range -
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'].value !== 'undefined') ? this.avlProgramDataItems[i]['intensityR'].value = '' : '';
                    // this.avlProgramDataItems[i]['intensityR'].value = '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityR'].value = '' : '';
                    } else {
                        this.avlProgramDataItems[i]['intensityR'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) - 3.5) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100;
                    }
                }

                // Calculate vo2 -> lmin-1
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    this.checkUndefineds(this.avlProgramDataItems[i]['vo2M']) ? this.avlProgramDataItems[i]['vo2M'].value = '' : '';
                    // this.avlProgramDataItems[i]['vo2M'].value = '';
                } else {
                    this.avlProgramDataItems[i]['vo2M'].value = (parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) * this.weight / 1000).toFixed(2);
                }

                // Calculate v02 peak percentage -
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.hrPeak);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2M'].value) / parseFloat(this.items[0]['VO2peak'].value)) * 100).toFixed(0);
                    }
                }
            }
            if (this.selected === 2) {
                // this.calculatePowerP(i);
                this.calculateSpeedP(i);
                this.calculateVo2mlkgP(i);
                this.calculteIntensityMetsP(i);
                this.calculateVolumeKjP(i);
                this.calculateSetsLoseP(i);
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2R'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2R'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2R'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2R'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                        this.avlProgramDataItems[i]['vo2R'].value = isNaN(floatVal) ? '' : floatVal * 100;
                    }
                }
                this.calculateVo2LminP(i);
                this.calculateVo2PercentageP(i);
            }
            if (this.selected === 3) {
                //*************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value) * parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0)).toFixed(1);
                    this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : parseFloat(floatVal / 100).toFixed(1);
                }
                //*************
                this.calculatePowerP(i);
                this.calculateSpeedP(i);
                // this.calculateVo2mlkgP(i);
                this.calculteIntensityMetsP(i);
                this.calculateVolumeKjP(i);
                this.calculateSetsLoseP(i);
                //***********************
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                        this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                    }
                }
                //***********************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight / 1000;
                    this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal;
                }

                this.processGraph2();
                this.drawChart ? this.fillData() : '';
            }

            if (this.selected === 4) {
                //*************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = ((parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value) / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0) - 3.5) + 3.5).toFixed(1);
                    this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal;
                }
                //*************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? (this.avlProgramDataItems[i]['power'].value = '') : '';
                } else {
                    floatVal = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) - 7) * this.weight) / (1.8 * 6);
                    this.avlProgramDataItems[i]['power'].value = (isNaN(floatVal) || floatVal < 1) ? '' : floatVal.toFixed();
                }

                this.calculateSpeedP(i);
                this.calculteIntensityMetsP(i);

                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);
                        this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : (Math.round(floatVal) * 100) / 100;
                    }
                }

                this.calculateSetsLoseP(i);

                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                        this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                    }
                }

                this.calculateVo2LminP(i);
                this.calculateVo2PercentageP(i);

                this.processGraph1();
                this.fillData();
            }

            if (this.selected === 5) {
                //*************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = (((parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value) / 100) * (parseFloat(this.items[0]['HRpeak'].value) - (isNaN(parseFloat(this.hrRest)) ? 0 : parseFloat(this.hrRest))) + (isNaN(parseFloat(this.hrRest)) ? 0 : parseFloat(this.hrRest))) - this.InterceptB) / this.slopeB;
                    this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                }
                //*************
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? (this.avlProgramDataItems[i]['power'].value = '') : '';
                } else {
                    floatVal = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) - 7) * this.weight) / (1.8 * 6);
                    this.avlProgramDataItems[i]['power'].value = (isNaN(floatVal) || floatVal < 1) ? '' : floatVal.toFixed();
                }

                this.calculateSpeedP(i);
                this.calculteIntensityMetsP(i);
                this.calculateVolumeKjP(i);
                this.calculateSetsLoseP(i);
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.hrPeak);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0));
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                        }
                    }
                }
                this.calculateVo2LminP(i);
                this.calculateVo2PercentageP(i);

                this.processGraph3();
                this.fillData();
            }

            if (this.selected === 6) {

                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensity'].value) - parseFloat(this.InterceptB)) / parseFloat(this.slopeB);
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                this.calculateGradientP(i);

                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed();
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined')
                                ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);

                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : (Math.round(floatVal) * 100) / 100;
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph();
                this.fillData();
            }

            if (this.selected === 7) {

                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = ((parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / parseFloat(this.weight)) * ((((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000) / 60 * 0.1) + 3.5) + (parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * (1000 / 60) * (parseFloat(this.avlProgramDataItems[i]['gradientP'].value) / 100) * 1.8));
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                        // if (isNaN(floatVal) || floatVal < 1) {
                        if (isNaN(floatVal)) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                    // if (isNaN(floatVal) || floatVal < 1) {
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                    // if (isNaN(floatVal) || floatVal < 1) {
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['durationT'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : (Math.round(floatVal) * 100) / 100;
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                        if (isNaN(floatVal)) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : (floatVal * 100).toFixed(0);
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? this.avlProgramDataItems[i]['gradientP'].value : 0);
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph4();
                this.fillData();
            }

            if (this.selected === 8) {

                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value / 100) * parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0));
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // gradient %
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        var exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.1 * 1000 / 60) + 3.5)) / (1.8 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                        this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : (floatVal * 100).toFixed(0);
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph2();
                this.drawChart ? this.fillData() : '';
            }

            if (this.selected === 9) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0) - 3.5) + 3.5);
                    this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                }

                // gradient %
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        var exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.1 * 1000 / 60) + 3.5)) / (1.8 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                        this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph1();
                this.fillData();
            }

            if (this.selected === 10) {

                // vo2 gen
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                        } else {
                            var hrpeakTest = parseFloat((typeof this.items[0]['HRpeak'] !== 'undefined') ? this.items[0]['HRpeak'].value : 0);
                            floatVal = ((((parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value) / 100) * (hrpeakTest - parseFloat(this.hrRest))) + parseFloat(this.hrRest)) - parseFloat(this.InterceptB)) / parseFloat(this.slopeB);
                            this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                        }
                    }
                }

                // gradient %
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                        } else {
                            var exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                            exWeight = (isNaN(exWeight) ? 0 : exWeight);
                            floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.1 * 1000 / 60) + 3.5)) / (1.8 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                            this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                        }
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.hrPeak);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                            if (isNaN(floatVal) || floatVal < 1) {
                                (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                            } else {
                                this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                            }
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                        } else {
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                            this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                        }
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 lmin
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                        } else {
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                            this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                        }
                    }
                }

                this.processGraph3();
                this.fillData();
            }

            if (this.selected === 11) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensity'].value) - parseFloat(this.InterceptB)) / parseFloat(this.slopeB);
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // gradient %
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensity'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.2 * 1000 / 60) + 3.5)) / (1.8 * 0.5 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                        this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : (Math.round(floatVal * 100) / 100) * 100;
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph();
                this.fillData();
            }

            if (this.selected === 12) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = (((parseFloat(this.weight) + parseFloat(exWeight)) / parseFloat(this.weight)) * (((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000) / 60 * 0.2) + 3.5)) + ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000) / 60 * ((parseFloat(this.avlProgramDataItems[i]['intensityGD'].value) / 100) * 1.8 * 0.5))
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['durationT'] !== 'undefined') ? this.avlProgramDataItems[i]['durationT'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['durationT'].value) / 60 * 4.185);
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityGD'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityGD'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph4();
                this.fillData();
            }

            if (this.selected === 13) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value) / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0));
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // grade
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.2 * 1000 / 60) + 3.5)) / (1.8 * 0.5 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                        this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat(exWeight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph2();
                this.drawChart ? this.fillData() : '';
            }

            if (this.selected === 14) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = ((parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value) / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0) - 3.5)) + 3.5;
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // grade
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.2 * 1000 / 60) + 3.5)) / (0.9 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                        this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat(exWeight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                this.processGraph1();
                this.fillData();
            }

            if (this.selected === 15) {
                // vo2 gen
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                        } else {
                            var hrpeakTest = parseFloat((typeof this.items[0]['HRpeak'] !== 'undefined') ? this.items[0]['HRpeak'].value : 0);
                            floatVal = ((((parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value) / 100) * (hrpeakTest - parseFloat(this.hrRest))) + parseFloat(this.hrRest)) - parseFloat(this.InterceptB)) / parseFloat(this.slopeB);
                            this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                        }
                    }
                }

                // grade
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                        } else {
                            exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                            exWeight = (isNaN(exWeight) ? 0 : exWeight);
                            floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / (parseFloat(this.weight) + parseFloat(exWeight))) - ((parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 0.2 * 1000 / 60) + 3.5)) / (0.9 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                            this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                        }
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat(this.hrPeak);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                            if (isNaN(floatVal) || floatVal < 0) {
                                (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                            } else {
                                this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100).toFixed(0);
                            }
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                        } else {
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                            this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                        }
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // vo2 lmin
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                        } else {
                            exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                            exWeight = (isNaN(exWeight) ? 0 : exWeight);
                            floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) + parseFloat(exWeight)) / 1000;
                            this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                        }
                    }
                }

                this.processGraph3();
                this.fillData();
            }

            if (this.selected === 16) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensity'].value) - parseFloat(this.InterceptB)) / parseFloat(this.slopeB);
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // speed up-down
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / (parseFloat(this.weight) + parseFloat(exWeight))) - 3.5) / (0.2 + (2.394 * 0.01 * parseFloat(this.avlProgramDataItems[i]['intensitySH'].value))));
                        this.avlProgramDataItems[i]['speedUpDown'].value = isNaN(floatVal) ? '' : floatVal.toFixed();
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2M'].value : 0) / parseFloat((typeof this.items[0]['VO2peak'] !== 'undefined') ? this.items[0]['VO2peak'].value : 0)) * 100).toFixed(0);
                            this.avlProgramDataItems[i]['vo2P'].value = isNaN(floatVal) ? '' : floatVal;
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                        }
                    }
                }

                this.processGraph();
                this.fillData();
            }

            if (this.selected === 17) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = ((((0.2 * parseFloat(this.avlProgramDataItems[i]['intensityUpDown'].value)) + (2.394 * 0.01 * parseFloat(this.avlProgramDataItems[i]['intensitySH'].value) * parseFloat(this.avlProgramDataItems[i]['intensityUpDown'].value))) + 3.5) * (parseFloat(this.weight) + parseFloat(exWeight))) / parseFloat(this.weight);
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2M'].value : 0) / parseFloat((typeof this.items[0]['VO2peak'] !== 'undefined') ? this.items[0]['VO2peak'].value : 0)) * 100).toFixed(0);
                            this.avlProgramDataItems[i]['vo2P'].value = isNaN(floatVal) ? '' : floatVal;
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityUpDown'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityUpDown'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = (isNaN(floatVal) ? '' : (floatVal * 100).toFixed(0));
                        }
                    }
                }

                this.processGraph();
                this.fillData();
            }

            if (this.selected === 18) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value / 100) * parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // speed up-down
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = (((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) - parseFloat(exWeight))) / parseFloat(this.weight)) - 3.5) / ((parseFloat(this.avlProgramDataItems[i]['intensitySH'].value) * 0.01 * 2.394) + 0.2);
                        this.avlProgramDataItems[i]['speedUpDown'].value = isNaN(floatVal) ? '' : floatVal.toFixed();
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                // intensity vo2 range
                floatVal = parseFloat(this.client.age);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0);
                            this.avlProgramDataItems[i]['intensityR'].value = (isNaN(floatVal) ? '' : (floatVal * 100).toFixed(0));
                        }
                    }
                }

                this.processGraph2();
                (this.drawChart) ? this.fillData() : '';
            }

            if (this.selected === 19) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0) - 3.5)) + 3.5;
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // speed up-down
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                    } else {
                        exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                        exWeight = (isNaN(exWeight) ? 0 : exWeight);
                        floatVal = (((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) - parseFloat(exWeight))) / parseFloat(this.weight)) - 3.5) / ((parseFloat(this.avlProgramDataItems[i]['intensitySH'].value) * 0.01 * 2.394) + 0.2);
                        this.avlProgramDataItems[i]['speedUpDown'].value = isNaN(floatVal) ? '' : floatVal.toFixed();
                    }
                }

                // vo2 lmin
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / 1000;
                        this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2M'].value : 0) / parseFloat((typeof this.items[0]['VO2peak'] !== 'undefined') ? this.items[0]['VO2peak'].value : 0)) * 100).toFixed(0);
                            this.avlProgramDataItems[i]['vo2P'].value = isNaN(floatVal) ? '' : floatVal;
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVo2R'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVo2R'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                this.processGraph1();
                this.fillData();
            }

            if (this.selected === 20) {
                // vo2 gen
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
                    } else {
                        floatVal = (parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value / 100) * (parseFloat((typeof this.items[0]['vo2peakEst'] !== 'undefined') ? this.items[0]['vo2peakEst'].value : 0) - 3.5)) + 3.5;
                        this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal.toFixed(1);
                    }
                }

                // speed up-down
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                    if (isNaN(floatVal)) {
                        (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['speedUpDown'] !== 'undefined') ? (this.avlProgramDataItems[i]['speedUpDown'].value = '') : '';
                        } else {
                            exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                            exWeight = (isNaN(exWeight) ? 0 : exWeight);
                            floatVal = (((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * (parseFloat(this.weight) - parseFloat(exWeight))) / parseFloat(this.weight)) - 3.5) / ((parseFloat(this.avlProgramDataItems[i]['intensitySH'].value) * 0.01 * 2.394) + 0.2);
                            this.avlProgramDataItems[i]['speedUpDown'].value = isNaN(floatVal) ? '' : floatVal.toFixed();
                        }
                    }
                }

                // vo2 lmin
                floatVal = parseFloat(this.hrRest);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
                        } else {
                            floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight)) / 1000;
                            this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal.toFixed(2);
                        }
                    }
                }

                // vo2p
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                        if (isNaN(floatVal) || floatVal < 1) {
                            (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2M'].value : 0) / parseFloat((typeof this.items[0]['VO2peak'] !== 'undefined') ? this.items[0]['VO2peak'].value : 0)) * 100).toFixed(0);
                            this.avlProgramDataItems[i]['vo2P'].value = isNaN(floatVal) ? '' : floatVal;
                        }
                    }
                }

                // intensity mets
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 1) {
                        (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                        this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
                    }
                }

                // volume
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySH'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySH'].value : 0);
                if (isNaN(floatVal) || floatVal < 0) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityHRR'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityHRR'].value : 0);
                    if (isNaN(floatVal) || floatVal < 0) {
                        (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                    } else {
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        if (isNaN(floatVal) || floatVal < 0) {
                            (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                        } else {
                            floatVal = ((parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * parseFloat(this.weight) * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value)) / 60) * 4.185;
                            this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal.toFixed(0);
                        }
                    }
                }

                this.calculateSetsLoseP(i);

                this.processGraph3();
                this.fillData();
            }

            if (this.selected === 1 || this.selected === 2) {
                //console.log('Selected 2');
                this.processGraph();
                this.fillData();
            }

            // data summery
            this.calculateTotKj();
            this.calculateTotIntensity();
            this.calculateCycleCount();
            this.calculateMaxIntensity();
            this.calculateAvgIntensity();
            this.createOutputArray("totTime", this.totTime, "Total time: minutes");
        },
        checkUndefineds(val) {
            return (typeof val !== 'undefined') ? true : false;
        },
        assignValues() {
            this.inputFields.forEach(element => {
                if (element['name'] == 'colWeight') {
                    this.weight = element['value']
                } else if (element['name'] == 'extraWeight') {
                    this.extraWeight = element['value']
                } else if (element['name'] == 'colHR') {
                    this.hrp = element['value']
                } else if (element['name'] == 'colBP') {
                    this.bpp = element['value']
                } else if (element['name'] == 'hrRest') {
                    this.hrRest = element['value']
                } else if (element['name'] == 'bpRest') {
                    this.bpRest = element['value']
                } else if (element['name'] == 'colHeight') {
                    this.height = element['value']
                } else if (element['name'] == 'colRSH') {
                    this.recomStepHeight = element['value']
                } else if (element['name'] == 'colPSH') {
                    this.prefStepHeight = element['value']
                }
            });
        },
        /**
         * API call
         */
        saveProgram() {
            let self = this;
            if (!this.validateData()) {

            } else {
                window.axios.post(this.$config.BASE_URL + '/programs', {
                    // name: this.program_name,
                    name: 'program_name',
                    description: '',
                    test_type: this.selectedTest,
                    program_type: this.selected,
                    table_id: this.table2_id,
                    test_id: this.testid,
                    table1: this.avlProgramDataItems,
                    output_fields: this.outputFields,

                }).then(function (response) {
                    // console.log(response.data.data.id);
                    self.programid = response.data.data.id
                    self.testid = response.data.data.test_id;
                    self.showModal = true;
                    window.location = this.$config.BASE_URL + '/view-test?client_id=' + self.client.id + '&test_id=' + self.testid;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        validateData() {
            if (this.avlDataItems.length < 1) {
                alert('feed some data to table');
                return false;
            }
            if (this.testid < 1) {
                return false;
            }
            return true;
        },
        createOutputArray(name, value, label) {
            if (this.outputFields.length > 0) {
                let i = 0, found = false;

                this.outputFields.forEach(element => {
                    if (element['name'] == name) {
                        this.outputFields[i].value = value;
                        found = true;
                    }
                    i++;
                });

                if (!found) {
                    this.outputFields.push({label: label, name: name, fieldId: name, value: value});
                }
            } else {
                this.outputFields.push({label: label, name: name, fieldId: name, value: value});
            }
        },
        // put all calculations here
        calculatePowerP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? (this.avlProgramDataItems[i]['power'].value = '') : '';
            } else {
                floatVal = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) - 7) * this.weight) / (1.8 * 6);
                this.avlProgramDataItems[i]['power'].value = (isNaN(floatVal) || floatVal < 1) ? '' : floatVal.toFixed();
            }
        },
        calculateSpeedP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
            // var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensityVO2P'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityVO2P'].value : 0);
            if (isNaN(floatVal) || floatVal < 30) {
                (typeof this.avlProgramDataItems[i]['speed'] !== 'undefined') ? (this.avlProgramDataItems[i]['speed'].value = '') : '';
            } else {
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
                if (isNaN(floatVal) || floatVal < 30) {
                    (typeof this.avlProgramDataItems[i]['speed'] !== 'undefined') ? (this.avlProgramDataItems[i]['speed'].value = '') : '';
                } else {
                    floatVal = (Math.sqrt((parseFloat(this.avlProgramDataItems[i]['power'].value) - 67.7236) / 0.3751 + Math.pow((0.5 * 8.2538 / (0.3751)), 2)) + 8.2538 / (0.3751 * 2)).toFixed(1);
                    this.avlProgramDataItems[i]['speed'].value = isNaN(floatVal) ? '' : floatVal;
                }
            }
        },
        calculateVo2PercentageP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
            // var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
            } else {
                floatVal = parseFloat(this.hrPeak);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['vo2P'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2P'].value = '') : '';
                } else {
                    this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2M'].value) / parseFloat(this.items[0]['VO2peak'].value)) * 100).toFixed(0);
                }
            }
        },
        calculateVo2mlkgP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
            // var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2gen'].value = '') : '';
            } else {
                floatVal = (3.5 + 3.5 + 1.8 * (parseFloat(this.avlProgramDataItems[i]['power'].value)) * 6 / (isNaN(this.weight) ? 0 : this.weight)).toFixed(1);
                this.avlProgramDataItems[i]['vo2gen'].value = isNaN(floatVal) ? '' : floatVal;
                // this.avlProgramDataItems[i]['vo2gen'].value = ((parseFloat(this.avlProgramDataItems[i]['intensity'].value) - this.InterceptB) / this.slopeB).toFixed(1);
            }
        },
        calculteIntensityMetsP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityM'].value = '') : '';
            } else {
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0);
                this.avlProgramDataItems[i]['intensityM'].value = (floatVal / 3.5).toFixed(1);
            }
        },
        calculateVolumeKjP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
            } else {
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? (this.avlProgramDataItems[i]['volume'].value = '') : '';
                } else {
                    floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['intensityM'] !== 'undefined') ? this.avlProgramDataItems[i]['intensityM'].value : 0) * this.weight * this.timeToDecimal(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185).toFixed(0);
                    this.avlProgramDataItems[i]['volume'].value = isNaN(floatVal) ? '' : floatVal;
                }
            }
        },
        calculateSetsLoseP(i) {
            var floatVal = parseFloat((typeof this.avlProgramDataItems[i]['volume'] !== 'undefined') ? this.avlProgramDataItems[i]['volume'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['setsToLose'] !== 'undefined') ? (this.avlProgramDataItems[i]['setsToLose'].value = '') : '';
            } else {
                floatVal = 9000 * 4.185 / parseFloat(this.avlProgramDataItems[i]['volume'].value);
                this.avlProgramDataItems[i]['setsToLose'].value = (isNaN(floatVal) ? '' : floatVal).toFixed(0);
            }
        },
        calculateIntensityVO2RangeP(i) {
            let floatVal = parseFloat(this.hrPeak);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
            } else {
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['intensityR'] !== 'undefined') ? (this.avlProgramDataItems[i]['intensityR'].value = '') : '';
                } else {
                    floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.items[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                    // floatVal = (parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) - 3.5) / parseFloat((typeof this.avlDataItems[0]['VO2range'] !== 'undefined') ? this.items[0]['VO2range'].value : 0);
                    this.avlProgramDataItems[i]['intensityR'].value = isNaN(floatVal) ? '' : floatVal * 100;
                }
            }
        },
        calculateVo2LminP(i) {
            let floatVal = parseFloat((typeof this.avlProgramDataItems[i]['power'] !== 'undefined') ? this.avlProgramDataItems[i]['power'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['vo2M'] !== 'undefined') ? (this.avlProgramDataItems[i]['vo2M'].value = '') : '';
            } else {
                floatVal = parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * parseFloat(this.weight) / 1000;
                this.avlProgramDataItems[i]['vo2M'].value = isNaN(floatVal) ? '' : floatVal;
            }
        },
        calculateGradientP(i) {
            let floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensitySP'] !== 'undefined') ? this.avlProgramDataItems[i]['intensitySP'].value : 0);
            if (isNaN(floatVal) || floatVal < 1) {
                (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
            } else {
                let floatVal = parseFloat((typeof this.avlProgramDataItems[i]['intensity'] !== 'undefined') ? this.avlProgramDataItems[i]['intensity'].value : 0);
                if (isNaN(floatVal) || floatVal < 1) {
                    (typeof this.avlProgramDataItems[i]['gradientP'] !== 'undefined') ? (this.avlProgramDataItems[i]['gradientP'].value = '') : '';
                } else {
                    let exWeight = parseFloat((typeof this.avlProgramDataItems[i]['intensityEW'] !== 'undefined') ? (isNaN(parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityEW'].value)) : 0);
                    exWeight = (isNaN(exWeight) ? 0 : exWeight);
                    floatVal = ((((parseFloat((typeof this.avlProgramDataItems[i]['vo2gen'] !== 'undefined') ? this.avlProgramDataItems[i]['vo2gen'].value : 0) * this.weight) / (parseFloat(this.weight) + parseFloat(exWeight)) - 3.5) - (0.1 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)) / (1.8 * parseFloat(this.avlProgramDataItems[i]['intensitySP'].value) * 1000 / 60)).toFixed(2);
                    this.avlProgramDataItems[i]['gradientP'].value = isNaN(floatVal) ? '' : parseFloat(floatVal * 100).toFixed();
                }
            }
        },

        /**
         * Time to Decimal
         *
         * @param {object} event
         * @param {object} data
         * @returns {boolean | string}
         */
        timeFormat(event, data) {
            const value = event.target.value;
            const minutesSeconds = value.split(/[.:]/);
            let seconds = minutesSeconds[1] ? minutesSeconds[1] : 0;

            if (seconds === 0)
                return true;

            const formatted = this.toMinutes(value);
            //Set model value
            data.value = formatted;
            return event.target.value = formatted;
        },
        /**
         * Decimal to Minutes
         *
         * @param value
         * @returns {string}
         */
        toMinutes(value) {
            //Format the h:i
            const minutesSeconds = value.split(/[.:]/);
            let minutes = parseInt(minutesSeconds[0], 10);
            let seconds = minutesSeconds[1] ? minutesSeconds[1] : 0;

            if (seconds >= 60) {
                const m = (seconds / 60) << 0;
                minutes += m;
                seconds -= 60 * m;
            }

            return seconds ? minutes + '.' + seconds : minutes;
        },
        /**
         * Add two string time values (mm:ss) with javascript
         *
         * Usage:
         *  > addTimes('10:59', '17:10');
         *  > "28:09"
         *
         * @param {number} startTime  String time format
         * @param {number} endTime  String time format
         * @returns {String}
         */
        addTimes(startTime, endTime) {
            let times = [0, 0], max = times.length;
            startTime = (startTime ? startTime : "").toString();
            endTime = (endTime ? endTime : "").toString();

            let timeA = (startTime || '').split(/[.:]/);
            let timeB = (endTime || '').split(/[.:]/);

            // normalize time values
            for (let i = 0; i < max; i++) {
                timeA[i] = isNaN(parseInt(timeA[i])) ? 0 : ((timeA[i].length === 1 && i === max - 1) ? timeA[i] * 10 : timeA[i]);
                timeB[i] = isNaN(parseInt(timeB[i])) ? 0 : ((timeB[i].length === 1 && i === max - 1) ? timeB[i] * 10 : timeB[i]);
            }

            // store time values
            for (let i = 0; i < max; i++) {
                times[i] = parseInt(timeA[i]) + parseInt(timeB[i]);
            }

            let [minutes, seconds] = times;

            if (seconds >= 60) {
                const m = (seconds / 60) << 0;
                minutes += m;
                seconds -= 60 * m;
            }

            return ('0' + minutes).slice(-2) + '.' + ('0' + seconds).slice(-2);
        },

        /**
         * Time to Decimal
         * @param t
         * @returns {number}
         */
        timeToDecimal(t) {
            const time = t.toString().split('.');

            if (time.length === 1)
                return parseInt(time[0]);

            let seconds = time[1].length === 1 ? time[1] * 10 : time[1];
            const dec = parseInt((seconds / 6) * 10, 10);

            return parseFloat(parseInt(time[0], 10) + '.' + (dec < 10 ? '0' : '') + dec);
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

#section-b-1-1 {
    background-color: #fafafb;
    width: 100%;
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

.test-name {
    /* height: 18px; */
    width: 100%;
    color: #000;
    font-family: Montserrat !important;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 0.22px;
    line-height: 22px;
}

.test-type {
    /* height: 18px;	 */
    color: #000;
    font-family: Montserrat !important;
    font-size: 14px;
    letter-spacing: 0.17px;
    line-height: 18px;
}

.test-legend-name {
    height: 74px;
    width: 278px;
    background-color: #FAFAFB;
    margin: auto;
    padding-top: 10px;
}

.small {
    /* max-width: 1000px; */
    margin: 100px auto;
}

.linechart {
    height: 502px;
    width: 791px;
    border-radius: 6px;
    background-color: #EEF1F9;
    margin: auto;
    margin-top: 30px;
    padding-top: 30px;
}

.test-legend {
    height: 74px;
    width: 244px;
    border-radius: 6px;
    background-color: #EEF1F9;
    padding: 8px;
    margin: auto;
}

.legend-value {
    height: 37px;
    color: #0474C8;
    font-family: Montserrat !important;
    font-size: 28px;
    font-weight: 600;
    letter-spacing: 0.36px;
    line-height: 37px;
    margin: auto;
}

.legend-heading {
    height: 29px;
    color: #0474C8;
    font-size: 20px;
    font-weight: 600;
    letter-spacing: 0.29px;
    line-height: 29px;
    margin-bottom: auto;
    font-family: Montserrat !important;
}

.legend-subheading {
    height: 18px;
    color: #000;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.17px;
    line-height: 18px;
    margin: auto;
}

.legend-collection {
    /* margin-right: 0px;
    margin-left: 0px; */
    padding: 8px;
    display: flex;
    justify-content: space-between;
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
    /* width: 98px;	 */
    color: #000;
    /* font-family: Montserrat;	 */
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 0.19px;
    line-height: 19px;
}

.test-input {
    height: 44px;
    font-size: 19px;
    /* width: 92px;	 */
    border: 1px solid #989AA1;
    border-radius: 6px;
    background-color: #EEF1F9;
}

.table-heading-text {
    height: 19px;
    width: 170px;
    color: #000;
    /* font-family: Montserrat;	 */
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
    /* background-color: rgb(249, 246, 233); */
}

.td-height {
    height: 34px;
    background-color: rgba(255, 255, 249, 0.7);
}

.btn-remove-row {
    background: #f0f8ff00;
    border: none;
    height: 31px;
    cursor: pointer;
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
    margin-bottom: 60px;
}

.program-dropdown {
    height: 44px;
    border: 1px solid #989AA1;
    border-radius: 6px;
    background-color: #EEF1F9;
}

.summery-box {
    height: 228px;
    width: 426.59px;
    border-radius: 2px;
    background-color: #EEF1F9;
    display: flex;
    margin-left: 44px !important;
    margin-top: 30px !important;
}

.summery-text {
    color: #131313;
    font-size: 13px;
    font-weight: bold;
    letter-spacing: 0.16px;
    line-height: 16px;
    margin-top: auto !important;
    margin-right: auto !important;
    margin-left: 10px;
}

.summery-value-text {
    height: 19px;
    color: #000000;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 0.19px;
    line-height: 19px;
    text-align: right;
    width: inherit;
    margin: auto;
}

.summery-header-box {
    height: 45px;
    width: 307px;
    border-radius: 2px;
    background-color: #EEF1F9;
    display: flex;
}

.summery-value-box-1 {
    height: 45px;
    width: 119px;
    background-color: #8EF565;
    display: flex;
    padding-right: 20px;
}

.summery-value-box-2 {
    height: 45px;
    width: 119px;
    background-color: #89FBFB;
    display: flex;
    padding-right: 20px;
}

.table-output {
    width: inherit;
}

hr {
    margin-top: 0rem;
    margin-bottom: 0rem;
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

.type-of-test-labels {
    height: 19px;
    width: 156px !important;
    color: #000;
    font-family: Montserrat !important;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 0.19px;
    line-height: 19px;
}
</style>
