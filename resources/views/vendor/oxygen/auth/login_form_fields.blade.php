<div class="form-group row">
    <div class="col-md-12">
        <input id="email" type="email"
               class="sign-in-form-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               value="{{ old('email', $prefilledEmail ?? null) }}" placeholder="Email" required autofocus>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="password" type="password"
               class="sign-in-form-input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" placeholder="Password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6" style="display: flex; align-items: center;">
    <!-- <div class="form-check">
            <input class="form-check-input remember-check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label remember-me" for="remember">
                {{ __('Remember Me') }}
        </label>
    </div> -->
        <label class="checkbox-inline checkbox-bootstrap checkbox-lg">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="checkbox-placeholder remember-me"></span>
            {{ __('Remember Me') }}
        </label>
    </div>
    <div class="col-md-6">
        <button type="submit" class="btn-success btn-lg btn-sign-in" style="width: 100%;">
            {{ __('Sign In') }}
        </button>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8">
        <a style="color:#5abf5a;text-decoration: underline;" class="btn-link forgot-password"
           href="{{ route('password.request') }}">
            {{ __('Forgot Password?') }}
        </a>
    </div>
</div>
