@extends('layouts.app')

@section('title', 'Add Client')

@section('content')
        <clientform :client="{{ json_encode($client) }}"
        :method="{{ json_encode($method) }}"
        :labal="{{ json_encode($labal) }}"
        :title="{{ json_encode($title) }}"
        :redirectUrl="{{ json_encode($redirect_url) }}">
</clientform>
@endsection