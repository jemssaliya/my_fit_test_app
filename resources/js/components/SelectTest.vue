<template>
    <form class="form-inline">
        <div class="form-group mb-2 col-centered float-left">
            <h2 type="text" readonly class="form-control-plaintext" id="" value="">
                Start New Test Now
            </h2>
        </div>
        <!-- <div class="form-group mx-sm-3 mb-2 col-md-5" id="test-drop-down">
            <select id="inputState" class="form-control-lg bg-light">
                <option>Choose...</option>
                <option value="1" selected>Cycle Test</option> -->
        <!-- <option value="2">Step Test</option>
        <option value="3">Run Test</option> -->
        <!-- </select>
    </div> -->
        <button @click="startTest" type="button" class="btn btn-success mb-2 btn-lg">Start Now</button>
    </form>
</template>

<script>
    export default ({
        name: "startTest",
        props: {
            client_id: null
        },
        data() {
            return {}
        },
        methods: {
            startTest() {
                if (this.client_id === null) {
                    console.log('select client first');
                } else {
                    // window.location.href = 'http://localhost:8000/new-tests?client_id='+this.client_id;
                    window.location.href = this.$config.BASE_URL + '/new-tests?client_id=' + this.client_id;
                }
            },
        }
    })
</script>

<style scoped>
    .btn-start {
        width: 12em;
        height: 3em;
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


