@extends('oxygen::layouts.master-auth')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card reset-psw-card">
					<div class="card-header">{{ __('Reset Password') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('password.update') }}">
							@csrf

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

									@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

									@if ($errors->has('password'))
										<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn-primary btn-reset-password">
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
}
.btn-reset-password {	
	height: 53px;	
	width: 210px;	
	border: 1px solid #61A150;	
	border-radius: 4px;	
	background-color: #5ABF5A;
	font-family: Montserrat !important;
	font-weight: bold;
}
</style>
@endsection