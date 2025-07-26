@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','Home | Fit Test')
@section('contents')
<div class="main-banner-container">
    <img style="width:100%;height: 100%" src="{{ asset('images/bg_img_banner_landing_page.jpg') }}" alt="">
    {{--<div class="container h-100">
        <div class="row">
            <div class="col-md-6 col-xl-5 justify-content-center" style="text-align: center; padding-top: 50px;">
                --}}{{-- <img src="{{ asset('images/logo_fittest_v2_landing_page@2x.png') }}" alt="" style="width:300px; height:100px;"> --}}{{--
                <div class="banner-content">
                    --}}{{--
                    <h1>fit.test</h1>
                    <p>
                        Providing exercise professionals with mastery over aerobic fitness
                        <i>testing</i> and <i>programming</i>.
                        A low cost, low tech solution to a high cost, high tech problem.
                    </p>
                    @unless (Auth::check())
                    <a href="{{ route('register') }}">
                        <button class="sign-up">Sign Up</button>
                    </a>
                    @endunless
                    --}}{{--
                </div>
            </div>
        </div>
    </div>--}}
</div>
<!-- <img style="width:100%;	height: 600px; margin-top: 60px;" src="{{ asset('images/bg_img_banner_landing_page.png') }}" alt=""> -->
<div class="container">
    <p class="home-intro">
        fit.test provides simple and reliable estimations of VO2max that
        then link beautifully to the creation of individualised aerobic
        exercise sessions based on your clients’ own data.
        I wrote fit.test for my own practice because there was nothing
        like it on the market, and then other exercise professionals wanted it.
        fit.test will transform the way that you provide exercise services
        for your clients.
    </p>

    <section>
        <div class="row">
           <div class="col-md-8" style="padding-right: 25px;">
           <iframe class="p-2-image" src="https://www.youtube.com/embed/{{$url_1}}?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1​" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               <!-- <img class="p-2-image" src="{{ asset('images/img_banner@2x.png') }}" alt=""> -->
           </div>
           <div class="col-md-4" style="padding-right: 0px; margin-bottom:50px;">
               <h2>What our subscribers say</h2>
               <p></p>
               <p></p>
               <p></p>
           </div>
        </div>
    </section>

    <section>
        <div class="row">
           <div class="col-md-4">
               <h2>The power of fit.test is at your finger tips</h2>

               <p>
               <ol class="list-group" style="margin-left: 1rem;">
                   <li class="list-group-item-custom">
                       <p>Ability to customise your exercise testing or use published tests.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Much fewer assumptions and 'look up tables' compared to other apps.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Direct links from testing to programming.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>14 different options for programming.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Perfect for pre and post testing.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Perfect for interval training and HIIT.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Very simple to use.</p>
                   </li>
                   <li class="list-group-item-custom">
                       <p>Our promise is to support you for your whole subscription. </p>
                   </li>
               </ol>
               </p>
           </div>
           <div class="col-md-8" style="padding-right: 0px; padding-left: 25px;">
           <iframe class="p-4-image" src="https://www.youtube.com/embed/{{$url_2}}?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1​" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               <!-- <img class="p-4-image" src="{{ asset('images/img_banner@2x.png') }}" alt=""> -->
           </div>
       </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    h2 {
    	color: #1B2031;
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 0.05rem;
    }

    section {
        margin: 60px 0 50px;
    }

    section h2 {
        margin: 0 0 2rem;
    }

    .main-banner-container {
        width:100%;
        height: 600px;
        background: url({{ asset('images/home-banner.jpg') }}) no-repeat 50% 0 scroll/cover;
    }

    .banner-content {
    	color: #1B2031;
        margin-top: 20%;
    }

    .banner-content h1 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .banner-content p {
        font-size: 2rem;
    }

    .home-intro {
        font-size: 1.4rem;
        font-weight: 500;
        letter-spacing: 0.05rem;
        margin: 60px 0;
    }

    .ytp-chrome-top {
        display: none!important;
    }

    .ytp-show-cards-title {
        display: none!important;
    }
    .ytp-cued-thumbnail-overlay-image {
        display: none!important;
    }
    .list-group-item {
        display: list-item;
    }
    .list-group-item-custom {
        display: list-item;
        background-color: transparent!important;
    }

    .sign-up {
        height: 53px;
        width: 210px;
        border: 1px solid #61A150;
        border-radius: 4px;
        background-color: #5ABF5A;
        color: #FFFFFF;
        font-family: Montserrat!important;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 0.22px;
        line-height: 22px;
        text-align: center;
    }

    .p-2-image {
        height: 448px;
        width: 100%;
        border: 1px solid #1B2031;
        border-radius: 4px;
        background-color: rgba(0,0,0,0.22);
    }

    .p-4-image {
        height: 448px;
        width: 100%;
        border: 1px solid #1B2031;
        border-radius: 4px;
        background-color: rgba(0,0,0,0.1);
    }
    .logo-main {
        height: 106px;
        width: 200px;
    }
</style>
@endsection
