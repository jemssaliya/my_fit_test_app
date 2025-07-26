<template>
    <div class="">
        <!-- Section A | Start New Test -->
        <!-- <section id="section-a" class="grid rounded">
            <SelectTest :client_id="client_id"></SelectTest>
        </section> -->

        <!-- Section B | Add New Client -->
        <section>
        </section>

        <!-- Section C | Client List & Summery -->
        <section id="section-c" class="mt-4">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col">
                            <h4>My Clients</h4>
                        </div>
                        <div class="col">
                            <a class="btn btn-outline-success btn-block" href="/all-clients">View All Clients</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <a class="btn btn-success" href="/clients/create">
                        Add New Client
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 client-list">
                    <!-- client list starts here -->
                    <div class="search-container">
                        <form action="#">
                            <input v-model="searchText" type="search" @input="filterClient($event)"
                                   @keyup.stop="filterClient" placeholder="Search.." name="search">
                        </form>
                    </div>
                    <div class="scroll-client">
                        <table class="table client-list" id="client-list">
                            <tbody>
                            <tr class="bg-light box-curved" v-for="client in clientsDuplicate" :key="client.id">
                                <td :class="{'td-client-list': true, 'selected': client_id == client.id}" colspan="2"
                                    v-on:click="loadTestTable(client)">
                                    <p class="client-name p-l-2 client-name">{{ client.name}}</p>
                                    <p class="d-inline p-l-2 client-gender">{{ client.gender }}</p>
                                    <p class="d-inline p-l-2"><span class="client-age">{{ client.age }}</span> <span
                                        class="client-age-text">Years old</span></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <transition name="fade">
                            <div class="loading" v-show="loading">
                                <span class="fa fa-spinner fa-spin"/> Loading
                            </div>
                        </transition>
                    </div>
                    <!-- client list end here -->
                </div>
                <div class="col-md-9 d-none d-sm-none d-md-block" style="padding-right:0px; margin-top: 8px;">
                    <!-- client tests starts here -->
                    <MyVuetable :client="client" :load-on-start="false" :api-url="apiUrl"
                                :client_id="client_id"></MyVuetable>
                    <!-- client tests ends here -->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import SelectTest from '../components/SelectTest';
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import MyVuetable from '../components/MyVuetable.vue';
    import {vuetable} from './vuetable'

    var cancel;
    var CancelToken = axios.CancelToken;

    export default {
        name: 'clients',
        props: {
            clients: {
                type: Array
            }
        },
        mixins: [vuetable],
        components: {
            Vuetable,
            SelectTest,
            MyVuetable,
        },
        mounted() {
            this.clientsDuplicate = this.clients;

            // Detect when scrolled to bottom.
            const listElm = document.querySelector('.scroll-client');
            listElm.addEventListener('scroll', e => {

                if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight
                    && (this.page !== this.last_page || this.last_page === 1)
                ) {
                    console.log('Load more');
                    this.getData();
                }
            });
        },
        data() {
            return {
                customers: [],
                users: [],
                client_id: null,
                client: [],
                clientsDuplicate: [],
                searchText: null,
                apiUrl: this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id,
                page: 1,
                pageSize: 20,
                loading: false,
                last_page: 0,
                searchItemsSource: null
            }
        },
        methods: {
            filterTests() {
                // items = items.filter(function(item) {
                // 	return item.Title && item.Specifications.some(function(specification) {
                // 		return specification.Name === "Watt";
                // 	});
                // });
            },
            loadTestTable(client) {
                if (client) {
                    this.client_id = client.id;
                    this.client = client;
                    this.apiUrl = this.$config.BASE_URL + "/test-summery?client_id=" + this.client_id;
                }
            },
            getData() {
                this.loading = true;

                if (this.searchItemsSource) {
                    this.searchItemsSource.cancel('Cancel previous request');
                }
                const CancelToken = axios.CancelToken;
                this.searchItemsSource = CancelToken.source();

                axios.get(`${this.$config.BASE_URL}/clients/paginate`, {
                    params: {
                        page: ++this.page,
                        per_page: this.pageSize,
                        q: this.searchText
                    }
                }).then(res => {
                    this.searchItemsSource = undefined;

                    this.clientsDuplicate.push(...res.data.data);
                    // Stop scroll-loader
                    res.data.data.length < this.pageSize && (this.loadMore = false);
                    this.loading = false;
                    this.last_page = res.data.last_page;
                });
            },
            preApiCall() {
                if (cancel != undefined) {
                    cancel();
                    console.log("cancelled");
                }
                this.apiCall(this.query);
            },

            filterClient: _.debounce(function () {
                this.preApiCall();
            }, 300),
            apiCall(query) {
                if (query !== "") {
                    this.loading = true;
                    axios({
                        method: "get",
                        url: `${this.$config.BASE_URL}/clients/paginate`,
                        cancelToken: new CancelToken(function executor(c) {
                            cancel = c;
                        }),
                        params: {
                            page: 1,
                            per_page: this.pageSize,
                            q: this.searchText
                        }
                    }).then(res => {
                        this.clientsDuplicate = res.data.data;
                        console.log(res.data);
                        this.loading = false;
                    }).catch(err => {
                        throw Error(err.message);
                        this.loading = false;
                    });
                }
            }
        },
        created() {
            // this.$http.get('/users').then((res) => {
            //   this.users = res.data.data
            // })
        },
    }
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .box {
        padding: 1em;
        color: #fff;
    }

    #section-a {
        background-color: #bfc8d7;
        padding: 1em;
        margin-top: 1em;
        margin-bottom: 1em;
        justify-content: space-between;
    }

    #section-c {
        padding-left: 16px;
        padding-right: 16px;
    }

    #section-c .client-list {
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 1.75rem;
    }

    .client-list {
        border-collapse: separate;
        border-spacing: 0em 0.5em;
    }

    .td-client-list {
        border: 0.2em solid transparent;
        transition: all 0.25s;
    }

    .td-client-list.selected, .td-client-list:hover {
        border-color: #5abf5a !important;
    }

    .client-name {
        font-size: 1.1rem;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .client-list-heading {
        font-size: 1.2rem !important;
    }

    .p-l-2 {
        padding-left: 0.5rem !important;
    }

    .scroll-client {
        height: 612px !important;
        overflow: auto;
    }

    /* .fixed_header{
        width: 400px;
        table-layout: fixed;
        border-collapse: collapse;
    } */

    /* .fixed_header tbody{
        display:block;
        width: 100%;
        overflow: auto;
        height: 100px;
    }

    .fixed_header thead tr {
        display: block;
    }

    .fixed_header thead {
        background: black;
        color:#fff;
    }

    .fixed_header th, .fixed_header td {
        padding: 5px;
        text-align: left;
        width: 200px;
    } */
    /* .tr:hover {
        border-top:4px solid green;
        border-bottom:4px solid green;
    } */

    /* table {
        width: 100%;
    } */

    /* table, td {
        border-collapse: collapse;
        border: 1px solid #000;
    } */

    /* thead { */
    /* display: table; to take the same width as tr */
    /* width: calc(100% - 17px); - 17px because of the scrollbar width */
    /* } */

    /* tbody { */
    /* display: block; to enable vertical scrolling */
    /* max-height: 500px; e.g. */
    /* overflow-y: scroll; keeps the scrollbar even if it doesn't need it; display purpose */
    /* } */

    /* th, td { */
    /* width: 33.33%; to enable "word-break: break-all" */
    /* padding: 5px; */
    /* word-break: break-all; 4. */
    /* } */

    /* tr { */
    /* display: table; display purpose; th's border */
    /* width: 100%; */
    /* box-sizing: border-box; because of the border (Chrome needs this line, but not FF) */
    /* } */

    /* td {
        text-align: center;
        border-bottom: none;
        border-left: none;
    } */


    input[type=search] {
        background: #ededed url(/images/ic_search.png) no-repeat 9px center;
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
        background-color: white;
    }

    .client-name {
        color: #1B2031;
        font-family: Montserrat !important;
        font-size: 16px;
        letter-spacing: 0.19px;
        line-height: 19px;
    }

    .client-gender {
        height: 16px;
        width: 33px;
        color: #989AA1;
        font-family: Montserrat !important;
        font-size: 13px;
        letter-spacing: 0.16px;
        line-height: 16px;
    }

    .client-age-text {
        height: 16px;
        width: 60px;
        color: #989AA1;
        font-family: Montserrat !important;
        font-size: 13px;
        letter-spacing: 0.16px;
        line-height: 16px;
    }

    .client-age {
        height: 16px;
        width: 17px;
        color: #989AA1;
        font-family: Montserrat !important;
        font-size: 13px;
        font-weight: bold !important;
        letter-spacing: 0.16px;
        line-height: 16px;
    }

    .loading {
        text-align: center;
        position: absolute;
        color: #fff;
        z-index: 9;
        background: #5c4084;
        padding: 8px 18px;
        border-radius: 5px;
        left: calc(50% - 45px);
        top: calc(50% - 18px);
    }

    .loading .fa {
        color: #ffffff;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

</style>
