@extends('layouts.app')

@section('title', 'Program')
@section('content')

    <program :programTypes="{{ json_encode($programTypes) }}"
        :client="{{ json_encode($client) }}"
        :testData="{{ json_encode($data) }}"
        :testId="{{$testId}}"
        :testTypes="{{ json_encode($testTypes) }}"
        :testTypeId="{{ json_encode($testTypeId) }}"
        :testName="{{json_encode($test_name)}}"
        :testTypeName="{{json_encode($test_type_name)}}"
    ></program>
@endsection