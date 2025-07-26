<template>
    <div @click="onClick" class="detail-row">
        <div class="inline field">
            <div class="row legend-collection">
                <div class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">VO2 peak</p>
                        <p class="legend-subheading">ml/kg/min</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{this.CustomDecimal(VO2peakE,2)}}</p>
                    </div>
                </div>
                <div class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">HR peak</p>
                        <p class="legend-subheading">%predicted = <span style="color: #0474C8; font-weight: bold;">{{ this.CustomDecimal(Math.floor(predictedHrRPeakPercentage),0) }}%</span>
                        </p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['HRpeak'] ?
                            this.CustomDecimal(items[0]['HRpeak'].value,2) : '') : ''}}</p>
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['Powerpeak']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Power peak</p>
                        <p class="legend-subheading">watts</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['Powerpeak'] ?
                            this.CustomDecimal(items[0]['Powerpeak'].value,2) : '') : ''}}</p>
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
                            this.CustomDecimal(items[0]['Speedpeak'].value,2) : '') : ''}}</p>
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['gradient']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Gradient peak</p>
                        <p class="legend-subheading">%</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['gradient'] ?
                            this.CustomDecimal(items[0]['gradient'].value,2) : '') : ''}}</p>
                    </div>
                </div>
                <div v-if="items[0] ? (items[0]['stepHeight']) : false" class="row test-legend">
                    <div class="legend-1">
                        <p class="legend-heading">Step Height</p>
                        <p class="legend-subheading">cm</p>
                    </div>
                    <div class="legend-2">
                        <p class="legend-value">{{ items[0] ? (items[0]['stepHeight'] ?
                            this.CustomDecimal(items[0]['stepHeight'].value,2) : '') : ''}}</p>
                    </div>
                </div>
                <!-- <div class="row legend s flex" style="margin-right: 5px;">
                  <div class="legend-1">
                    <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                    <p style="margin-bottom: 0px;">ml.kg-1.min-1</p>
                  </div>
                  <div class="legend-2">
                    <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{VO2peakE}}</p>
                  </div>
                </div>
                <div class="row legend test-legend flex" style="margin-right: 5px;">
                  <div class="legend-1">
                    <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                    <p style="margin-bottom: 0px;">ml.kg-1.min-1</p>
                  </div>
                  <div class="legend-2">
                    <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{VO2peakE}}</p>
                  </div>
                </div>
                <div class="row legend test-legend flex" style="margin-right: 5px;">
                  <div class="legend-1">
                    <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                    <p style="margin-bottom: 0px;">ml.kg-1.min-1</p>
                  </div>
                  <div class="legend-2">
                    <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{VO2peakE}}</p>
                  </div>
                </div>
                <div class="row legend test-legend flex" style="margin-right: 5px;">
                  <div class="legend-1">
                    <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                    <p style="margin-bottom: 0px;">ml.kg-1.min-1</p>
                  </div>
                  <div class="legend-2">
                    <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{VO2peakE}}</p>
                  </div>
                </div> -->
                <!-- <div class="inputs">
                  <p style="margin-bottom: 0px;">Weight</p>
                  <p style="margin-bottom: 0px;">{{ weight }}</p>
                </div>
                <div class="inputs">
                  <p style="margin-bottom: 0px;">HR Peak</p>
                  <p style="margin-bottom: 0px;">{{ hrPeak}}</p>
                </div>

                <div class="row legend pull-right flex" style="margin-right: 5px;">
                  <div class="legend-1">
                    <p style="margin-bottom: 0px; font-weight: bold; color: #3374c8; font-size: 20px;">VO2 Peak</p>
                    <p style="margin-bottom: 0px;">ml.kg-1.min-1</p>
                  </div>
                  <div class="legend-2">
                    <p style="font-weight: bold; color: #3374c8; margin-bottom: 0px; font-size: 30px;">{{VO2peakE}}</p>
                  </div>
                </div> -->
            </div>
            <div class="row" style="padding: 10px;">
                <table class="" style="width: 100%; border-collapse: separate; border-spacing: 2px; margin-top: 15px;">
                    <thead style="background-color:#eef1f9; display: table-header-group!important;">
                    <tr style="background-color: #eef1f9;">
                        <!-- <th v-for="tableCol in tableData" :key="tableCol.id" style="padding: 10px;" :style="{ display: (tableCol.name ==) tableCol.pivot.display}"> -->
                        <th v-for="tableCol in tableData" :key="tableCol.id" style="padding: 10px;"
                            :style="{ display: (tableCol.name == 'row_id' || tableCol.name == 'vo2peakEst' || tableCol.name == 'HRpeak' || tableCol.name == 'Powerpeak' || tableCol.name == 'Speedpeak') ? 'none' : '' }">
                            <p class="mb-0">
                                {{tableCol.heading}}
                                <br>
                                <span class="unit-label">{{tableCol.sub_heading}}</span>
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="background-color:#eef1f9;">
                    <tr style="background-color: #eef1f9;" v-for="(row, idx1) in items" :key="idx1">
                        <td class="" v-for="(col, idx2) in row" :key="idx2" :style="{ display: col.showfield}">
                            <label v-text="CustomDecimal(col.value,2)" type="text" style="max-width: 146px;"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin: auto; display: flow-root;">
                <button @click="viewTest" class="btn btn-info pull-left"> View Test Report</button>
                <button @click="startProgram" class="btn btn-success pull-right"> New Program</button>
                <button @click="previousProgram" class="btn btn-success pull-right mr-1"> Previous Programs</button>
            </div>
            <!-- <span>{{rowData.name}}</span> -->
        </div>
    </div>
    <!-- style="background-color: #eef1f9;" background-color: #D6DDEA;-->
</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            },
            rowIndex: {
                type: Number
            },
            client_id: null
        },
        data() {
            return {
                tableData: [],
                inputData: [],
                items: [],
                itemsDummy: [],
                weight: 0,
                hrPeak: 0,
                VO2peakE: 0,
                obj: Object,
                predictedHrRPeakPercentage: 0,
                isSpeedTest: false,
            }
        },
        mounted() {
            this.getTableData();
            // console.log(this.rowData);
        },
        methods: {
            CustomDecimal(value, cnt = 1) {
                if (value != null) {
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
            onClick(event) {
                console.log('my-detail-row: on-click', event.target)
            },
            getTableData() {
                var param1 = this.rowData.test_type;
                // console.log('this.rowData');
                console.log(this.rowData);
                // console.log(this.rowData.client_id);
                // console.log('this.rowData');
                //  window.axios.get('http://localhost:8000/api/test-types/'+(param1)).then((res) => {
                window.axios.get(this.$config.BASE_URL + '/api/test-types/' + (param1)).then((res) => {
                    this.tables = res.data.data.tables;
                    this.tableData = this.tables[0].columns;
                    // this.obj = this.tables[0].columns.reduce((o, key) => ({ ...o, [key.name]: {value:null,customStyles:key.pivot,column_id:key.id}}), {});
                    this.obj = this.tables[0].columns.reduce((o, key) => ({...o,
                        [key.name]: {
                            value: null,
                            customStyles: key.pivot,
                            column_id: key.id,
                            showfield: ((key.name == 'row_id' || key.name == 'vo2peakEst' || key.name == 'HRpeak' || key.name == 'Powerpeak' || key.name == 'Speedpeak') ? 'none' : '')
                        }
                    }), {});
                    console.log(this.rowData);
                    this.itemsDummy = this.rowData.table1;
                    // this.items = this.rowData.table1;
                    this.VO2peakE = this.rowData.table1[0].vo2peakEst.value;
                    this.setData();
                    console.log(this.rowData.table1[0].vo2peakEst.value);
                    this.inputData = this.rowData.input_data;
                    this.setInputData();
                    // console.log(this.items)
                    // console.log(this.inputData)
                    var hrPeakFromTest = 0;
                    this.inputData.forEach(element => {
                        if (element.fieldId == 'colHR') {
                            hrPeakFromTest = element.value;
                        }
                    });

                    this.predictedHrRPeakPercentage = (isNaN(parseFloat(hrPeakFromTest)) ? 0 : hrPeakFromTest) / (isNaN(parseFloat((this.items[0]['predHrp'] ? this.items[0]['predHrp'].value : 0))) ? 0 : this.items[0]['predHrp'].value);
                    this.predictedHrRPeakPercentage = isNaN(parseFloat(this.predictedHrRPeakPercentage)) ? 0 : (this.predictedHrRPeakPercentage * 100).toFixed(1);

                    if (res.data.data.name == 'Step Test') {
                        this.isSpeedTest = true;
                    }
                });
            },
            setData() {
                for (var i = 0; i < this.itemsDummy.length; i++) {
                    // add row
                    this.items.push(JSON.parse(JSON.stringify(this.obj)));
                    // end add row
                    let ix = 0;
                    for (var property in this.itemsDummy[i]) {
                        this.items[i][property].value = this.itemsDummy[i][property].value;
                        ix++;
                    }
                }
            },
            setInputData() {
                for (var i = 0; i < this.inputData.length; i++) {
                    if (this.inputData[i].name == 'colWeight') {
                        this.weight = this.inputData[i].value;
                    }
                    if (this.inputData[i].name == 'colHR') {
                        this.hrPeak = this.inputData[i].value;
                    }
                    if (this.inputData[i].name == 'hrRest') {
                        // this.weight = this.inputData[i].value;
                    }
                    if (this.inputData[i].name == 'colPSH') {
                        // this.weight = this.inputData[i].value;
                    }
                    if (this.inputData[i].name == 'colRSH') {
                        // this.weight = this.inputData[i].value;
                    }
                    if (this.inputData[i].name == 'colHeight') {
                        // this.weight = this.inputData[i].value;
                    }
                }
            },
            startProgram() {
                //  window.location.href = 'http://localhost:8000/new-program?client_id='+this.rowData.client_id+'&test_id='+this.rowData.id;
                window.location.href = this.$config.BASE_URL + '/new-program?client_id=' + this.rowData.client_id + '&test_id=' + this.rowData.id;
            },
            viewTest() {
                //  window.location.href = 'http://localhost:8000/view-test?client_id='+this.rowData.client_id+'&test_id='+this.rowData.id;
                window.location.href = this.$config.BASE_URL + '/view-test?client_id=' + this.rowData.client_id + '&test_id=' + this.rowData.id;
            }, previousProgram() {
                //  window.location.href = 'http://localhost:8000/view-test?client_id='+this.rowData.client_id+'&test_id='+this.rowData.id;
                window.location.href = this.$config.BASE_URL + '/view-test?client_id=' + this.rowData.client_id + '&test_id=' + this.rowData.id + '#footer-section';
            },
        },
    }
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .td {
        background: #d6ddea;
        background-color: #FAFAFB;
    }

    .inputs {
        margin: 5px;
        background-color: #ffffff87;
        padding: 10px;
        border-radius: 10px;
        font-size: 14px;
        min-width: 80px;
    }

    .inputs .p {
        margin-bottom: 0px;
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

    table tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    table tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }

    .test-legend {
        height: 74px;
        width: 228px;
        border-radius: 6px;
        background-color: #EEF1F9;
        padding: 8px;
        margin: auto;
    }

    .legend-value {
        height: 37px;
        /* width: 48px; */
        color: #0474C8;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: 0.36px;
        line-height: 37px;
        margin: auto;
    }

    .legend-heading {
        height: 29px;
        color: #0474C8;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 0.29px;
        line-height: 29px;
        margin-bottom: auto;
    }

    .legend-subheading {
        color: #000;
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

</style>
