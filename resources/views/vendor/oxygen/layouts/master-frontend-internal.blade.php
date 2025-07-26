@extends('oxygen::layouts.master-frontend')

@section('pageTitle', $title)

@section('contents')
    <div class="internal-page">

        <header>
            <!-- <aside class="bg-dark"> -->
                <div class="container text-center">
                    <h2>{{ $title }}</h2>
                    <!-- <hr class="primary"> -->
                </div>
            <!-- </aside> -->
        </header>

        <section id="contents">
            <div class="container">
                <div class="row justify-content-center" style="display: flex; justify-content: center;">
                    <div class="col col-md-8" style="background-color: #FAFAFB; padding: 25px;">
                        @yield('internal-page-contents')
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop