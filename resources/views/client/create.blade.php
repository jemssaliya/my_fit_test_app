@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','Add New Client')
@section('contents')
    <div class="container" style="margin-top: 100px;">
        @include('oxygen::partials.flash')
        <div class="row justify-content-center" style="display:flex; justify-content:center;">
            <div class="col-md-8  client-card" style="padding:15px;">
                <div class="card text-center">
                    <div class="card-header">
                        <!-- <p class="update-client">Update Client</p>  -->
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/clients" enctype="multipart/form-data">
                            {{ method_field('post') }}
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}"/>
                            <div class="form-group row" style="display: flex;">
                                <label for="name" class="col-form-label col-form-label-lg labal-text">Client
                                    Name</label>
                                <div class="col-sm-8" style="margin: auto;">
                                    <input type="text" name="name" class="form-control form-control-lg client-input"
                                           value="{{ $client->name }}" id="name" placeholder="Client Name" required>
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex;">
                                <label for="dob" class="col-form-label col-form-label-lg labal-text">Date of
                                    Birth</label>
                                <div class="col-sm-8" style="margin: auto;">
                                    <input type="text" name="dob" class="form-control form-control-lg client-input"
                                           data-inputmask-alias="datetime" inputmode="numeric"
                                           data-inputmask-inputformat="dd/mm/yyyy" id="dob"
                                           value="{{ old('dob') }}"
                                           placeholder="Date of Birth" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex;">
                                <label for="gender" class="col-form-label col-form-label-lg labal-text"
                                       style="width: 120px; text-align: left;">Gender</label>
                                <div class="col-sm-8" style="margin: auto;">
                                    <select class="form-control form-control-lg client-input" name="gender" id="gender"
                                            value="{{ $client->gender }}" placeholder="Gender" required>
                                        <!-- <option>Choose...</option> -->
                                        <option selected
                                                {{old('gender',$client->gender)=="Male"? 'selected':''}} value="Male">
                                            Male
                                        </option>
                                        <option
                                            {{old('gender',$client->gender)=="Female"? 'selected':''}} value="Female">
                                            Female
                                        </option>
                                        <option {{old('gender',$client->gender)=="Other"? 'selected':''}} value="Other">
                                            Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-success btn-lg btn-update-client">Add Client
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
            src="/bower_components/inputmask/dist/jquery.inputmask.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#dob').datepicker({
                format: 'dd/mm/yyyy',
                endDate: new Date(),
                orientation: "bottom left"
            });
            $("#dob").inputmask();
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet"
          href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <style>
        .btn-update-client {
            height: 53px;
            width: 206px;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #61A150;
            border-radius: 4px;
            background-color: #5ABF5A;
        }

        .client-input {
            height: 55px;
            /* width: 439px;	 */
            border: 1px solid #989AA1;
            border-radius: 6px;
            background-color: #EEF1F9;
        }

        .labal-text {
            color: #1B2031;
            font-size: 18px;
            letter-spacing: 0.22px;
            line-height: 22px;
            margin: auto;
        }

        .client-card {
            /* height: 385px;
            width: 769px;	 */
            background-color: #FAFAFB;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .update-client {
            color: #000;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
        }

        .datepicker {
            width: 265px;
            padding: 10px
        }

        .datepicker.datepicker-orient-top {
            margin-top: 8px
        }

        .datepicker table {
            width: 100%
        }

        .datepicker td, .datepicker th {
            font-weight: regular;
            width: 35px;
            height: 35px;
            border-radius: 3px
        }

        .datepicker thead th {
            color: #74788d
        }

        .datepicker thead th.datepicker-switch, .datepicker thead th.next, .datepicker thead th.prev {
            font-weight: 500;
            color: #74788d
        }

        .datepicker thead th.datepicker-switch i, .datepicker thead th.next i, .datepicker thead th.prev i {
            font-size: 1.2rem;
            color: #74788d
        }

        .datepicker thead th.datepicker-switch i:before, .datepicker thead th.next i:before, .datepicker thead th.prev i:before {
            line-height: 0;
            vertical-align: middle
        }

        .datepicker thead th.datepicker-switch:hover, .datepicker thead th.next:hover, .datepicker thead th.prev:hover {
            background: #f7f8fa !important
        }

        .datepicker thead th.dow {
            color: #595d6e;
            font-weight: 500
        }

        .datepicker tbody tr > td.day {
            color: #595d6e
        }

        .datepicker tbody tr > td.day:hover {
            background: #ebedf2;
            color: #595d6e
        }

        .datepicker tbody tr > td.day.old {
            color: #74788d
        }

        .datepicker tbody tr > td.day.new {
            color: #595d6e
        }

        .datepicker tbody tr > td.day.active, .datepicker tbody tr > td.day.active:hover, .datepicker tbody tr > td.day.selected, .datepicker tbody tr > td.day.selected:hover {
            background: #3b4cf8;
            color: #fff
        }

        .datepicker tbody tr > td.day.today {
            position: relative;
            background: rgba(93, 120, 255, .7) !important;
            color: #fff !important
        }

        .datepicker tbody tr > td.day.today:before {
            content: '';
            display: inline-block;
            border: solid transparent;
            border-width: 0 0 7px 7px;
            border-bottom-color: #fff;
            border-top-color: #ebedf2;
            position: absolute;
            bottom: 4px;
            right: 4px
        }

        .datepicker tbody tr > td.day.range {
            background: #f7f8fa
        }

        .datepicker tbody tr > td span.hour, .datepicker tbody tr > td span.minute, .datepicker tbody tr > td span.month, .datepicker tbody tr > td span.year {
            color: #595d6e
        }

        .datepicker tbody tr > td span.hour:hover, .datepicker tbody tr > td span.minute:hover, .datepicker tbody tr > td span.month:hover, .datepicker tbody tr > td span.year:hover {
            background: #f7f8fa
        }

        .datepicker tbody tr > td span.hour.active, .datepicker tbody tr > td span.hour.active.focused:hover, .datepicker tbody tr > td span.hour.active:hover, .datepicker tbody tr > td span.hour.focused, .datepicker tbody tr > td span.hour.focused:hover, .datepicker tbody tr > td span.minute.active, .datepicker tbody tr > td span.minute.active.focused:hover, .datepicker tbody tr > td span.minute.active:hover, .datepicker tbody tr > td span.minute.focused, .datepicker tbody tr > td span.minute.focused:hover, .datepicker tbody tr > td span.month.active, .datepicker tbody tr > td span.month.active.focused:hover, .datepicker tbody tr > td span.month.active:hover, .datepicker tbody tr > td span.month.focused, .datepicker tbody tr > td span.month.focused:hover, .datepicker tbody tr > td span.year.active, .datepicker tbody tr > td span.year.active.focused:hover, .datepicker tbody tr > td span.year.active:hover, .datepicker tbody tr > td span.year.focused, .datepicker tbody tr > td span.year.focused:hover {
            background: #3b4cf8;
            color: #fff
        }

        .datepicker tfoot tr > th.clear, .datepicker tfoot tr > th.today {
            border-radius: 3px;
            font-weight: 500
        }

        .datepicker tfoot tr > th.clear:hover, .datepicker tfoot tr > th.today:hover {
            background: #ebedf2
        }

        .datepicker.datepicker-inline {
            border: 1px solid #ebedf2
        }

        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
            cursor: not-allowed;
        }

    </style>
@endsection
