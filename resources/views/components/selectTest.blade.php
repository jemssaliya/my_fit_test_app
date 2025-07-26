<form class="form-inline">
    <div class="form-group mb-2 col-centered float-left">
        <h2 type="text" readonly class="form-control-plaintext" id="" value="">
            Start New Test Now
        </h2>
    </div>
    <div class="form-group mx-sm-3 mb-2 col-md-5" id="test-drop-down">
        <select id="inputState" class="form-control-lg bg-light">
            <option>Choose...</option>
            <option selected>Cycle Test</option>
            <option>Step Test</option>
            <option>Run Test</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success mb-2 btn-lg">Start Now</button>
</form>

<style>
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