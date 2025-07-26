@extends('oxygen::layouts.master-frontend-internal')

@push('meta')
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />

    @if (config('features.security.recaptcha_enabled'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endpush

@section('internal-page-contents')

{{--<div style="text-align: center;">
    <p></p>
</div>--}}
<embed style="width: 100%; min-height: 90vh;"
       src="{{$testimonials}}"
       frameborder="0"
>
@stop
@section('styles')
<style>
.information-and-enq {	
    color: #878787;	
    /* font-family: Montserrat;	 */
    font-size: 14px;	
    font-weight: 500;	
    letter-spacing: -0.51px;	
    line-height: 18px;	
    text-align: center;
}
.info-myfittest-com {	
    color: #000000;	
    font-size: 18px;	
    font-weight: 500;	
    letter-spacing: -0.43px;	
    line-height: 22px;	
    text-align: center;
}
</style>
@endsection