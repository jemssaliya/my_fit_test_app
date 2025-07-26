@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','Edit Client')
@section('contents')
    <div class="container" style="padding: 100px 0;">
        @include('oxygen::partials.flash')
        <div class="row justify-content-center">
            <div class="col-md-8  client-card">
                <div class="text-center">
                    <div class="p-5">
                        <form method="POST" action="/clients/{{ $client->id }}" enctype="multipart/form-data">
                            {{ method_field('put') }}
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}"/>
                            <div class="form-group row">
                                <label for="name" class="control-label col-sm-4 label-text">Client Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control form-control-lg client-input"
                                           value="{{ $client->name }}" id="name" placeholder="Client Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="control-label col-sm-4 label-text">Date of Birth</label>
                                <div class="col-sm-8">
                                    <input type="text" name="dob" class="date form-control form-control-lg client-input"
                                           id="dob"
                                           value="{{ date('d/m/Y', strtotime(old('dob', $client->dob))) }}"
                                           data-inputmask-alias="datetime" inputmode="numeric"
                                           data-inputmask-inputformat="dd/mm/yyyy"
                                           placeholder="Date of Birth">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="control-label col-sm-4 label-text">Gender</label>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-lg client-input" name="gender" id="gender"
                                            value="{{ $client->gender }}" placeholder="Gender">
                                        <!-- <option>Choose...</option> -->
                                        <option {{old('gender',$client->gender)=="Male"? 'selected':''}} value="Male">
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
                            <div class="mt-2">
                                <button type="submit" class="btn btn-success btn-lg btn-update-client">Update Client
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

        .label-text {
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
