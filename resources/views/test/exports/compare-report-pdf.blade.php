<!DOCTYPE html>
<html>
<head>
    <title>Test Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css">
    <style type="text/css">
        {!! file_get_contents(public_path('bower_components/bootstrap/dist/css/bootstrap.min.css')) !!}
    </style>
    <style type="text/css" media="screen">
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

        .client-info {
            background-color: white;
            border: 1px solid;
            max-width: 45%;
            margin-left: 25%;
        }

        .client-info p {
            line-height: 1rem;
        }

        .client-logo {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .logo {
            margin: 20px;
            flex: 0 0 25%;
            max-width: 25%
        }

        #section-b-2 {
            width: 100%;
        }

        .line-chart {
            border-radius: 6px;
            margin-top: 30px;
            padding: 50px 20px 20px;
        }


        .table-heading-text {
            color: #000;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.19px;
            line-height: 19px;
            margin: auto;
        }

        .table-subheading-text {
            color: #000;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.17px;
            margin: auto;
        }

        .table td, .table th {
            padding: .25rem !important;
        }

        /** Define the margins of your page **/
        @page {
            margin: 20px 20px;
            margin-left: 3px !important;
        }
        .page-break{
            page-break-after:always;
        }

        .graph-image{
            /*width: 100%;*/
            /*height: 100%;*/
            width: 600px;
            height: 380px;
        }
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            display: inline-block;
        }


    </style>

</head>
<body>
    @if($cycle_test)
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td width="25%" align="left" style="width: 25%;margin: 0px !important;padding: 0px !important;">
                 @include('components.pdf-client-logo')
            </td>
            <td width="50%"  align="center"  style="width: 50%; background-color: white !important; border: 1px solid #111 !important; text-align: center !important;" >
                                    <h1 style="font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif; font-size:22px; font-weight:600;text-align: center;" class="d-inline" >
                                        {{ $client['name'] }}
                                    </h1>
                                    <table style="width: 100%; margin: auto;">
                                        <tr>
                                            <td class="text-right"> Gender</td>
                                            <td>:</td>
                                            <td class="text-primary text-left">{{$client['gender']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">DOB</td>
                                            <td>:</td>
                                            <td class="text-primary text-left">
                                                {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                                                ({{$client['age']}} Years old)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Date of Report</td>
                                            <td>:</td>
                                            <td class="text-primary text-left">
                                                {{\Carbon\Carbon::today()->format('d/m/Y')}}
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="width: 100%; margin: auto;align: center;">
                                        <tr>
                                            <td class="text-primary" style="text-align: center !important;">Compare Test Reports</td>
                                        </tr>
                                    </table>
            </td>
            <td width="25%" style="width: 25%;" align="right">
                 @include('components.pdf-logo')
            </td>
        </tr>
    </table>

    <h2 style="font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif; font-size:20px; font-weight:500;margin-left:20px !important;margin-top:20px !important;">
        Cycle Tests
    </h2>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" >
        <td width="65%" align="left" style="margin-left:0px !important;">
            <div class="line-chart" style="background-color: #EEF1F9;">
                <img alt="Line chart" src="{{$cycle_test}}" class="graph-image col-12"/>
            </div>
        </td>
        <td width="25%" style="width: 25%;text-align: right;" align="right">
            <table class="table table-bordered bg-light" style="margin-top: 32px;border-collapse: collapse; width: auto;float: right;min-width:90%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date and <span>VO<sub>2peak</sub></span></th>
                </tr>
                </thead>
                @if ($cycle_table)
                    @foreach($cycle_table as $cycle_table_data)
                        <tr>
                            <td><span class="dot" style="background-color:{{$cycle_table_data['color_code']}}"></span></td>
                            <td style="color:{{$cycle_table_data['color_code']}}">
                                {{(new DateTime($cycle_table_data['x']))->format('d F Y')}}<br>
                                <span>VO<sub>2peak</sub></span> = {{$cycle_table_data['y']}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </td>
    </table>
    @endif
    {{-- @if($walk_test)
    <div class="row">
        <div>
         <table style="width: 100%;">
          <thead>
                <tr>
                    <th colspan="2">
                        <div class="row" style="margin-left: 0">
                            @include('components.pdf-client-logo')

                            <div class="col-4 client-info text-center">
                                <h1 style="
                            font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif;
                            font-size:22px;
                            font-weight:600;
                            text-align: center;
                            " class="d-inline"
                                >
                                    {{$client['name']}}
                                </h1>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-right"> Gender</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">{{$client['gender']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">DOB</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                                            ({{$client['age']}} Years old)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Date of Report</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::today()->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                </table>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-primary">Compare Test Reports</td>
                                    </tr>
                                </table>
                            </div>

                            @include('components.pdf-logo')
                        </div>
                    </th>
                </tr>
           </thead>
        </table>
        </div>
    </div>
    <h2 class="mt-2" style="font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif; font-size:20px; font-weight:500;">
                    Walk Tests
                </h2>
    <div class="row">
        <div class="col-8 line-chart" style="background-color: #EEF1F9;">
            <img alt="Line chart"
                src="{{$walk_test}}"
                class="graph-image col-12"/>
        </div>
        <div class="col-3" style="margin-left: auto;">
            <table class=" table table-bordered bg-light" style="margin-top: 32px">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date and <span>VO<sub>2peak</sub></span></th>
                </tr>
                </thead>
                @if ($walk_table)
                    @foreach($walk_table as $walk_table_data)
                        <tr>
                            <td><span class="dot" style="background-color:{{$walk_table_data['color_code']}}"></span></td>
                            <td style="color:{{$walk_table_data['color_code']}}">
                                {{(new DateTime($walk_table_data['x']))->format('d F Y')}}<br>
                                <span>VO<sub>2peak</sub></span> = {{$walk_table_data['y']}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    @endif
    @if($run_test)
    <div class="row">
        <div>
          <table style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="2">
                        <div class="row" style="margin-left: 0">
                            @include('components.pdf-client-logo')

                            <div class="col-4 client-info text-center">
                                <h1 style="
                            font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif;
                            font-size:22px;
                            font-weight:600;
                            text-align: center;
                            " class="d-inline"
                                >
                                    {{$client['name']}}
                                </h1>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-right"> Gender</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">{{$client['gender']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">DOB</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                                            ({{$client['age']}} Years old)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Date of Report</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::today()->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                </table>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-primary">Compare Test Reports</td>
                                    </tr>
                                </table>
                            </div>

                            @include('components.pdf-logo')
                        </div>
                    </th>
                </tr>
            </thead>
         </table>
        </div>
    </div>
    <h2 class="mt-2" style="font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif; font-size:20px; font-weight:500;">
                    Jog or Run Test
                </h2>
    <div class="row">
        <div class="col-8 line-chart" style="background-color: #EEF1F9;">
                <img alt="Line chart"
                    src="{{$run_test}}"
                    class="graph-image col-12"/>
        </div>
        <div class="col-3" style="margin-left: auto;">
            <table class=" table table-bordered bg-light" style="margin-top: 32px">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date and <span>VO<sub>2peak</sub></span></th>
                </tr>
                </thead>
                @if ($run_table)
                    @foreach($run_table as $run_table_data)
                        <tr>
                            <td><span class="dot" style="background-color:{{$run_table_data['color_code']}}"></span></td>
                            <td style="color:{{$run_table_data['color_code']}}">
                                {{(new DateTime($run_table_data['x']))->format('d F Y')}}<br>
                                <span>VO<sub>2peak</sub></span> = {{$run_table_data['y']}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    @endif
    @if($step_test)
    <div class="row">
        <div>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="2">
                        <div class="row" style="margin-left: 0">
                            @include('components.pdf-client-logo')

                            <div class="col-4 client-info text-center">
                                <h1 style="
                            font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif;
                            font-size:22px;
                            font-weight:600;
                            text-align: center;
                            " class="d-inline"
                                >
                                    {{$client['name']}}
                                </h1>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-right"> Gender</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">{{$client['gender']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">DOB</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                                            ({{$client['age']}} Years old)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Date of Report</td>
                                        <td>:</td>
                                        <td class="text-primary text-left">
                                            {{\Carbon\Carbon::today()->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                </table>
                                <table style="width: 100%; margin: auto;">
                                    <tr>
                                        <td class="text-primary">Compare Test Reports</td>
                                    </tr>
                                </table>
                            </div>

                            @include('components.pdf-logo')
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
    <h2 class="mt-2" style="font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif; font-size:20px; font-weight:500;">
                    Step Tests
                </h2>
    <div class="row">
        <div class="col-8 line-chart" style="background-color: #EEF1F9;">
            <img alt="Line chart"
                src="{{$step_test}}"
                class="graph-image col-12"/>
        </div>
        <div class="col-3" style="margin-left: auto;">
            <table class=" table table-bordered bg-light" style="margin-top: 32px">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date and <span>VO<sub>2peak</sub></span></th>
                </tr>
                </thead>
                @if ($step_table)
                    @foreach($step_table as $step_table_date)
                        <tr>
                            <td><span class="dot" style="background-color:{{$step_table_date['color_code']}}"></span></td>
                            <td style="color:{{$step_table_data['color_code']}}">
                                {{(new DateTime($step_table_data['x']))->format('d F Y')}}<br>
                                <span>VO<sub>2peak</sub></span> = {{$step_table_data['y']}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    @endif --}}
    </body>
</html>
