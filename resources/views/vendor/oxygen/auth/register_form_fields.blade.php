<div class="form-group row">
    <div class="col-md-6">
        <input id="name" type="text"
               class="regiter-form-inputs form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
               placeholder="First Name" required autofocus>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <input id="last_name" type="text"
               class="regiter-form-inputs form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
               name="last_name" placeholder="Last Name" required autofocus>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="phone" type="phone"
               class="regiter-form-inputs form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone"
               placeholder="Phone Number" required>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">

        <select class="regiter-form-inputs form-control select2"
                name="timezone" id="timezone">
            @foreach(timezone_identifiers_list() as $time_zone)
                <option value="{{$time_zone}}"
                    {{$time_zone === 'Australia/Melbourne' ? 'selected' : ''}}
                >
                    {{$time_zone}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="email" type="email"
               class="regiter-form-inputs form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               placeholder="Email" required>
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
               class="regiter-form-inputs form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" placeholder="Password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="password-confirm" type="password" class="regiter-form-inputs form-control"
               name="password_confirmation" placeholder="Confirm Password" required>
    </div>
</div>
