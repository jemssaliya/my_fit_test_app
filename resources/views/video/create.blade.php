@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline('Videos') }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Videos', route('manage.videos.index')],
        [$pageTitle, null, true]
    ]) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf

        {{ method_field('post') }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Video Title</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="title" value="{{ $entity->title }}" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Youtube URL</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="url" value="{{ $entity->file_url }}"/>
            </div>
        </div>

        {!! $form->render() !!}
        {!! $form->renderSubmit() !!}

    </form>
@stop