@extends('oxygen::layouts.master-frontend-internal')

@push('meta')
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />

    @if (config('features.security.recaptcha_enabled'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endpush

@section('contents')
<section id="contents">
    <div class="container">
        <div class="row justify-content-center" style="display: flex; justify-content: center;">

            <div class="col col-md-12" style="padding: 25px;">
                <div class="row" style="margin: 0px!important; margin-bottom: 30px!important">
                    <span class="articles">Articles</span>
                </div>
                <div class="tableFixHead">
                    <table class="table table-seperated ">
                        <thead style="display: table-header-group!important;">
                        <tr style="background-color: transparent;">
                            <th  class="article-title" style="background-color: transparent; padding-left: 12px;">  Article Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($articles as $article)
                        <tr class="articles-row">
                            <td class="artical-title ellipsis" style="vertical-align: middle;">{{$article->title}}</td>
                            <td class="client-inverse" style="vertical-align: middle;">
                            <a href="{{ $article->file_url}}" class="btn-download"> Download
                            </a>
                            <!-- <button class="btn-download">Download</button> -->
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('styles')
<style>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

.information-and-enq {
    color: #878787;
    font-family: Montserrat!important;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: -0.51px;
    line-height: 18px;
    text-align: center;
}

.article-title {
    height: 18px;
    color: #000;
    font-family: Montserrat!important;
    font-size: 14px;
    letter-spacing: 0.17px;
    line-height: 18px;
}

.ellipsis {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 120px;
}
.info-myfittest-com {
    color: #000000;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: -0.43px;
    line-height: 22px;
    text-align: center;
}
.table-seperated {
  border-collapse: separate;
  border-spacing: 0em 0.5em;
}
.td {
  background: #d6ddea;
  background-color: #FAFAFB;
}

thead {
  display: none!important;
}

.table tr {
    background-color: #FAFAFB;
}

.articles-row {
    height: 60px;
    width: 930px;
    border-radius: 4px;
    background-color: #FAFAFB;
    box-shadow: 0 2px 3px 0 rgba(0,0,0,0.1);
    /* display: flex;
    justify-content: space-between; */
}

.btn-download {
    height: 33px;
    width: 140px;
    border: 1px solid #36A036;
    border-radius: 3px;
    background-color: #5ABF5A;
    float:right;
    color: #FFFFFF;
    font-family: Montserrat!important;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 0.14px;
    line-height: 33px;
    text-align: center;
}

.artical-title {
    height: 19px;
    color: #1B2031;
    font-family: Montserrat!important;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 0.19px;
    line-height: 19px;
}

.articles {
    height: 22px;
    color: #000;
    font-family: Montserrat!important;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 0.22px;
    line-height: 22px;
}

.table th {
    background-color: #FAFAFB;
}
/* .tableFixHead    { overflow-y: auto; height: 70vh; }
.tableFixHead th { position: sticky; top: 0; } */
</style>
@endsection
