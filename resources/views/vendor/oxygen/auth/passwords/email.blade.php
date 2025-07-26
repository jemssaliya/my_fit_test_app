@extends('oxygen::layouts.master-auth')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6" style="margin-bottom: 100px;">
				<div class="card reset-psw-card">

					<div class="card-body">
						<p class="forgot-password">{{ __('Forgot Password') }}</p>
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<form style="color:#696b74;" method="POST" action="{{ route('password.email') }}">
							@csrf

							<div class="form-group row">
								<div class="col-md-12">
									<p class="body-text">An email will be sent to your email address with the password reset link. Please type your email address below.</p>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-12">
									<input id="email" type="email" class="forgot-psw-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

									@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-12 justify-content-center" style="text-align: center;">
									<button type="submit" class="btn-success btn-lg btn-reset-psw">
										{{ __('Reset Password') }}
									</button>
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
<style>
.reset-psw-card {	
	margin-top: 30px;
	border-radius: 4px;	
	background-color: #FAFAFB;
	padding: 20px;
}
.forgot-password {	
	height: 24px;
	color: #000;	
	font-size: 20px;	
	font-weight: bold;	
	letter-spacing: 0.24px;	
	line-height: 24px;
}
.body-text {	
	color: #000;	
	font-size: 14px;	
	letter-spacing: 0.17px;	
	line-height: 18px;
}
.forgot-psw-input {	
	height: 55px;	
	border: 1px solid #989AA1;	
	border-radius: 6px;	
	background-color: #EEF1F9;
}
.btn-reset-psw {	
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
footer ul li {
	font-size: 1.5rem !important;
}
</style>
@endsection

{{--
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form style="color:#696b74;" class="form-horizontal" role="form" method="POST" action="/password/email">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="col-md-12">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12"  style="text-align: center;">
								<button type="submit" class="btn btn-success btn-lg">
									Send Password Reset Link
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
--}}