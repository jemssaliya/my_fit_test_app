@extends('oxygen::layouts.master-auth')
@section ('pageTitle','Subscription Plan')
@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 100px; margin-top: 60px;">
            <div class="col-md-8" style="padding: 0px 50px 10px 50px; background-color: #FAFAFB;">
                <div class="card">
                    <div class="card-body justify-content-center" style="padding: 40px 0; text-align: center;">
                        <p class="subscribe-to-get-acc">Subscribe to get access to premium features</p>
                        {{-- <div class="promo-banner">
                             <p class="promo-banner-dummy-text"> Promo Banner Goes Here</p>
                         </div>--}}
                        <br>
                        <div>
                            <p class="start-with-a-free-trial">
                                Start with a free trial period for 1 month and you can
                                cancel at any time within that month.
                            </p>
                        </div>
                        <div>
                            <p class="feature"><img class="gap_img_text" src="{{ asset('images/ic_tick.png') }}"/>
                                Free Videos</p>
                            <p class="feature"><img class="gap_img_text" src="{{ asset('images/ic_tick.png') }}"/>
                                Free Articles</p>
                            <p class="feature"><img class="gap_img_text" src="{{ asset('images/ic_tick.png') }}"/>
                                Ongoing Support</p>
                            <p class="feature"><img class="gap_img_text" src="{{ asset('images/ic_tick.png') }}"/>
                                No restriction on client data</p>
                        </div>
                        <div>
                            <span class="a_dollar">A$</span> <span class="hundernd_text">92</span> <span
                                class="twelve-month">/ 12 Months</span>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <a href="{{ route('subscribe.create') }}">
                                <button type="submit" class="btn-primary btn-lg trial-btn"
                                        style="background-color:#28a745;border-color:#28a745;font-weight:bold;">
                                    {{ __('Start with a free trial') }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .subscribe-to-get-acc {
            height: 24px;
            color: #1B2031;
            /* font-family: Montserrat;	 */
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
            text-align: center;
        }

        .start-with-a-free-trial {
            height: 72px;
            color: #000;
            /* font-family: Montserrat;	 */
            font-size: 20px;
            font-weight: 500;
            letter-spacing: 0.24px;
            line-height: 24px;
            text-align: center;
        }

        .promo-banner-dummy-text {
            height: 19px;
            color: #000;
            font-size: 16px;
            letter-spacing: 0.19px;
            line-height: 19px;
            text-align: center;
            margin-top: 40px;
        }

        .card {
            background-color: #FAFAFB;
            border: none;
            /* box-shadow: 0 2px 3px 0 rgba(0,0,0,0.1); */
        }

        .promo-banner {
            height: 158px;
            /* width: 474px;	 */
            border: 1px solid #979797;
            background-color: #D8D8D8;
        }

        .feature {
            height: 24px;
            color: #1B2031;
            /* font-family: Montserrat;	 */
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
            text-align: left !important;
            margin-left: 25%;
        }

        .trial-btn {
            height: 53px;
            width: 290px;
            border: 1px solid #61A150;
            border-radius: 4px;
            background-color: #5ABF5A;
        }

        .h-100 {
            height: auto !important;
        }

        .gap_img_text {
            margin-right: 30px;
        }

        .hundernd_text {
            height: 40px;
            width: 59px;
            color: #1B2031;
            font-family: Montserrat;
            font-size: 33px;
            font-weight: bold;
            letter-spacing: 0.4px;
            line-height: 40px;
        }

        .a_dollar {
            height: 18px;
            width: 24px;
            color: #1B2031;
            font-family: Montserrat;
            font-size: 14px;
            letter-spacing: 0.17px;
            line-height: 18px;
            vertical-align: top !important;
        }

        .twelve-month {
            height: 19px;
            width: 97px;
            color: #1B2031;
            font-family: Montserrat;
            font-size: 18px;
            letter-spacing: 0.19px;
            line-height: 19px;
        }
    </style>
@endsection
