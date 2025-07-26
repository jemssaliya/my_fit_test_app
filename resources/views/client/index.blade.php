@extends('layouts.app')

@section('title', 'Clients')
@section('content')
    {{-- this can use as well -> $clients->toJson() --}}
    <client :clients="{{ json_encode($clients) }}"></client>
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection