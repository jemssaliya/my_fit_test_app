<template>
    <div class="ui container" style="padding-right:0px;">

        <div class="vuetable-pagination ui basic segment grid">
            <vuetable-pagination-info ref="paginationInfoTop"
            ></vuetable-pagination-info>
            <vuetable-pagination ref="paginationTop"
                                 @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
        </div>
        <vuetable ref="vuetable"
                  api-url="url"
                  :fields="fields"
                  pagination-path=""
                  :per-page="20"
                  :multi-sort="true"
                  :sort-order="sortOrder"
                  detail-row-component="my-detail-row"
                  @vuetable:cell-clicked="onCellClicked"
                  @vuetable:pagination-data="onPaginationData"
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
        <div class="vuetable-pagination ui basic segment grid">
            <vuetable-pagination-info ref="paginationInfo"
            ></vuetable-pagination-info>
            <vuetable-pagination ref="pagination"
                                 @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
        </div>
    </div>
</template>

<script>
    import accounting from 'accounting'
    import moment from 'moment'
    import Vue from 'vue'
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import CustomActions from './CustomActions'
    import DetailRow from './DetailRow'
    import VueEvents from 'vue-events'
    import FilterBar from './FilterBar'

    Vue.component('custom-actions', CustomActions)
    Vue.component('my-detail-row', DetailRow)
    Vue.component('filter-bar', FilterBar)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo
        },
        props: {
            clientId: 1
        },
        computed() {
            return url = 'http://localhost:8000/tests';
        },
        data() {
            return {
                url: null,
                data: test,
                fields: [
                    {
                        name: '__handle',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned'
                    },
                    {
                        title: '',
                        name: 'name',
                        sortField: 'name',
                    },
                    {
                        title: '',
                        name: 'test_type',
                        sortField: 'test_type'
                    },
                    {
                        title: '',
                        name: 'created_at',
                        sortField: 'created_at',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        callback: 'formatDate|DD/MM/YYYY'
                    },
                    {
                        title: '',
                        name: 'created_at',
                        sortField: 'created_at',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        callback: 'formatTime|hh:mm'
                    },
                ],
                css: {
                    table: {
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down'
                    },
                },
                sortOrder: [
                    {
                        field: 'email',
                        sortField: 'email',
                        direction: 'asc'
                    }
                ]
            }
        },
        methods: {
            allcap(value) {
                return value.toUpperCase()
            },
            formatNumber(value) {
                return accounting.formatNumber(value, 2)
            },
            formatDate(value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY/MM/DD').format(fmt)
            },
            formatTime(value, fmt = 'h hh') {
                return (value == null)
                    ? ''
                    : moment(value, 'HH:mm').format(fmt)
            },
            onPaginationData(paginationData) {
                this.$refs.paginationTop.setPaginationData(paginationData)
                this.$refs.paginationInfoTop.setPaginationData(paginationData)

                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.vuetable.changePage(page)
            },
            onAction(action, data, index) {
                console.log('slot action: ' + action, data.name, index)
            },
            onCellClicked(data, field, event) {
                console.log('cellClicked: ', field.name)
                this.$refs.vuetable.toggleDetailRow(data.id)
            }
        }
    }
</script>

<style scoped>

</style>
