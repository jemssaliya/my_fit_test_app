@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Videos', 'videos', true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')

    <a href="{{ 'videos' . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>
@stop

@section('content')
    @include('video.table-videos', [
        'tableHeader' => [
            'ID', 'Title','URL', 'Action', 'Danger Zone'
        ]
    ])

    @foreach ($videos as $video)
        <tr>
            <td>{{ $video->id }}</td>
            <td style="width:75%;">
                {{ $video->title }}
            </td>
            <td>

                <a href="{{ $video->url }}" target="_blank"
                   class="btn btn-success"
                   title="Edit Article"><em class="fa fa-video"></em> View</a>
            </td>
            <td>
                <a href="{{ 'videos' . '/' . $video->id . '/edit' }}"
                   class="btn btn-info js-tooltip"
                   title="Edit Article"><em class="fa fa-edit"></em> Edit</a>
            </td>
            <td>
                <form action="{{ 'videos' . '/' . $video->id }}"
                      method="POST" class="form form-inline js-confirm">
                    {{ method_field('delete') }}
                    @csrf
                    <button class="btn btn-danger js-tooltip"
                            title="PERMANENTLY DELETE. THIS CANNOT BE REVERSED!"><em class="fa fa-times"></em> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
@stop
