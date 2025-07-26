<template>
    <div class="row justify-content-center">
        <div class="col-md" style="min-width: 752px; max-width: 752px;">
            <div class="card text-center">
                <div class="card-header">
                    <h2 class="clientform-card-header">{{ title }}</h2>
                </div>
                <div class="card-body" style="background-color: rgba(0,0,0,.03); !important;">
                    <form :method="method" action="/clients" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" :value="method">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label col-form-label-lg lable-text">Client
                                Name</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="client.name" name="name"
                                       class="form-control form-control-lg" id="name" placeholder="Client Name"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-sm-4 col-form-label col-form-label-lg lable-text">Date of
                                Birth</label>
                            <div class="col-sm-8">
                                <input type="date" :value="dateToYYYYMMDD(client.dob)" name="dob"
                                       class="form-control form-control-lg" id="dob" placeholder="Date of Birth"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender"
                                   class="col-sm-4 col-form-label col-form-label-lg lable-text">Gender</label>
                            <div class="col-sm-8">
                                <select v-model="client.gender" class="form-control form-control-lg" name="gender"
                                        id="gender" placeholder="Gender">
                                    <option>Choose...</option>
                                    <option selected>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-muted">
                            <button type="button" @click="saveClient()" class="btn btn-success btn-lg add-client">{{
                                labal }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        name: "clientform",
        props: {
            client: null,
            method: null,
            labal: null,
            title: '',
            redirecturl: null,
        },
        data() {
            return {
                csrf: "",
                birthDate: new Date(),
            }
        },
        mounted() {
            this.csrf = window.Laravel.csrfToken;
            console.log(this.csrf);
            this.birthDate = this.formatDate("01/01/1990");
        },
        methods: {
            formatDateM(value) {
                if (value) {
                    console.log(moment(String(value)).format('MM/DD/YYYY'));
                    return moment(String(value)).format('MM/DD/YYYY')
                }
            },
            updateValue: function (value) {
                this.birthDate = value;
                this.$emit('input', value);
            },
            formatDate(value, fmt = 'MM/DD/YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'MM/DD/YYYY').format(fmt)
            },
            dateToYYYYMMDD(date) {
                // may have timezone caveats https://stackoverflow.com/a/29774197/1850609
                date = new Date(date);
                date = this.formatDate(date, 'DD/MM/YYYY');
                // date = new Date(date);
                // return date && date.toISOString().split('T')[0];
            },
            saveClient() {
                let self = this;

                if (this.client.name == null || this.client.dob == null || this.client.dob > Date.now) {
                    return false;
                }

                if (this.method == 'post') {
                    // window.axios.post('http://localhost:8000/clients', {
                    window.axios.post(this.$config.BASE_URL + '/clients', {
                        client: this.client,
                    })
                        .then(function (response) {
                            console.log(response);
                            // console.log(response.data.data.id);
                            self.testEnabled = false;
                            // window.location.href = this.$config.BASE_URL + '/'+this.redirecturl;
                            window.location.href = this.$config.BASE_URL + '/clients';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }

                if (this.method == 'put') {
                    // window.axios.put('http://localhost:8000/clients/'+this.client.id, {
                    window.axios.put(this.$config.BASE_URL + '/clients/' + this.client.id, {
                        client: this.client,
                    })
                        .then(function (response) {
                            console.log(response);
                            // console.log(response.data.data.id);
                            self.testEnabled = false;
                            // window.location.href = this.$config.BASE_URL + '/'+this.redirecturl;
                            window.location.href = this.$config.BASE_URL + '/clients';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }

            }
        }
    }
</script>

<style scoped>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

    .card {
        margin-top: 2em;
    }

    .clientform-card-header {
        text-align: left;
        height: 24px;
        color: #000;
        font-family: Montserrat;
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 0.24px;
        line-height: 24px;
    }

    .form-group {
        text-align: left !important;
    }

    .text-muted {

    }

    .add-client {
        color: #FFFFFF;
        font-family: Montserrat !important;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 0.22px;
        line-height: 22px;
        text-align: center;
        padding: 10px;
        width: 206px;
        height: 53px;
    }

    .lable-text {
        height: 22px;
        color: #1B2031;
        font-family: Montserrat !important;
        font-size: 18px;
        letter-spacing: 0.22px;
        line-height: 22px;
    }
</style>


