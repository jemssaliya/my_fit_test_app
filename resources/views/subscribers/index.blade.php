@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Subscribers', 'subscribers', true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')

    {{-- <a href="{{ 'subscribers' . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a> --}}
@stop

@section('content')
    @include('subscribers.table-subscribers', [
        'tableHeader' => [
            'ID', 'User Name', 'Package Name', 'Subscribed On', 'Subscription Ends'
        ]
    ])

    @foreach ($subscribers as $subscriber)
        <tr>
            <td>{{ $subscriber->id }}</td>
            <td style="width:65%;">
                {!!  $subscriber->user->full_name ?? "<span class='badge badge-danger'>-DELETED-</span>"  !!}
            </td>
            <td>{{ $subscriber->name }}</td>
            <td>{{ $subscriber->created_at }}</td>
            <td>{{ $subscriber->expire_date??"-" }}</td>
        </tr>
    @endforeach
@stop
