@extends('oxygen::layouts.master-auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-push-6">
                <div class="row" style="margin-bottom: 100px; margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="card  border border-dark">
                            <div class="card-body" style="padding: 40px 0;margin-left: 20px;">
                                <p class="subscribe-to-get-acc">
                                    Start with a free trial period for 1 month and you can cancel at any time within
                                    that month for no fee.
                                </p>
                                {{-- <div class="promo-banner">
                                     <p class="promo-banner-dummy-text"> Promo Banner Goes Here</p>
                                 </div>--}}
                                <br>
                                <div style="color: black !important;">
                                    <b><span class="a_dollar">A$</span> <span class="hundernd_text">92</span> <span
                                            class="twelve-month">/ 12 Months</span></b>
                                </div>
                                <div>
                                    <p class="feature"><img class="gap_img_text"
                                                            src="{{ asset('images/ic_tick.png') }}"/>
                                        Free Videos</p>
                                    <p class="feature"><img class="gap_img_text"
                                                            src="{{ asset('images/ic_tick.png') }}"/>
                                        Free Articles</p>
                                    <p class="feature"><img class="gap_img_text"
                                                            src="{{ asset('images/ic_tick.png') }}"/>
                                        Ongoing Support</p>
                                    <p class="feature"><img class="gap_img_text"
                                                            src="{{ asset('images/ic_tick.png') }}"/>
                                        No restriction on client data</p>
                                </div>

                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-pull-6" style="margin-bottom: 200px;">
                <div class="card sign-up-card">
                    <div class="card-body">
                        <p class="sign-up">Sign Up</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            @include('oxygen::auth.register_form_fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn-primary btn-lg btn-sign-up"
                                            style="width:100%;background-color:#28a745;border-color:#28a745;font-weight:bold;">
                                        {{ __('Verify & Sign Up') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12" style="color:#5e6069; text-align: center; margin-top: 8px;">
                                    <p>By Signing up, You agree to our</p>
                                    <p>
                                        <a style="color:#5abf5a;text-decoration: underline;"
                                           href="{{ route('pages.terms-conditions') }}">Terms & Conditions</a> &
                                        <a style="color:#5abf5a;text-decoration: underline;"
                                           href="{{ route('pages.privacy-policy') }}">Privacy Policy</a>
                                    </p>
                                    <p>Already a member? <a style="color:#5abf5a;text-decoration: underline;"
                                                            href="{{ route('login') }}"> Sign In</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css"/>

    <style>
        .sign-up-card {
            margin-top: 20px;
            /* height: 622px;
            width: 510px;	 */
            border-radius: 4px;
            background-color: #FAFAFB;
            padding: 20px;
        }

        .sign-up {
            color: #000;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
        }

        .regiter-form-inputs {
            height: 55px;
            border: 1px solid #989AA1;
            border-radius: 6px;
            background-color: #EEF1F9;
        }

        .btn-sign-up {
            height: 53px;
            width: 314px;
            border: 1px solid #61A150;
            border-radius: 4px;
            background-color: #5ABF5A;
        }

        footer ul li {
            font-size: 1.5rem !important;
        }

        #timezone {
            font-size: 1.4rem;
        }

        .select2-container .select2-selection--single {
            height: 55px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 55px;

        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #989AA1;
            background-color: #eef1f9;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 55px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #1976D2;
        }
    </style>
@endsection

@section('scripts')
    <script src="/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.select2').select2();
        });
    </script>
@endsection
