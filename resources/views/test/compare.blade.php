@extends('layouts.app')

@section('title', 'Test')

@section('content')
    <comparetest :comparedata="{{ json_encode($testDataQuery) }}">
    </comparetest>
@endsection
