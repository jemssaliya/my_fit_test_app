@extends('layouts.app')

@section('title', 'Test')

@section('content')
    <test :testTypes="{{ json_encode($testTypes) }}" :client="{{ json_encode($client) }}"></test>
@endsection

@if (empty($noHeaderFooter))
    @include('oxygen::partials.footer')
@endif
