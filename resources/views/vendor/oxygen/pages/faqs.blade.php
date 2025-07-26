@extends('oxygen::layouts.master-frontend-internal')

@push('meta')
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
@endpush

@section('internal-page-contents')
    <div>
        <embed style="width: 100%; min-height: 90vh;" src="{{$file_url}}" frameborder="0" >
    </div>
@stop
