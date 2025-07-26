<template>

    <div class style="font-family: Montserrat !important;" id="main_section">
        <section class="row grid">
            <div class="col-md-12 pull-right" id="download-btns">
                <a class="btn btn-success pull-right"
                   v-bind:class="[full_print_status ? 'disabled':'']"
                   id="download_btn_full" @click="printPdfFull"
                   style="width: 250px;margin: 10px;" href="#">
                    <i v-bind:class="[full_print_status ? 'fa-spinner fa-spin' : 'fa-cloud-download']"
                       class="fa fa-fw text-white"></i>
                    Long Program Report
                </a>
                <a class="btn btn-success pull-right"
                   v-bind:class="[short_print_status ? 'disabled':'']"
                   id="download_btn_short" @click="printPdfShort"
                   style="width: 250px;margin: 10px;" href="#">
                    <i v-bind:class="[short_print_status ? 'fa-spinner fa-spin' : 'fa-cloud-download']"
                       class="fa fa-fw text-white"></i>
                    Short Program Report
                </a>
            </div>
        </section>
        <!-- Section B | Test Inputs, Output Tables, Output Charts -->
        <section id="section-b" class="row grid">
            <!-- Section B-2 | Chart -->
            <section id="section-b-2">
                <div class="row legend-collection" id="program-legend-card">
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
                            <p class="legend-subheading">%predicted = <span style="color: #0474C8; font-weight: bold;">{{this.CustomDecimal(predictedHrRPeakPercentage, 1)}}%</span>
                            </p>
                        </div>
                        <div class="legend-2">
                            <p class="legend-value">{{ items[0] ? (items[0]['HRpeak'] ?
                                this.CustomDecimal(items[0]['HRpeak'].value, 0) : '') : ''}}</p>
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

            <section class="form-inline" id="section-bb-1" style="background-color: #fafafb;width: 100%;" v-if="false">
                <div class="form-inline" style="padding: 25px;" v-for="inputField in inputFields">
                    <span
                        style="height: 19px;width: 125px;color: #000;font-family: Montserrat;font-size: 16px;font-weight: 500;letter-spacing: 0.19px;line-height: 19px;">{{inputField.labal}} </span>
                    <span
                        style="height: 22px;width: 66px;color: #1B2031;font-family: Montserrat;font-size: 18px;font-weight: bold;letter-spacing: 0.22px;line-height: 22px;">{{inputField.value}} </span>
                </div>
            </section>

            <!-- Section C | Select Program -->
            <section id="section-b-1" class="row grid" style="margin-left: 0; padding-top: 15px; padding-right: 10px;">

                <div class="new-program" style="margin-left: 40px !important;">
                    <form class="" style="width: 32%; align-items: end;">
                        <label for="test-type"
                               class="col-sm-3 col-form-label col-form-label-lg pull-left type-of-test-labels"
                               style="padding-left: 0px; margin:auto;">Type of Test</label>
                        <div style="margin: auto;" class="col-md-6 pull-left" id="test-type">
                            <select id="inputState" class="form-control-lg bg-light program-dropdown" disabled>
                                <option selected>{{testtypename}}</option>
                            </select>
                        </div>
                    </form>
                    <form class="" style="width: 40%; align-items: end;">
                        <label for="program-drop-down"
                               class="col-sm-2 col-form-label col-form-label-lg pull-left type-of-test-labels"
                               style="padding-left: 0px; margin:auto;">Program</label>
                        <div class="col-md-8 pull-left" style="margin: auto;" id="program-drop-down">
                            <select v-model="selected" id="inputState" class="form-control-lg bg-light program-dropdown"
                                    @change="getTableData(1)" disabled>
                                <option selected>Select program...</option>
                                <option v-for="programtype in programtypes" :key="programtype.id"
                                        v-bind:value="programtype.id">{{ programtype.name }}
                                </option>
                            </select>
                        </div>
                    </form>
                    <form class="pull-right" style="width: 22%; align-items: end;">
                        <!-- <label for="program-drop-down" class="col-sm-6 pull-left col-form-label col-form-label-lg type-of-test-labels" style="padding-left: 0px; margin:auto;">Number of Rows</label>
                        <div class="col-md-6 pull-left" style="margin: auto;" id="program-drop-down">
                            <input type="text" class="form-control-lg bg-light" value="" name="" size="4">
                        </div> -->
                    </form>
                </div>

            </section>

            <!-- Begin Program Data table -->
            <Section id="section-b-3">
                <table class="table-responsive" id="program_table"
                       style="width: 100%; border-collapse: separate; border-spacing: 2px;">
                    <thead style="background-color:#eef1f9;">
                    <tr>
                        <th v-for="tableColb in tableProgram" :key="tableColb.id" style="padding: 10px;"
                            v-if="!hiddenFields.includes(tableColb.name)"
                            :style="{ background: tableColb.pivot.color_code, display: tableColb.pivot.display}">
                            <p class="table-heading-text">{{tableColb.heading}}</p>
                            <p class="table-subheading-text">{{tableColb.sub_heading}}</p>
                        </th>
                        <th><i class="fas fa-marker"></i></th>
                    </tr>
                    </thead>
                    <tbody style="background-color:#eef1f9;">
                    <tr v-for="(rowb, idx1b) in avlProgramDataItems" :key="idx1b" @remove="removeRow">
                        <td class="table-success" v-for="(colb, idx2b) in rowb" :key="idx2b"
                            @change="calculateProgramData(colb,idx1b)" v-if="colb.is_hidden"
                            :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}">
                            <input v-model="colb.value" type="text" class="input-table-text"
                                   :style="{ background: colb.customStyles.color_code, display: colb.customStyles.display}"
                                   disabled/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </Section>
            <!-- End Program Data table -->

            <section id="section-b-1-1">
                <div class="row" style="margin-bottom:20px;">
                    <div class="summery-box my-0">
                        <table class="table-output">
                            <tbody>
                            <tr v-for="outputField in outputFields" v-bind:key="outputField.fieldId"
                                style="display: flex;">
                                <td class="summery-header-box">
                                    <p class="summery-text">{{outputField.label}} </p>
                                </td>
                                <td class="summery-value-box-1">
                                    <p class="summery-value-text">{{
                                        CustomDecimal(
                                        outputField.value, outputField.fieldId === 'totTime' ? 2
                                        : (outputField.fieldId === 'totKJ' || outputField.fieldId === 'cycleCount' ? 0:
                                        1)
                                        )
                                        }}
                                    </p>
                                </td>
                            </tr>
                            <hr>
                            </tbody>
                        </table>
                    </div>
                    <div class="linechart px-4">
                        <step-chart :chart-data="datacollection" :yLabel="programChartYLabel"
                                    :test="datasetsfull" v-on:chart:render="disablePrintBtn(1, false)"></step-chart>
                    </div>
                </div>
            </section>
        </section>
    </div>

</template>

<script>
import StepChart from '../components/StepChart.js';
import ClientCard from '../components/ClientCard';
import moment from "moment";

export default {
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
        programid: 0,
        testid: 0,
        programtype: 0,
        testtypes: {
            type: Array
        },
        testtypeid: 0,
        testtypename: null,
        testname: null,
    },
    mounted() {
        this.testIdPara = this.testid;
        this.getTestData();
        // this.print_btn_status = true;
    },
    components: {
        StepChart,
        ClientCard
    },
    data() {
        return {
            name: 'test',
            datacollection: null,
            datacollection2: null,
            programChartYLabel: '% of VO2 peak',
            tableData: [],
            tableAvailData: [],
            avlProgramDataItemsDummy: [],
            tableProgram: [],
            tableProgramReport: [],
            inputData: [],
            testData: [],
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
            avlProgramDataItemsReport: [],
            avlData: [],
            tempArray: [],
            obj: Object,
            obj2: Object,
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
            outputFields: [],
            showModal: false,
            predictedHrRPeakPercentage: 0,
            hiddenFields: ['intensityEW', 'volume'],
            full_print_status: true,
            short_print_status: true,
        }
    },
    created() {

    },
    watch: {
        // call again the method if the route changes
    },
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
            if (value !== null && value !== '') {
                if (!isNaN(value)) {
                    if (value === Math.floor(value) && cnt === 0) {
                        return parseFloat(value).toFixed(0);
                    } else {
                        return parseFloat(value).toFixed(cnt);
                    }

                } else return '';
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
            this.selected = this.programtype;
            this.testIdPara = this.testid;
            let testIdPara = this.testid;
            this.selectedTest = this.testtypeid;

            window.axios.get(this.$config.BASE_URL + '/tests/' + testIdPara)
                .then((res) => {

                    this.items = res.data.table1,
                        this.avlDataItems = res.data.table2,
                        this.vo2PeakEST = parseFloat(this.items[0]['vo2peakEst'].value),
                        this.inputFields = res.data.inputFields,
                        this.Slope = parseFloat(res.data.slope);
                    this.slopeB = parseFloat(res.data.slope);
                    this.Intercept = parseFloat(res.data.intercept);
                    this.InterceptB = parseFloat(res.data.intercept);
                    this.assignValues();
                    // this.calculateSlope();
                    // this.calculateIntercept();
                    // this.calculateVO2Peak();

                    let hrPeakFromTest = 0;
                    this.inputFields.forEach(element => {
                        if (element.fieldId == 'colHR') {
                            hrPeakFromTest = element.value;
                        }
                    });

                    this.predictedHrRPeakPercentage = (isNaN(parseFloat(hrPeakFromTest)) ? 0 : hrPeakFromTest) / (isNaN(parseFloat(this.items[0]['predHrp'] ? this.items[0]['predHrp'].value : 0)) ? 0 : this.items[0]['predHrp'].value);
                    this.predictedHrRPeakPercentage = isNaN(parseFloat(this.predictedHrRPeakPercentage)) ? 0 : (this.predictedHrRPeakPercentage * 100).toFixed(1);
                });

            window.axios.get(this.$config.BASE_URL + '/programs/' + this.programid)
                .then((res) => {
                    this.outputFields = res.data.outputFields;
                    // this.avlProgramDataItems = res.data.table1;
                    this.avlProgramDataItemsDummy = res.data.table1;
                    this.avlProgramDataItemsReport = res.data.table1;
                    this.getTableData('t');
                });
        },

        /**
         * Selected Program table data structure fetch from Backend
         *
         * @param {integer} type
         */
        getTableData(type) {
            this.loading = true;
            this.tableProgram = [];
            this.tableProgramReport = [];
            this.avlProgramDataItems = [];
            this.avlProgramDataItemsReport = [];
            let param1 = this.selected;

            // New implementation for table manipulation
            window.axios.get(this.$config.BASE_URL + '/api/program-types/' + param1)
                .then((res) => {
                    const program_name = res.data.data.name;
                    this.tables = res.data.data.tables;

                    for (let i = 0; i < this.tables.length; i++) {

                        this.tableProgram = this.tables[i].columns;
                        this.tableProgram.map((data, key) => {
                            if(data.sub_heading === "min"){
                                data.sub_heading = "min.sec";
                                return data.sub_heading;
                            }

                        });

                        this.obj2 = this.tables[0].columns.reduce((o, key) => ({
                            ...o,
                            [key.name]: {
                                value: null,
                                customStyles: key.pivot,
                                column_id: key.id,
                                is_hidden: !this.hiddenFields.includes(key.name)
                            }
                        }), {});
                    }

                    this.setData();

                    this.programChartYLabel = program_name.includes("%VO2R")
                        ? "% of VO2 R"
                        : (program_name.includes("%HRR")
                            ? "% of HRR" : "% of VO2 peak");
                });

        },
        setData() {
            for (let i = 0; i < this.avlProgramDataItemsDummy.length; i++) {
                let ix = 0;
                this.addRowP(2, 1);

                for (let property in this.avlProgramDataItemsDummy[i]) {
                    const decimal_place = (property === 'duration' || property === 'totDuration' || property === 'durationT')
                        ? 2
                        : (property === 'intensityM' || property === 'vo2gen' || property === 'intensitySP' || property === 'speed' ? 1 : 0);

                    this.avlProgramDataItems[i][property].value = this.CustomDecimal(this.avlProgramDataItemsDummy[i][property].value, decimal_place);
                    ix++;
                }
            }

            switch (this.selected) {
                case 1:
                case 2:
                case 6:
                case 11:
                case 16:
                case 17:
                    this.processGraph();
                    break;
                case 4:
                case 9:
                case 14:
                case 19:
                    this.processGraph1();
                    break;
                case 3:
                case 8:
                case 13:
                case 18:
                    this.processGraph2();
                    break;
                case 5:
                case 10:
                case 15:
                case 20:
                    this.processGraph3();
                    break;
                case 7:
                case 12:
                    this.processGraph4();
                    break;
            }
        },

        /**
         * Persist the data to view table
         *
         * @param {integer} type
         * @param {integer} count
         */
        addRowP(type, count) {
            if (type === 2) {
                for (let i = 0; i < count; i++) {
                    this.avlProgramDataItems.push(JSON.parse(JSON.stringify(this.obj2)));
                    this.avlProgramDataItemsReport.push(JSON.parse(JSON.stringify(this.obj2)));
                }
            }
        },

        /**
         * Generate Chart data for program type [1, 2, 6, 11, 16, 17]
         */
        processGraph() {
            let prevTime = 0, floatVal = 0;

            this.graphY = [];
            this.graphX = [];
            this.stepData = [];
            this.labels = [];
            this.totTime = 0;

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0)
                    this.graphX.push(isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value));
                else
                    this.graphX.push.apply(this.graphX, [
                        isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                            ? 0
                            : parseFloat(this.avlProgramDataItems[i]['duration'].value)
                    ]);
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
                    this.graphY.push(parseFloat(this.avlProgramDataItems[i]['vo2P'].value));
                } else {
                    this.graphY.push.apply(this.graphY, [parseFloat(this.avlProgramDataItems[i]['vo2P'].value)])
                }
            }

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                this.totTime = this.timeToDecimal(this.addTimes(this.avlProgramDataItems[i]['duration'].value, this.totTime));
            }

            //X-axis label based on Duration
            const length = parseInt(this.timeToDecimal(this.totTime)) + 8;

            for (let i = 0; i < length; i++) {
                if (typeof this.avlProgramDataItems[i] !== 'undefined') {
                    const label = !isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                        ? parseFloat(this.avlProgramDataItems[i]['duration'].value) : 0;

                    this.labels.push(this.timeToDecimal(label));
                    this.labels.push(parseFloat(this.timeToDecimal(this.avlProgramDataItems[i]['totDuration'].value)));
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
                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);

                    if (isNaN(floatVal) || floatVal < 1)
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    else
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });

                    floatVal = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value);
                    prevTime = prevTime + (
                        isNaN(floatVal)
                            ? 0
                            : isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                            ? 0
                            : parseFloat(this.avlProgramDataItems[i]['duration'].value)
                    );

                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);

                    if (isNaN(floatVal) || floatVal < 1)
                        this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                    else
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                            x: this.timeToDecimal(prevTime)
                        });

                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['vo2P'].value);

                    this.stepData.push({
                        y: isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
                        x: this.timeToDecimal(prevTime)
                    });

                    floatVal = isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value)) ? 0 : parseFloat(this.avlProgramDataItems[i]['duration'].value);
                    const current_duration = isNaN(floatVal)
                        ? 0
                        : isNaN(parseFloat(this.avlProgramDataItems[i]['duration'].value))
                            ? 0
                            : this.avlProgramDataItems[i]['duration'].value;

                    prevTime = parseFloat(this.addTimes(prevTime, current_duration));

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

                if (i === this.avlProgramDataItems.length - 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }

            this.rowCount = this.avlProgramDataItems.length;
            this.fillData();
        },

        /**
         * Generate Chart data for program type [4, 9, 14, 19]
         */
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
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value);

                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: 0});
                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        prevTime = isNaN(floatVal) ? 0 : floatVal;

                        if (!isNaN(floatVal) || floatVal > 0) {
                            this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                        }
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
                            x: 0
                        });

                        floatVal = parseFloat((typeof this.avlProgramDataItems[i]['duration'] !== 'undefined') ? this.avlProgramDataItems[i]['duration'].value : 0);
                        prevTime = isNaN(floatVal) ? 0 : floatVal;
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
                            x: this.timeToDecimal(prevTime)
                        });
                    }
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value);

                    this.stepData.push({
                        y: isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityVo2R'].value),
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
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }

            this.rowCount = this.avlProgramDataItems.length;
            this.fillData();
        },

        /**
         * Generate Chart data for program type [3, 8, 13, 18]
         */
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

            //Remove Duplicate Labels
            this.labels = [...new Set(this.labels)];

            //Sort the label data
            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {

                if (i === 0) {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);

                    if (isNaN(floatVal) || floatVal < 1) {
                        this.stepData.push({y: 0, x: prevTime});
                    } else {
                        this.stepData.push({
                            y: parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value),
                            x: prevTime
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
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value);

                    this.stepData.push({
                        y: isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityVO2P'].value),
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

                if (i === this.avlProgramDataItems.length - 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }

            this.rowCount = this.avlProgramDataItems.length;
            this.fillData();
        },

        /**
         * Generate Chart data for program type [5, 10, 15, 20]
         */
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

            //Remove Duplicate Labels
            this.labels = [...new Set(this.labels)];

            //Sort the label data
            this.labels.sort(function (a, b) {
                return a - b
            });

            for (let i = 0; i < this.avlProgramDataItems.length; i++) {
                if (i === 0) {
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
                } else {
                    floatVal = parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value);

                    this.stepData.push({
                        y: isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['intensityHRR'].value),
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

                if (i === this.avlProgramDataItems.length - 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }

            this.rowCount = this.avlProgramDataItems.length;
            this.fillData();
        },

        /**
         * Generate Chart data for program type [7, 12]
         */
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

            //Remove Duplicate Labels
            this.labels = [...new Set(this.labels)];

            //Sort the label data
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
                        y: isNaN(floatVal) ? 0 : parseFloat(this.avlProgramDataItems[i]['vo2P'].value),
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

                if (i === this.avlProgramDataItems.length - 1) {
                    this.stepData.push({y: 0, x: this.timeToDecimal(prevTime)});
                }
            }

            this.rowCount = this.avlProgramDataItems.length;
            this.fillData();
        },

        /**
         * Add rows to Datatable
         *
         * @param count
         */
        addRow(count) {

            for (var i = 0; i < count; i++) {
                this.avlProgramDataItems.push(JSON.parse(JSON.stringify(this.obj)));
            }
            this.adjustRowNumbers();
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

            this.Slope = (this.N * this.SXY - this.SX * this.SY) / (this.N * this.SXX - this.SX * this.SX);
            this.calculateIntercept();
        },
        calculateIntercept() {
            this.Intercept = (this.SY - this.Slope * this.SX) / this.N;
        },
        calculateSpeed(i) {
            if (parseFloat(this.avlDataItems[i]['t_name'].value) < 30) {
                this.avlDataItems[i]['speed'].value = 0;
            } else {
                this.avlDataItems[i]['speed'].value = Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow(0.5 * 8.2538 / (0.3751), 2)) + 8.2538 / (0.3751 * 2);
            }
            this.speed = Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow(0.5 * 8.2538 / (0.3751), 2)) + 8.2538 / (0.3751 * 2);
        },
        calculateVO2Gen(col, i) {
            // Calculate vo2Gen - cycle test
            if (this.selected === 1) {
                if (this.avlDataItems[i]['t_name'].value == "") {
                    this.avlDataItems[i]['vo2gen'] = 0;
                } else {
                    this.avlDataItems[i]['vo2gen'].value = (3.5 + 3.5 + 1.8 * parseFloat(this.avlDataItems[i]['t_name'].value) * 6 / this.weight).toFixed(1);
                }
            }

            // Calculate vo2Gen - walk test
            if (this.selected === 2) {
                if (this.avlDataItems[i]['speed'].value == "") {
                } else {
                    if (this.avlDataItems[i]['heart_rate'].value == "") {
                    } else {
                        this.avlDataItems[i]['vo2gen'].value = (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.1 + 3.5 + parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
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
                        this.avlDataItems[i]['vo2gen'].value = (parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * 0.2 + 3.5 + parseFloat(this.avlDataItems[i]['speed'].value) * 1000 / 60 * (parseFloat(this.avlDataItems[i]['grade'].value) / 100) * 1.8 * 0.5) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                    }
                }
            }

            // Calculate vo2Gen - step test
            if (this.selected === 4) {
                if (this.avlDataItems[i]['speed'].value == "") {
                    // this.avlDataItems[i]['vo2gen'] = null;
                } else {
                    this.avlDataItems[i]['vo2gen'].value = (0.2 * parseFloat(this.avlDataItems[i]['speed'].value) + 2.394 * 0.01 * parseFloat(this.avlDataItems[i]['stepHeight'].value) * parseFloat(this.avlDataItems[i]['speed'].value) + 3.5) * (parseFloat(this.weight) + this.extraWeight) / parseFloat(this.weight);
                }
            }

            // not optimized | speed
            if (this.selected === 1) {
                if (parseFloat(this.avlDataItems[i]['t_name'].value) < 30) {
                    this.avlDataItems[i]['speed'].value = 0;
                } else {
                    this.avlDataItems[i]['speed'].value = (Math.round((Math.sqrt((parseFloat(this.avlDataItems[i]['t_name'].value) - 67.7236) / 0.3751 + Math.pow(0.5 * 8.2538 / (0.3751), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100).toFixed(1);
                }
            }

            // not optimized | mets percentage
            if (parseFloat(this.avlDataItems[i]['vo2gen'].value) == "") {
                this.avlDataItems[i]['metsGen'].value = 0;
            } else {
                this.avlDataItems[i]['metsGen'].value = (Math.round(parseFloat(this.avlDataItems[i]['vo2gen'].value) / 3.5 * 100) / 100).toFixed(1);
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
                this.items[0]['vo2peakEst'].value = (Math.round(parseFloat(this.items[0]['VO2peak'].value) / this.weight * 1000 * 100) / 100).toFixed(1);
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

        },
        calPercentv() {
            for (let i = 0; i < this.avlDataItems.length; i++) {
                this.avlDataItems[i]['vo2genpercent'].value = ((parseFloat(this.avlDataItems[i]['vo2gen'].value) / parseFloat(this.items[0]['vo2peakEst'].value)).toFixed(3) * 100).toFixed(0);
            }
        },
        calculateMETsPeak() {
            this.metsPeak = this.vo2Peak / 3.5;
        },
        calculateSpeedPeak(power) {
            return Math.round((Math.sqrt((power - 67.7236) / 0.3751 + Math.pow(0.5 * 8.2538 / (0.3751), 2)) + 8.2538 / (0.3751 * 2)) * 100) / 100;
        },
        calculateRPEPeak() {
            this.rpeArray = [];
            // process vo2 array
            for (let i = 0; i < this.Nvo2; i++) {
                this.rpeArray.push(this.avlDataItems[i]['rpe'].value);
            }

            let max = this.rpeArray.reduce((a, b) => {
                return Math.max(a, b);
            });

            return max;
        },
        calculateSpeedPeakWalk() {
            // process vo2 array
            this.speedArray = [];
            for (let i = 0; i < this.Nvo2; i++) {
                this.speedArray.push(this.avlDataItems[i]['speed'].value);
            }
            let max = this.speedArray.reduce(function (a, b) {
                return Math.max(a, b);
            });
            return max;
        },
        calculateVO2Range() {
            this.vo2Range = this.vo2Peak - 3.5;
        },
        calculatePredictedHRPeak() {
            this.hrPeakPredicted = 208 - 0.7 * this.client.age;
            // this.hrPeakPredicted = 208 - (0.7 * this.age);
        },
        calculateVO2PeakEst() {
            this.vo2Peak = Math.round(this.vo2Gen / this.weight * 1000 * 100) / 100;
        },
        calculateVO2Peak() {
            // cal slope
            this.Nvo2 = this.avlDataItems.length;
            this.Xvo2 = this.avlDataItems;
            this.Yvo2 = this.avlDataItems;

            this.SXB = this.SYB = this.SXYB = this.SXXB = this.SYYB = 0;

            for (var i = 0; i < this.Nvo2; i++) {
                this.SXB = this.SXB + parseFloat(this.Xvo2[i]['vo2gen'].value);
                this.SYB = this.SYB + parseFloat(this.Yvo2[i]['heart_rate'].value);
                this.SXYB = this.SXYB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
                this.SXXB = this.SXXB + parseFloat(this.Xvo2[i]['vo2gen'].value) * parseFloat(this.Xvo2[i]['vo2gen'].value);
                this.SYYB = this.SYYB + parseFloat(this.Yvo2[i]['heart_rate'].value) * parseFloat(this.Yvo2[i]['heart_rate'].value);
            }

            this.slopeB = (this.Nvo2 * this.SXYB - this.SXB * this.SYB) / (this.Nvo2 * this.SXXB - this.SXB * this.SXB);
            this.InterceptB = (this.SYB - this.slopeB * this.SXB) / this.Nvo2;

        },
        // Calculate Gradient - walk test
        gradientWalk() {
            if (this.hrPeak == "") {
                this.items[0]['gradient'].value = 0;
            } else {
                this.items[0]['gradient'].value = ((parseFloat(this.items[0]['vo2peakEst'].value) * (parseFloat(this.weight) / (parseFloat(this.weight) + this.extraWeight)) - (parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 0.1 + 3.5)) / (parseFloat(this.items[0]['Speedpeak'].value) * 1000 / 60 * 1.8)).toFixed(2) * 100;
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
            for (var i = 0; i < this.avlProgramDataItems.length; i++) {
                if (parseFloat(this.avlProgramDataItems[i]['volume'].value) > 0) {
                    this.totKJ += parseFloat(this.avlProgramDataItems[i]['volume'].value);
                }
            }

            this.createOutputArray("totKJ", this.CustomDecimal(this.totKJ, 0), "Total kJ for the table above");
        },
        calculateTotIntensity() {
            this.totIntensity = 0;
            for (var i = 0; i < this.avlProgramDataItems.length; i++) {
                if (parseFloat(this.avlProgramDataItems[i]['intensityM'].value) > 0) {
                    this.totIntensity += parseFloat(this.avlProgramDataItems[i]['intensityM'].value);
                }
            }
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
            return max;
        },
        calculateCycleCount() {
            if (this.totKJ == "") {

            } else {
                this.cycleCount = (9000 * 4.185 / this.totKJ).toFixed(0);
            }
            this.createOutputArray("cycleCount", this.cycleCount, "No. of times the table needs to be repeated to lose 1 kg fat");
        },
        calculateMaxIntensity() {
            this.maxIntensity = this.calculateIntensityMax();
            this.createOutputArray("maxIntensity", this.maxIntensity, "Maximum Intensity: METS");
        },
        calculateAvgIntensity() {
            this.avgIntensity = (this.totIntensity / this.avlProgramDataItems.length).toFixed(1);
            this.createOutputArray("avgIntensity", this.avgIntensity, "Average Intensity:  METS");
        },
        calculateProgramData(col, i) {
            // Calculate power -
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                this.avlProgramDataItems[i]['power'].value = ((parseFloat(this.avlProgramDataItems[i]['intensity'].value) - this.Intercept) / this.Slope).toFixed(2);
            }

            // Calculate speed -
            if (this.avlProgramDataItems[i]['intensity'].value == "" || this.avlProgramDataItems[i]['intensity'].value == 0) {
            } else {
                if (this.avlProgramDataItems[i]['power'].value < 30) {
                } else {
                    this.avlProgramDataItems[i]['speed'].value = (Math.sqrt((parseFloat(this.avlProgramDataItems[i]['power'].value) - 67.7236) / 0.3751 + Math.pow(0.5 * 8.2538 / (0.3751), 2)) + 8.2538 / (0.3751 * 2)).toFixed(1);
                }
            }

            // Calculate vo2 -> mlkg-1
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                // if (this.avlProgramDataItems[i]['duration'].value == "") {
                // } else {
                this.avlProgramDataItems[i]['vo2gen'].value = ((parseFloat(this.avlProgramDataItems[i]['intensity'].value) - this.InterceptB) / this.slopeB).toFixed(1);
                // }
            }

            // Calculate intensity -> mets
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                this.avlProgramDataItems[i]['intensityM'].value = (parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) / 3.5).toFixed(1);
            }

            // Calculate volume -> kJ
            if (this.avlProgramDataItems[i]['intensity'].value.trim().length !== "") {
                if (this.avlProgramDataItems[i]['duration'].value == "") {
                    this.avlProgramDataItems[i]['volume'].value = 0;
                } else {
                    this.avlProgramDataItems[i]['volume'].value = (parseFloat(this.avlProgramDataItems[i]['intensityM'].value) * this.weight * parseFloat(this.avlProgramDataItems[i]['duration'].value) / 60 * 4.185).toFixed(1);
                }
            }

            // Calculate sets to lose -> 1kg fat
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                if (this.avlProgramDataItems[i]['duration'].value == "") {
                    this.avlProgramDataItems[i]['setsToLose'].value = 0;
                } else {
                    this.avlProgramDataItems[i]['setsToLose'].value = (9000 * 4.185 / parseFloat(this.avlProgramDataItems[i]['volume'].value)).toFixed(1);
                }
            }

            // Calculate intensity range -
            this.avlProgramDataItems[i]['intensityR'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) - 3.5) / parseFloat(this.items[0]['vo2peakEst'].value)) * 100;

            // Calculate vo2 -> lmin-1
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                this.avlProgramDataItems[i]['vo2M'].value = (parseFloat(this.avlProgramDataItems[i]['vo2gen'].value) * this.weight / 1000).toFixed(2);
            }

            // Calculate v02 peak percentage -
            if (this.avlProgramDataItems[i]['intensity'].value == "") {
            } else {
                if (this.hrPeak = "") {
                } else {
                    this.avlProgramDataItems[i]['vo2P'].value = ((parseFloat(this.avlProgramDataItems[i]['vo2M'].value) / parseFloat(this.items[0]['VO2peak'].value)) * 100).toFixed(1);
                }
            }

            this.processGraph();
            this.fillData();

            // data summery
            this.calculateTotKj();
            this.calculateTotIntensity();
            this.calculateCycleCount();
            this.calculateMaxIntensity();
            this.calculateAvgIntensity();
            this.createOutputArray("totTime", this.totTime, "Total time: minutes");
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
        validateData() {
            if (this.avlDataItems.length < 1) {
                alert('feed some data to table');
                return false;
            }
            if (this.testId < 1) {
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
        formatDate(value, fmt = 'D MMM YYYY') {
            return value == null
                ? ''
                : moment(value, 'YYYY-MM-DD').format(fmt)
        },

        /**
         * Short Report Export to PDF
         */
        printPdfShort() {
            let fields = [];

            switch (this.programtype) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                    fields.push('power', 'speed', 'duration', 'totDuration');
                    break;
                case 6:
                case 7:
                case 8:
                case 9:
                case 10:
                    fields.push('intensitySP', 'gradientP', 'intensityEW', 'durationT', 'duration', 'totDuration');
                    break;
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                    fields.push('intensitySP', 'intensityGD', 'gradientP', 'intensityEW', 'durationT', 'duration', 'totDuration');
                    break;
                case 16:
                case 17:
                case 18:
                case 19:
                case 20:
                    fields.push('intensityUpDown', 'intensitySH', 'speedUpDown', 'duration', 'totDuration');
                    break;
            }

            return this.getPdfReport('short', fields);
        },

        /**
         * Full Report Export to PDF
         */
        printPdfFull() {
            return this.getPdfReport('full');
        },

        /**
         * Data send to API and Generate PDF file
         *
         * @param type
         * @param fields
         */
        getPdfReport(type, fields) {
            let legend_data = [], table_data = [], table_header = [];
            const program = this.programtypes.filter(type => type.id === this.programtype);
            this.disablePrintBtn(type, true, 0);

            //Test Legend data fetch for pdf
            $('#program-legend-card > .test-legend').each(function (i, e) {
                const item = $(e).find('.legend-1'), value = $(e).find('.legend-2 > .legend-value').text();

                legend_data.push({
                    heading: item.find('.legend-heading').text(),
                    sub_heading: item.find('.legend-subheading').text(),
                    value: value,
                });
            });

            //Table Sort for short report
            if (type === 'short') {
                this.tableProgram.forEach((item) => {
                    fields.forEach((title, index) => {
                        if (item.name === title) {
                            table_header[index] = item;
                        }
                    });
                });

                this.avlProgramDataItems.forEach((item, index) => {
                    let data = {};
                    fields.forEach((title) => {
                        if (item.hasOwnProperty(title)) {
                            data[title] = item[title];
                        }
                    });
                    table_data.push(data);
                });
            } else {
                table_header = this.tableProgram;
                table_data = this.avlProgramDataItems;
            }

            //Preparing the object for pdf
            const data = {
                client: Object.assign(this.client, {'weight': this.weight}),
                test_details: {test_name: this.testname, test_type: this.testtypename, program: program[0].name},
                table_headers: table_header,
                table_data: table_data,
                summery_data: this.inputFields,
                line_chart: document.getElementById('line-chart').toDataURL(),
                legend_data: legend_data,
                hidden_columns: this.hiddenFields,
                summery_panel: this.outputFields,
                report_type: type,
                only_fields: fields
            };

            window.axios.post(`${this.$config.BASE_URL}/program/download`, data)
                .then((res) => {
                    const link = document.createElement('a');

                    link.href = res.data.url;
                    link.download = res.data.url.substr(res.data.url.lastIndexOf('/') + 1);
                    link.click();
                    this.disablePrintBtn(type, false, 0);
                }).catch(function (error) {
                console.log(error);
                this.disablePrintBtn(type, false, 0);
            });

        },

        /**
         * Download button state change
         *
         * @param {string} type
         * @param {string} status
         * @param {string} time
         */
        disablePrintBtn(type, status, time) {
            let milliseconds = typeof time === 'undefined' ? 3000 : time;

            setTimeout(() => {
                if (type === 'full') {
                    this.full_print_status = status;
                } else if (type === 'short') {
                    this.short_print_status = status;
                } else {
                    this.full_print_status = status;
                    this.short_print_status = status;
                }
            }, milliseconds);
        },

        /**
         * Time to Decimal
         *
         * @param {object} event
         * @param {object} data
         * @returns {string}
         */
        timeFormat(event, data) {
            const value = event.target.value;
            //Format the h:i
            const minutesSeconds = value.split(/[.:]/);
            let minutes = parseInt(minutesSeconds[0], 10);
            let seconds = minutesSeconds[1] ? eval(minutesSeconds[1]) : 0;

            if (seconds >= 60) {
                const m = seconds / 60 << 0;
                minutes += m;
                seconds -= 60 * m;
            }

            let formatted = seconds ? minutes + '.' + seconds : minutes;
            //Set model value
            data.value = formatted;

            return event.target.value = formatted;
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
                timeA[i] = isNaN(parseInt(timeA[i])) ? 0 : (timeA[i].length === 1 && i === max - 1 ? timeA[i] * 10 : timeA[i]);
                timeB[i] = isNaN(parseInt(timeB[i])) ? 0 : (timeB[i].length === 1 && i === max - 1 ? timeB[i] * 10 : timeB[i]);
            }

            // store time values
            for (let i = 0; i < max; i++) {
                times[i] = parseInt(timeA[i]) + parseInt(timeB[i]);
            }

            let [minutes, seconds] = times;

            if (seconds >= 60) {
                const m = seconds / 60 << 0;
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

}
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

#section-b-1-1 {
    background-color: #fafafb;
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
    background-color: #ffffff87;
    border-radius: 5px;
    position: absolute;
    right: 15px;
    height: 70px;
}

.legend-heading {
    height: 29px;
    color: #0474C8;
    font-size: 20px;
    font-weight: 600;
    letter-spacing: 0.29px;
    line-height: 29px;
    margin-bottom: auto;
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
    font-size: 28px;
    font-weight: 600;
    letter-spacing: 0.36px;
    line-height: 37px;
    margin: auto;
}

.test-legend-name {
    height: 74px;
    width: 278px;
    background-color: #FAFAFB;
    margin: auto;
    padding-top: 10px;
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
    width: 160px;
    color: #000;
    /* font-family: Montserrat;	 */
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 0.19px;
    line-height: 19px;
    max-width: 160px;
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
    margin-bottom: 40px !important;
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

    #table_canvas_full {
        transform: scaleX(1);
        transform-origin: left;
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


/* for report*/

#section-b-2-report {
    background-color: #fafafb;
    padding: 10px;
    width: 100%;
}

.test-legend-report {
    height: 74px;
    width: 230px;
    border-radius: 6px;
    background-color: #EEF1F9;
    padding: 8px;
    margin: auto;
}


.legend-value-report {
    height: 37px;
    color: #0474C8;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 0.36px;
    line-height: 37px;
    margin: auto;
}

.test-legend-name-report {
    height: 74px;
    width: 200px;
    background-color: #FAFAFB;
    margin: auto;
    padding-top: 10px;
}


.table-heading-text-report {
    height: 19px;
    width: 160px;
    color: #000;
    /* font-family: Montserrat;	 */
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 2.60px;
    line-height: 19px;
    max-width: 160px;
    margin: auto;
}

.table-subheading-text-report {
    height: 18px;
    color: #000;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1.60px;
    line-height: 18px;
    max-width: 160px;
    margin: auto;
}

</style>


