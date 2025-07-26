<template>
    <div class="client-card has-tag" v-if="client.gender">
        <div class="client-details p-4">
            <div class="row">
                <div class="col-sm-4 col-md-5">
                    <h4>{{client.name}}</h4>
                </div>
                <div class="col-sm-8 col-md-7 text-right">
                    <div class="row">
                        <div :class="showClearButton ? 'col-lg-4' : 'col-lg-6'">
                            <button @click="startTest" class="btn btn-success btn-block mb-1">Start New Test</button>
                        </div>
                        <div :class="showClearButton ? 'col-lg-4' : 'col-lg-6'">
                            <button @click="compare()" class="btn btn-outline-success btn-block mb-1">Compare Tests
                            </button>
                        </div>
                        <div v-if="showClearButton" class="col-lg-4">
                            <button @click="clearSelection()" class="btn btn-outline-success btn-block mb-1">Clear
                                Selection
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4 col-lg-1">
                    {{client.gender}}
                </div>
                <div class="col-md-4 col-lg-3 col-xl-2">
                    <strong>{{client.age}}</strong> Years Old
                </div>
                <div class="col-md-4 col-lg-3">
                    DOB: {{formatDate(client.dob,'DD/MM/YYYY')}}
                </div>
                <div class="col-lg-5 col-xl-6 text-right">
                    <a v-if="showEdit" :href="'/clients/edit/' + client_id">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="margin: 13px; margin-top: 5px; padding: 5px; padding-left: 0px;">
            <div class='col-md-12'>
                <h4 style="height: 19px;width: auto;color: #989AA1;font-family: Montserrat !important;font-size: 16px;font-weight: bold;letter-spacing: 0.19px;line-height: 19px;">
                    Test History</h4>
                <hr style="box-sizing: border-box;height: 2px;width: 100%;border: 1px solid #D8D9DE;"/>
            </div>
            <div class='col-md-2'>
                <h5 style="height: 18px;width: 48px;color: #000;font-family: Montserrat !important;font-size: 14px;font-weight: bold;letter-spacing: 0.17px;line-height: 18px;margin-top: 5px;">
                    Filters</h5>
            </div>
            <div class='col-md-4'>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label pull-left">From</label>
                    <div class="col-sm-10 pull-left">
                        <input v-model="fromDate" name="fromDate" @change="filterData" type='date'/>
                        <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label pull-left">To</label>
                    <div class="col-sm-10 pull-left">
                        <input v-model="toDate" name="toDate" @change="filterData" type='date'/>
                        <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll" style="padding: 18px; height: 500px!important; margin-bottom: 50px;">
            <vuetable ref="vuetable"
                      :api-url="apiUrl"
                      :fields="fields"
                      pagination-path=""
                      :css="css.table"
                      :sort-order="sortOrder"
                      :multi-sort="true"
                      detail-row-component="my-detail-row"
                      :append-params="moreParams"
                      @vuetable:cell-clicked="onCellClicked"
                      @vuetable:checkbox-toggled="onCheckboxToggled"
            >
                <template slot="actions" slot-scope="props">
                    <div class="custom-actions">
                        <button class="ui basic button"
                                @click="onAction('view-item', props.rowData, props.rowIndex)">
                            <i class="zoom icon"></i>
                        </button>
                        <button class="ui basic button"
                                @click="onAction('edit-item', props.rowData, props.rowIndex)">
                            <i class="edit icon"></i>
                        </button>
                        <button class="ui basic button"
                                @click="onAction('delete-item', props.rowData, props.rowIndex)">
                            <i class="delete icon"></i>
                        </button>
                    </div>
                </template>
            </vuetable>

        </div>
    </div>
</template>

<script>
    // import accounting from 'accounting'
    import moment from 'moment'
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import Vue from 'vue'
    import VueEvents from 'vue-events'
    import CustomActions from './CustomActions'
    import DetailRow from './DetailRow'
    import FilterBar from './FilterBar'

    Vue.use(VueEvents)
    Vue.component('custom-actions', CustomActions)
    Vue.component('my-detail-row', DetailRow)
    Vue.component('filter-bar', FilterBar)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        props: {
            client_id: {
                required: true
            },
            client: {
                required: true
            },
        },
        computed: {
            // apiUrl: function () {
            // return "http://localhost:8000/test-summery?client_id="+ this.client_id;
            // return this.$config.BASE_URL + "/test-summery?client_id="+ this.client_id;
            // setter
            // get: function () {
            //   return this.firstName + ' ' + this.lastName
            // },
            // set: function (newValue) {
            //   var names = newValue.split(' ')
            //   this.firstName = names[0]
            //   this.lastName = names[names.length - 1]
            // }
            // }
            apiUrl2: {
                get: function () {
                    console.log('triggered');
                    return this.apiUrl = this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id;
                    //  return this.apiUrl = "http://localhost:8000/test-summery?client_id="+ this.client_id;
                },
                set: function (newValue) {
                    this.apiUrl = newValue;
                }
            }
        },
        mounted() {
            // console.log(this.apiUrl);
            // console.log(this.client_id);
        },
        watch: {
            'client_id': function (newVal, oldVal) {
                //to work with changes in prop
                // console.log('watcher');
                // console.log(this.client_id);
                this.showEdit = true;
                this.apiUrl2 = this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id;
            },
            // 'selectedRows': function (newVal, oldVal) {
            //   if(this.selectedRows.length < 1) {
            //     this.showClearButton = false;
            //   } else this.showClearButton = true;
            // }
        },
        data() {
            return {
                vo2peakEstimated: 0,
                selectedRows: [],
                checkedRows: [],
                fromDate: null,
                toDate: null,
                showEdit: false,
                data: [],
                showClearButton: false,
                cycleTest: [],
                walkTest: [],
                runTest: [],
                stepTest: [],
                compareID: null,
                apiUrl: this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id,
                //  apiUrl:"http://localhost:8000/test-summery?client_id="+ this.client_id,
                // from_date:null,
                // to_date:null,
                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-right',
                        dataClass: 'text-right'
                    },
                    {
                        name: '__checkbox',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        name: 'name',
                        sortField: 'name',
                    },
                    {
                        name: 'test_type_name',
                        title: 'Test Type',
                        sortField: 'test_type_name'
                    },
                    {
                        name: 'local_created_at.timestamp',
                        title: 'Created at',
                        sortField: 'created_at',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        // dataClass: 'created_date-custom',
                        // callback: 'formatDate|DD/MM/YYYY hh:mm:ss a'
                    },
                ],
                css: {
                    table: {
                        tableClass: 'table table-seperated table-striped table-hover',
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down'
                    },
                    pagination: {
                        wrapperClass: 'pagination',
                        activeClass: 'active',
                        disabledClass: 'disabled',
                        pageClass: 'page',
                        linkClass: 'link',
                        icons: {
                            first: '',
                            prev: '',
                            next: '',
                            last: '',
                        },
                    },
                    icons: {
                        first: 'glyphicon glyphicon-step-backward',
                        prev: 'glyphicon glyphicon-chevron-left',
                        next: 'glyphicon glyphicon-chevron-right',
                        last: 'glyphicon glyphicon-step-forward',
                    },
                },
                sortOrder: [
                    {field: 'created_at', sortField: 'created_at', direction: 'asc'}
                ],
                moreParams: {}
            }
        },
        methods: {
            // api-url=this.$config.BASE_URL + "/test-summery"
            allcap(value) {
                return value.toUpperCase()
            },
            genderLabel(value) {
                return value === 'M'
                    ? '<span class="label label-success"><i class="glyphicon glyphicon-star"></i> Male</span>'
                    : '<span class="label label-danger"><i class="glyphicon glyphicon-heart"></i> Female</span>'
            },
            formatNumber(value) {
                return accounting.formatNumber(value, 2)
            },
            formatDate(value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY-MM-DD hh:mm:ss a').format(fmt)
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onAction(action, data, index) {
                console.log('slot action: ' + action, data.name, index)
            },
            onChangePage(page) {
                this.$refs.vuetable.changePage(page)
            },
            onCellClicked(data, field, event) {
                console.log('cellClicked: ', field.name)
                this.$refs.vuetable.toggleDetailRow(data.id)
                console.log('*******')
            },
            onCheckboxToggled(isChecked, data) {
                if (this.$refs.vuetable.selectedTo.length < 1) {
                    this.showClearButton = false;
                } else this.showClearButton = true;
            },
            validation() {

            },
            compare() {
                this.cycleTest = [];
                this.walkTest = [];
                this.runTest = [];
                this.stepTest = [];
                var dummyData;
                var filtered = [];
                this.selectedRows = this.$refs.vuetable.selectedTo
                // console.log(this.$refs.vuetable.tableData);
                // console.log(this.selectedRows);
                // console.log(this.selectedRows.length);
                this.data = this.$refs.vuetable.tableData;
                var selected = this.selectedRows;
                // var filtered = this.data.filter(function(d, ix) { return selected.indexOf(ix) >= 0; });
                // var filtered = this.selectedRows.map(function(i) { return selected[i]; });
                this.selectedRows.forEach(element => {
                    this.data.forEach(element1 => {
                        if (element1.id == element) {
                            filtered.push(element1);
                        }
                    });
                });
                // console.log(filtered);
                filtered.forEach(element => {
                    // console.log(element)
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

                if ((this.cycleTest.length > 0) || (this.walkTest.length > 0) || (this.runTest.length > 0) || (this.startTest.length > 0)) {
                    //  window.axios.post('http://localhost:8000/compare-test', {
                    // console.log(this.client_id);

                    var base_path = this.$config.BASE_URL;
                    window.axios.post(this.$config.BASE_URL + '/compare-test', {
                        client_id: this.client_id,
                        cycleTest: this.cycleTest,
                        walkTest: this.walkTest,
                        runTest: this.runTest,
                        stepTest: this.stepTest,
                    })
                        .then(function (response) {
                            console.log(response.data);
                            self.compareID = response.data.data.id;
                            //       window.location.href = 'http://fitatanyage.sandbox8.elegant-media.com/compare-test-view?compare_id='+self.compareID;
                            window.location.href = base_path + '/compare-test-view?compare_id=' + self.compareID;

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }

            },
            filterData() {
                if (this.fromDate !== null && this.toDate !== null) {
                    if (this.fromDate <= this.toDate) {
                        console.log('filter working 1');
                        if (this.fromDate <= Date.now) {
                            console.log('filter working 2');
                            this.apiUrl2 = this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id + "&from_date=" + this.fromDate + "&to_date=" + this.toDate;
                        }
                    }
                }
            },
            startTest() {
                if (this.client_id === null) {
                    console.log('select client first');
                } else {
                    window.location.href = this.$config.BASE_URL + '/new-tests?client_id=' + this.client_id;
                }
            },
            clearSelection() {
                this.selectedRows = [];
                this.$refs.vuetable.selectedTo = [];
                this.showClearButton = false;
            },
        },
        events: {
            'filter-set'(filterText) {
                this.moreParams = {
                    filter: filterText
                }
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            },
            'filter-reset'() {
                this.moreParams = {}
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            },
            'vuetable:loading': function () {
                if (this.$refs.vuetable !== undefined) {
                    this.$refs.vuetable.apiUrl = this.apiUrl;
                }
            },
            'tableChangeEvent': function (table) {
                this.current_table = table;
                var vm = this;
                this.$nextTick(function () {
                    vm.$broadcast('vuetable:refresh');
                });
            },
            'apiUrl': function (newVal, oldVal) {
                if (newVal !== oldVal)
                    this.refresh()
            }
        }
    }
</script>
<style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .td {
        background: #d6ddea;
        background-color: #FAFAFB;
    }

    .table-striped tbody tr {
        background-color: #FAFAFB !important;
    }

    thead {
        display: none !important;
    }

    .table tr {
        background-color: #FAFAFB;
    }

    .table th {
        background-color: #FAFAFB;
    }

    .pagination {
        margin: 0;
        float: right;
    }

    .pagination a.page {
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 10px;
        margin-right: 2px;
    }

    .pagination a.page.active {
        color: white;
        background-color: #337ab7;
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 10px;
        margin-right: 2px;
    }

    .pagination a.btn-nav {
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 7px;
        margin-right: 2px;
    }

    .pagination a.btn-nav.disabled {
        color: lightgray;
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 7px;
        margin-right: 2px;
        cursor: not-allowed;
    }

    .pagination-info {
        float: left;
    }

    .scroll {
        height: 550px !important;
        overflow: auto;
    }

    .table-seperated {
        border-collapse: separate;
        border-spacing: 0em 0.5em;
    }

    .created_date-custom {
        background-color: #5ABF5A;
        border-radius: 10px;
        padding: 5px;
    }

    input[type=date] {
        border: solid 1px #ccc;
        padding: 9px 10px 9px 32px;
        width: 100%;

        -webkit-border-radius: 10em;
        -moz-border-radius: 10em;
        border-radius: 10em;

        -webkit-transition: all .5s;
        -moz-transition: all .5s;
        transition: all .5s;
        size: 50px;
    }
</style>
