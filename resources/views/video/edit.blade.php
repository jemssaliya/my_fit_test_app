@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline('Video Edit') }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Videos', route('manage.videos.index')],
        ['Edit Video', null, true]
    ]) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal"  enctype="multipart/form-data">
        @csrf

        @if ($entity->id)
            {{ method_field('put') }}
            <input  type="hidden" name="id" value="{{ $entity->id }}" />
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Video Title</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" value="{{ $entity->title }}" required/>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Youtube URL</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="url" value="{{ $entity->url }}"/>
                </div>
            </div>
        @endif

        {!! $form->render() !!}
        {!! $form->renderSubmit() !!}

        <!-- <button type="submit">Update</button> -->
        
    </form>
@stop