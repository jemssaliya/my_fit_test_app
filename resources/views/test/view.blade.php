@extends('layouts.app')

@section('title', 'View Test')
@section('content')
    <viewtest :testTypes="{{ json_encode($testTypes) }}"
        :client="{{ json_encode($client) }}"
        :testData="{{ json_encode($data) }}"
        :testId="{{$testId}}"
        :test_type="{{$test_type}}"
        :chart_type="{{$chart_type}}"
        :testName="{{json_encode($test_name)}}"
        :testTypeName="{{json_encode($test_type_name)}}"
        :date="{{json_encode($date)}}"
    ></viewtest>
@endsection
