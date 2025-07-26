<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{title}}
            </div>

            <div class="links">

            </div>
            <div class="col col-md-2">
                fvffrfsdfr
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'createClient',
        props: ['title', 'author'],
        methods: {
            create() {
                this.mute = true;
                window.axios.get('/api/cruds/create').then(({data}) => {
                    this.cruds.push(new Crud(data));
                    this.mute = false;
                });
            },
            created() {
                this.$http.get('/clients').then((res) => {
                    this.clients = res.data.data
                })
            },
            save() {
                this.$http.request({
                    method: this.job.id ? 'put' : 'post',
                    url: this.job.id ? '/clients/' + this.job.id : '/clients',
                    data: job
                }).then((res) => {
                    // TODO: Disable form until the client is saved
                    this.job = res.data.data
                    console.log(this.job)
                })
            }
        }
    }
</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #939b9f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .title {
        font-size: 60px;
    }

    .subtitle {
        font-size: 20px;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .client {
        background-color: aliceblue;
    }
</style>
