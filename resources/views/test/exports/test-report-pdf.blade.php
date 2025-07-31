<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
            padding: 20px 20px 20px;
        }


        .table td, .table th {
            padding: .25rem !important;
        }

        .legend-card {
            border-right: #000000 !important;
            border-right-style: groove !important;
            border-right-width: 1px !important;
            padding: .25rem !important;
        }

        .legend-card .legend-title {
            color: #0474C8;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.29px;
            line-height: 29px;
            margin-bottom: 0;
        }

        .legend-card .legend-subtitle {
            color: #000;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.17px;
            line-height: 18px;
            margin-bottom: 0.05rem;
        }

        .legend-figure {
            color: #0474C8;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.36px;
            line-height: 37px;
            border-collapse: separate;
            padding-left: .75rem !important;
            vertical-align: middle !important;
        }

        .test-info {
            border-radius: 6px;
            width: 20%;
            background-color: #ffffff
        }

        .row {
            display: flex;
        }

        .line-chart img {
            width: 460px;
            height: 280px;
            display: block;
        }
    </style>

</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td width="25%" align="left" style="width: 25%;margin: 0px !important;padding: 0px !important;">
                @include('components.pdf-client-logo')
            </td>
            <td width="50%" align="center" style="width: 50%; background-color: white !important; border: 1px solid #111 !important; text-align: center !important; padding: 0px !important;">
                <h1 style="font-size:22px; font-weight: 800;padding: 0px !important;margin: 0px !important;" class="d-inline">
                    {{$client['name']}}
                </h1>
                <table style="width: 100%;">
                    <tr>
                        <td class="text-right"> Gender</td>
                        <td>:</td>
                        <td class="text-primary text-left">{{$client['gender']}}</td>
                    </tr>
                    <tr>
                        <td class="text-right"> Weight (kg)</td>
                        <td>:</td>
                        <td class="text-primary text-left">{{$client['weight']??'-'}}</td>
                    </tr>
                    <tr>
                        <td class="text-right">DOB</td>
                        <td>:</td>
                        <td class="text-primary text-left">
                            {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                            ({{$age_test}} Years old)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right" style="line-height: 15px; width: 50%">{{$test_details['test_type']}}</td>
                        <td>:</td>
                        <td class="text-primary text-left" style="line-height: 15px; width: 50%">{{$test_details['test_name']}}<td>
                    </tr>
                    <tr>
                        <td class="text-right">Date of Test</td>
                        <td>:</td>
                        <td class="text-primary text-left">
                            {{\Carbon\Carbon::parse($date_test)->format('d/m/Y')}}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="25%" style="width: 25%;" align="right">
                @include('components.pdf-logo')
            </td>
        </tr>
    </table>

<div class="table-responsive mb-3">
    <table class="w-100" style="border-collapse: separate; border-spacing: 10px; margin-top: 15px">
        <thead style="background-color: rgb(238, 241, 249);">
        <tr>
            @if(!empty($legend_data))
                @foreach ($legend_data as $item)
                    <th class="px-3 py-2" style="border-radius: 6px;">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="legend-card">
                                    <p class="legend-title">{{$item['heading']}}</p>
                                    <p class="legend-subtitle">{{$item['sub_heading']}}</p>
                                </td>
                                <td class="legend-figure text-center">
                                    {{$item['value']}}
                                </td>
                            </tr>
                        </table>
                    </th>
                @endforeach
            @endif
        </tr>
        </thead>
    </table>
</div>

<section id="section-b-2" class="px-0 pt-0 mt-0 mx-0">
    @if ($report_type == 'full')
        <table class="table ml-2" style="border-collapse: separate; border-spacing: 2px;">
            <thead style="background-color: rgb(238, 241, 249);">
            <tr>
                @if (!empty($summery_headers))
                    @foreach ($summery_headers as $header)
                        @if ($header['pivot']['display'] !=='none' && !in_array($header['name'], $hidden_columns))
                            <th class="text-center">
                                {{$header['heading']}}
                                <div
                                    style="color: #000;font-size: 14px;font-weight: 500;letter-spacing: 0.17px;line-height: 18px;">
                                    {{$header['sub_heading']}}
                                </div>
                            </th>
                        @endif
                    @endforeach
                @endif
            </tr>
            <tr>
                @if (!empty($summery_data))
                    @foreach (last($summery_data) as $key =>  $data)
                        @if ($data['customStyles']['display'] != 'none' && !in_array($key, $hidden_columns))
                            <th style="color: #1B2031;font-size: 19px;text-align: center;font-weight: bold;letter-spacing: 0.2px;width: 100%;background-color: rgb(238, 241, 249);">
                                {{$data['value']}}
                            </th>
                        @endif
                    @endforeach
                @endif
            </tr>
            </thead>
        </table>

        <table class="table ml-2" style="border-collapse: separate; border-spacing: 2px; margin-top: 20px;">
            <thead>
            <tr>
                @if(!empty($table_headers))
                    @foreach ($table_headers as $header)
                        @if ($header['pivot']['display'] !=='none' && !in_array($header['name'], $hidden_columns))
                            <th style="background: {{$header['pivot']['color_code']}};" class="text-center pb-2">
                                {{$header['heading']}}
                                <div
                                    style="color: #000;font-size: 14px;font-weight: 500;letter-spacing: 0.17px;line-height: 18px;">
                                    {{$header['sub_heading']}}
                                </div>
                            </th>
                        @endif
                    @endforeach
                @endif
            </tr>
            </thead>
            <tbody>
            @if(!empty($table_headers))
                @foreach ($table_data as $row)
                    <tr>
                        @foreach($row as $key => $data)
                            @if ($data['customStyles']['display'] != 'none' && !in_array($key, $hidden_columns))
                                <td style="background: {{$data['customStyles']['color_code']}};color: #1B2031;
                                    font-size: 19px;
                                    text-align: center;
                                    font-weight: bold;
                                    letter-spacing: 0.19px;
                                    line-height: 19px;" class="text-center">
                                    {{$data['value']}}
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    @endif

    <table style="width:100%; border-collapse: separate; border-spacing: 12px;">
        <tr>
            <td style="width:50%; vertical-align:top; background-color:#EEF1F9; padding: 15px !important; border-radius:8px;">
                <p style="font-size: .75em; color: #696e7a; font-weight: 400; font-family: 'Montserrat', 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                    Linear Correlation: <strong>{{$scatter_chart['correlation']}}</strong>
                </p>
                <img src="{{$scatter_chart['image']}}" alt="Scatter Chart"
                    style="width: 100%; max-width: 460px; height: 280px;"/>
            </td>
            <td style="width:50%; vertical-align:top; background-color:#EEF1F9; padding: 15px !important; border-radius:8px;">
                <img src="{{$line_chart}}" alt="Line Chart"
                    style="width: 100%; max-width: 460px; height: 280px; padding-top: 2.15rem;"/>
            </td>
        </tr>
    </table>

</section>
</body>
</html>