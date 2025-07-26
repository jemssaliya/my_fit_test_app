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
            padding: 60px 20px 0px 40px;
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

        .summery-header-box {
            border-radius: 2px;
            background-color: #EEF1F9;
            color: #131313;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 0.16px;
            line-height: 16px;
            margin-left: 10px;
            vertical-align: middle;
            padding: 30px !important;
        }

        .summery-value-box {
            background-color: #8EF565;
            text-align: right !important;
            color: #000000;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.19px;
            line-height: 19px;
            vertical-align: middle;
            padding: 30px !important;
        }

    </style>

</head>
<body>
<div class="row ml-2 pl-1">
    {{--Report Logo--}}
    @include('components.pdf-logo')

    <div class="col-4 client-info text-center p-0">
        <table style="width: 100%;" class="px-0 text-center">
            <tr>
                <td>
                    <h1 style="
                   font-family:'Helvetica Neue', Helvetica, 'Segoe UI', Arial, freesans, sans-serif;
                   font-size:22px;
                   font-weight:600;
                   line-height: 15px
                  " class="mx-auto pt-2"
                    >
                        {{$client['name']}}
                    </h1>
                </td>
            </tr>
        </table>
        <br>
        <table style="width: 100%;" class="px-0">
            <tr>
                <td class="text-right"> Gender</td>
                <td>:</td>
                <td class="text-primary pl-2 text-left">{{$client['gender']}}</td>
            </tr>
            <tr>
                <td class="text-right"> Weight (kg)</td>
                <td>:</td>
                <td class="text-primary pl-2 text-left">{{$client['weight']??'-'}}</td>
            </tr>
            <tr>
                <td class="text-right">DOB</td>
                <td>:</td>
                <td class="text-primary pl-2 text-left">
                    {{\Carbon\Carbon::parse($client['dob'])->format('d/m/Y')}}
                    ({{$client['age']}} Years old)
                </td>
            </tr>
            <tr>
                <td class="text-right" style="line-height: 15px; width: 50%">{{$test_details['test_type']}}</td>
                <td>:</td>
                <td class="text-primary pl-2 text-left" style=" width: 50%">{{$test_details['test_name']}}</td>
            </tr>
            <tr>
                <td class="text-right">Program</td>
                <td>:</td>
                <td class="text-primary pl-2 text-left" style="line-height: 15px">{{$test_details['program']}}</td>
            </tr>
        </table>
    </div>

    {{--Site Logo--}}
    @include('components.pdf-client-logo')
</div>

@if ($report_type === 'full')
    <div class="table-responsive mb-3">
        <table class="w-100" style="border-collapse: separate; border-spacing: 10px;">
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
@endif

<section id="section-b-2" class="px-2">
    {{--    <table class="table" style="border-collapse: separate; border-spacing: 2px;">--}}
    {{--        <thead style="background-color: rgb(238, 241, 249);">--}}
    {{--        <tr>--}}
    {{--            @if (!empty($summery_data))--}}
    {{--                @foreach ($summery_data as $data)--}}
    {{--                    <th class="text-center">--}}
    {{--                        {{$data['labal']}}--}}
    {{--                        <div--}}
    {{--                            style="color: #000;font-size: 16px;font-weight: bold;letter-spacing: 0.17px;">--}}
    {{--                            {{$data['value']}}--}}
    {{--                        </div>--}}
    {{--                    </th>--}}
    {{--                @endforeach--}}
    {{--            @endif--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--    </table>--}}

    {{--Report Data--}}
    <table class="table" style="border-collapse: separate; border-spacing: 2px; margin-top: 20px;">
        <thead>
        <tr>
            @if(!empty($table_headers))
                @foreach ($table_headers as $header)
                    @if ($header['pivot']['display'] !=='none' && !in_array($header['name'], $hidden_columns))
                        @if ($report_type === 'short' && in_array($header['name'], $only_fields))
                            <th style="background: {{$header['pivot']['color_code']}};" class="text-center pb-2">
                                {{$header['heading']}}
                                <div
                                    style="color: #000;font-size: 14px;font-weight: 500;letter-spacing: 0.17px;line-height: 18px;">
                                    {{$header['sub_heading']}}
                                </div>
                            </th>
                        @elseif ($report_type === 'full')
                            <th style="background: {{$header['pivot']['color_code']}};" class="text-center pb-2">
                                {{$header['heading']}}
                                <div
                                    style="color: #000;font-size: 14px;font-weight: 500;letter-spacing: 0.17px;line-height: 18px;">
                                    {{$header['sub_heading']}}
                                </div>
                            </th>
                        @endif
                    @endif
                @endforeach
            @endif
        </tr>
        </thead>
        <tbody>
        @if(!empty($table_data))
            @foreach ($table_data as $row)
                <tr>
                    @foreach($row as $key => $data)
                        @if ($data['customStyles']['display'] != 'none'
                            && !in_array($key, $hidden_columns)
                            )
                            @if ($report_type === 'short' && in_array($key, $only_fields))
                                <td style="background: {{$data['customStyles']['color_code']}};color: #1B2031;
                                    font-size: 19px;
                                    text-align: center;
                                    font-weight: bold;
                                    letter-spacing: 0.19px;
                                    line-height: 19px;" class="text-center">
                                    {{$data['value']}}
                                </td>
                            @elseif ($report_type === 'full')
                                <td style="background: {{$data['customStyles']['color_code']}};color: #1B2031;
                                    font-size: 19px;
                                    text-align: center;
                                    font-weight: bold;
                                    letter-spacing: 0.19px;
                                    line-height: 19px;" class="text-center">
                                    {{$data['value']}}
                                </td>
                            @endif
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    {{--Chart Section--}}
    <div class="chart-section">
        <table class="table table-borderless m-0 p-0" style="border-collapse: separate; border-spacing: 10px;">
            <tr>
                @if ($report_type === 'full')
                    <td class="p-0">
                        @if (!empty($summery_panel))
                            <table class="table p-0 m-0">
                                @foreach ($summery_panel as $data)
                                    <tr>
                                        <td class="summery-header-box"
                                            style="padding-top: 0.75rem !important;padding-right: 1.25rem !important;padding-bottom: 0.75rem !important;padding-left: 1.25rem !important;">
                                            {{$data['label']}}
                                        </td>
                                        <td class="summery-value-box"
                                            style="padding-top: 0.75rem !important;padding-right: 1.25rem !important;padding-bottom: 0.75rem !important;padding-left: 1.25rem !important;">
                                            {{$data['value']}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </td>
                @endif

                <td class="p-0">
                    <div class="{{$report_type === 'full' ? 'col-10' : 'col-9'}} line-chart"
                         style="background-color: #EEF1F9;
                                {{$report_type === 'full'
                                    ? 'float: right'
                                    : 'margin-left: 3rem'
                                }}"
                    >
                        <img alt="Line chart"
                             src="{{$line_chart}}"
                             style="width: 600px; height: 360px; text-align: center;">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</section>
</body>

</html>
