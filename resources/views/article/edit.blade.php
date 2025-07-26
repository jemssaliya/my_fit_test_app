@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline('Articles') }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Articles', route('manage.articles.index')],
        ['Edit Article', null, true]
    ]) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal"  enctype="multipart/form-data">
        @csrf

        @if ($entity->id)
            {{ method_field('put') }}
            <input  type="hidden" name="id" value="{{ $entity->id }}" />
            <div class="form-group">
                <label for="name" class="col-sm-10 control-label">File (upload pdf file, if you don't want to replace file leave this blank)</label>
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
        @endif

        {!! $form->render() !!}
        {!! $form->renderSubmit() !!}

        <!-- <button type="submit">Update</button> -->
        
    </form>
@stop