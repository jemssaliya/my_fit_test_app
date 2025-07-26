@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline('Articles') }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Articles', route('manage.articles.index')],
        [$pageTitle, null, true]
    ]) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf

            {{ method_field('post') }}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">File (Pdf)</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="pdf" value="{{ $entity->file_url }}" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Article Title</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" value="{{ $entity->title }}" required/>
                </div>
            </div>

            {!! $form->render() !!}
            {!! $form->renderSubmit() !!}
        
    </form>
@stop