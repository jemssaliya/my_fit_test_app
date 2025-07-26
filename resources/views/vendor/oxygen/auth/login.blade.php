@extends('oxygen::layouts.master-auth')

@section('content')
	<div class="container">
		@include('oxygen::partials.flash')
		<div class="row">
			<div class="col-lg-5 col-md-push-6 text-center">
				<img src="{{ asset('images/image_signup@2x.png') }}" alt="" style="max-width: 70vw; width:100%;">
			</div>
			<div class="col-lg-6 col-md-pull-6" style="margin-bottom: 200px;">
				<div class="card sign-in-card">

					<div class="card-body">
						<p class="sign-in">Sign In</p>
						<form method="POST" action="{{ route('login') }}">
							@csrf

							@include('oxygen::auth.login_form_fields')
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('styles')
<style>
	@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");
.sign-in-card {
	margin-top: 30px;
	/* height: 367px;	 */
	border-radius: 4px;
	background-color: #FAFAFB;
	padding: 20px;
}
.sign-in {
	color: #000;
	font-size: 20px;
	font-weight: bold;
	letter-spacing: 0.24px;
	line-height: 24px;
}
footer ul li a{
	font-size: 1.5rem !important;
}
.sign-in-form-input {
	height: 55px;
	border: 1px solid #989AA1;
	border-radius: 6px;
	background-color: #EEF1F9;
}
.remember-check {
	height: 34px;
	width: 34px;
	border: 1px solid #989AA1;
	border-radius: 6px;
	background-color: #EEF1F9;
}
.remember-me {
	/* height: 19px;
	width: 124px;	 */
	color: #000;
	font-size: 16px;
	font-weight: 500;
	letter-spacing: 0.19px;
	line-height: 19px;
}
.btn-sign-in {
	height: 53px;
	width: 210px;
	border: 1px solid #61A150;
	border-radius: 4px;
	background-color: #5ABF5A;
	font-family: Montserrat !important;
	font-weight: bold;
}
.forgot-password {
	color: #5ABF5A;
	font-size: 16px;
	font-weight: 600;
	letter-spacing: 0.19px;
	line-height: 19px;
}

:root {
  /* larger checkbox */
}
:root label.checkbox-bootstrap input[type=checkbox] {
  /* hide original check box */
  opacity: 0;
  position: absolute;
  /* find the nearest span with checkbox-placeholder class and draw custom checkbox */
  /* draw checkmark before the span placeholder when original hidden input is checked */
  /* disabled checkbox style */
  /* disabled and checked checkbox style */
  /* when the checkbox is focused with tab key show dots arround */
}
:root label.checkbox-bootstrap input[type=checkbox] + span.checkbox-placeholder {
  width: 14px;
  height: 14px;
  border: 1px solid;
  border-radius: 3px;
  /*checkbox border color*/
  border-color: #737373;
  display: inline-block;
  cursor: pointer;
  margin: 0 7px 0 -20px;
  vertical-align: middle;
  text-align: center;
}
:root label.checkbox-bootstrap input[type=checkbox]:checked + span.checkbox-placeholder {
  background: #0ccce4;
}
:root label.checkbox-bootstrap input[type=checkbox]:checked + span.checkbox-placeholder:before {
  display: inline-block;
  position: relative;
  vertical-align: text-top;
  width: 5px;
  height: 9px;
  /*checkmark arrow color*/
  border: solid white;
  border-width: 0 2px 2px 0;
  /*can be done with post css autoprefixer*/
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  content: "";
}
:root label.checkbox-bootstrap input[type=checkbox]:disabled + span.checkbox-placeholder {
  background: #ececec;
  border-color: #c3c2c2;
}
:root label.checkbox-bootstrap input[type=checkbox]:checked:disabled + span.checkbox-placeholder {
  background: #d6d6d6;
  border-color: #bdbdbd;
}
:root label.checkbox-bootstrap input[type=checkbox]:focus:not(:hover) + span.checkbox-placeholder {
  outline: 1px dotted black;
}

:root label.checkbox-bootstrap.checkbox-lg input[type=checkbox] + span.checkbox-placeholder {
	height: 34px;
	width: 34px;
	border: 1px solid #989AA1;
	border-radius: 6px;
	background-color: #EEF1F9;
}
:root label.checkbox-bootstrap.checkbox-lg input[type=checkbox]:checked + span.checkbox-placeholder:before {
  width: 9px;
  height: 25px;
  /*checkmark arrow color*/
  border: solid #5ABF5A;
  border-width: 0 3px 3px 0;
}
</style>
@endsection
