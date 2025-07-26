@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Articles', 'articles', true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')

    <a href="{{ 'articles' . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>
@stop

@section('content')
    @include('article.table-articles', [
        'tableHeader' => [
            'ID', 'Title', 'Action', 'Danger Zone'
        ]
    ])

    @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td style="width:75%;">
                {{ $article->title }}
            </td>

            <td>

                    <a href="{{ 'articles' . '/' . $article->id . '/edit' }}"
                       class="btn btn-info js-tooltip"
                       title="Edit Article"><em class="fa fa-edit"></em> Edit</a>
            </td>

            <td>
                    <form action="{{ 'articles' . '/' . $article->id }}"
                          method="POST" class="form form-inline js-confirm">
                        {{ method_field('delete') }}
                        @csrf
                        <button class="btn btn-danger js-tooltip"
                                title="PERMANENTLY DELETE. THIS CANNOT BE REVERSED!"><em class="fa fa-times"></em> Delete</button>
                    </form>
            </td>
        </tr>
    @endforeach
@stop
