@extends('layouts.app')

@section('title', 'View Program')
@section('content')
    <viewprogram :programTypes="{{ json_encode($program_types) }}"
                 :client="{{ json_encode($client) }}"
                 :programData="{{ json_encode($data) }}"
                 :programId="{{ $program_id }}"
                 :testId="{{ $test_id }}"
                 :programType="{{ $program_type }}"
                 :testTypeName="{{ json_encode($test_type_name) }}"
                 :testName="{{ json_encode($test_name) }}"
    ></viewprogram>
@endsection
